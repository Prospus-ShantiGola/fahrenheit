<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserReport;
use App\Models\UserType;
use App\Models\CoolingLoadProfile;
use App\Models\GeneralInformation;
use App\Models\Option;
use App\Models\CompressionChiller;
use App\Models\EconomicData;
use App\Models\EconomicDataAdditionalInfo;
use App\Models\HeatingLoadProfile;
use App\Models\HeatSource;
use App\Models\Chiller;
use App\Models\RecoolingSystem;
use App\Models\AdkaCalculation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Exception;
use Gate;
use Hash;
use Mail;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Error\Error;
use App\Models\Fahrenheit;

class AdcalcController extends Controller
{

    public function index()
    {
        $user = array();
        if ($user = Auth::user()) {
            $user = Auth::user()->user_type_id;
        }
        return view('pages.adcalc')->with(compact('user'));
    }
    public function storeCompressionChiller(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'refrigerant' => 'required',
            'manufacturer' => 'required',
            'compressor' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->keys()]);
        }
        return response()->json(['success' => 'Record is successfully added']);

    }


    public function storeGeneralInformation(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'location' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->keys()]);
        }
        return response()->json(['success' => 'Record is successfully added']);

    }
    public function storeEconomicInformation(Request $request)
    {
        $validator = \Validator::make($request->all(), []);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->keys()]);
        }
        return response()->json(['success' => 'Record is successfully added']);

    }
    public function storeHeatSourceInformation(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'heat_type' => 'required',
            'drive_temp' => 'sometimes|required',
            'heat_capacity' => 'sometimes|required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->keys()]);
        }
        return response()->json(['success' => 'Record is successfully added']);

    }
    public function storeHeatingProfileInformation(Request $request)
    {
        $validator = \Validator::make($request->all(), []);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->keys()]);
        }
        return response()->json(['success' => 'Record is successfully added']);

    }
    public function storeCoolingProfileInformation(Request $request)
    {
        $validator = \Validator::make($request->all(), []);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->keys()]);
        }
        return response()->json(['success' => 'Record is successfully added']);

    }

    /**
     * Store project information.
     *
     */
    public function storeProjectInformation(Request $request)
    {
        DB::enableQueryLog();
        $generalData = $request->input('generalData');
        $economicData = $request->input('economicData');
        $chillers = $request->input('chiller') ?? array(); //coolingloadprofile
        $chillerDatas = $request->input('chillerData') ?? array(); //compressionchiller
        $heatSourceDatas = $request->input('heatSourceData') ?? array(); //heat source
        $heatingprofiles = $request->input('heatingprofile') ?? array(); //heatingprofile
        $chillerInfos = $request->input('chillerInfo') ?? array(); //fahrenheit chiller
        $recoolings = $request->input('recooling') ?? array(); //fahrenheit recooling
        $option = $request->input('option') ?? array(); //heatingprofile



        if (empty($generalData)) {
            return response()->json(['errors' => 'Please provide the mandatory field', 'key' => 'general']);
        } else {
            $email_address = $generalData['personal_email_address'];  //user can be single but project can be multiple so assign multiple project user personal email (as user)
            if ($user = Auth::user()) {
                $user = Auth::user()->id;
            } else {
                //dd($email_address);
                $user_exist = User::where('email', $email_address)->get();
                //check if user exist if not logged in then assign all the entries by their id
                if ($user_exist->count() > 0) {
                    $user = $user_exist[0]->id;
                    //dd($insertedId);
                } else {
                    $data['name'] = $generalData['editor'] ?? "new user";            //if user not provided the name, can later change
                    $data['company'] = $generalData['company'] ?? "fahrenheit";      // if user not provided the company , can later change
                    $data['phoneno'] = $generalData['phone_number'] ?? "0000000000";
                    $data['email'] = $generalData['personal_email_address'];
                    $data['password'] = bcrypt(rand(1, 15));
                    $user = User::create($data)->id;
                }

            }

            $project_name = $generalData['project_name'] ?? "ADCALC";
            $project_number = $generalData['project_number'] ?? rand(500, 1000);
            $data['user_id'] = $user;
            $data['title'] = strtoupper($project_name . "_" . $project_number);
            try {

                $insertedId = UserReport::create($data)->id;
                $generalData['unique_row_id'] = $insertedId;
                $resultGen = GeneralInformation::create($generalData);

                if (count($chillers) > 0) {

                        //economicData

                    $economicData['unique_row_id'] = $insertedId;
                    $option[0]['unique_row_id'] = $insertedId;
                        //dd($economicData);
                    $economicId = EconomicData::create($economicData);
                    $economicId = DB::getPdo()->lastInsertId();
                    $optionId = Option::create($option[0]);
                        //dd(DB::getQueryLog());
                       // dd($optionId);

                        //dd($id);
                    $input = array();
                    $finalSubmitArr = array();
                    $economicData['eeg_apportion_costs[]'] = $economicData['eeg_apportion_costs[]'] ?? array();
                    $economicData['planning[]'] = $economicData['planning[]'] ?? array();
                    $economicData['eeg_chp_apportion_costs[]'] = $economicData['eeg_chp_apportion_costs[]'] ?? array();
                    $economicData['planning_maintenence[]'] = $economicData['planning_maintenence[]'] ?? array();
                    foreach ($economicData['eeg_apportion_costs[]'] as $key => $eeg_apportion_cost) {
                        $input['economic_data_id'] = $economicId;
                        $input['tab_name'] = 'general';
                        $economicData['eeg_apportion_costs[]'][$key]['fieldname'] = array_reverse($economicData['eeg_apportion_costs[]'][$key]['fieldname']);
                            //dd($economicData['eeg_apportion_costs[]'][$key]['fieldname']);
                        $input['additional_field_name'] = $economicData['eeg_apportion_costs[]'][$key]['fieldname'][$key];

                        $input['additional_field_value'] = $eeg_apportion_cost['value'];
                        $finalSubmitArr[] = $input;
                    }

                    foreach ($economicData['eeg_chp_apportion_costs[]'] as $key => $eeg_chp_apportion_costs) {
                        $input['economic_data_id'] = $economicId;
                        $input['tab_name'] = 'chp';
                        $economicData['eeg_chp_apportion_costs[]'][$key]['fieldname'] = array_reverse($economicData['eeg_chp_apportion_costs[]'][$key]['fieldname']);
                        $input['additional_field_name'] = $economicData['eeg_chp_apportion_costs[]'][$key]['fieldname'][$key];
                        $input['additional_field_value'] = $eeg_chp_apportion_costs['value'];
                        $finalSubmitArr[] = $input;
                    }

                    foreach ($economicData['planning[]'] as $key => $planning) {
                        $input['economic_data_id'] = $economicId;
                        $input['tab_name'] = 'investment';
                        $economicData['planning[]'][$key]['fieldname'] = array_reverse($economicData['planning[]'][$key]['fieldname']);
                        $input['additional_field_name'] = $economicData['planning[]'][$key]['fieldname'][$key];
                        $input['additional_field_value'] = $planning['value'];
                        $input['additional_field_discount'] = $economicData['planning_discount[]'][$key]['value'];
                        $finalSubmitArr[] = $input;
                    }
                        //dd($finalSubmitArr);
                    foreach ($economicData['planning_maintenence[]'] as $key => $planning_maintenence) {
                        $input['economic_data_id'] = $economicId;
                        $input['tab_name'] = 'maintenence';
                        $economicData['planning_maintenence[]'][$key]['fieldname'] = array_reverse($economicData['planning_maintenence[]'][$key]['fieldname']);
                        $input['additional_field_name'] = $economicData['planning_maintenence[]'][$key]['fieldname'][$key];
                        $input['additional_field_value'] = $planning_maintenence['value'];
                        $input['additional_field_discount'] = null;
                        $finalSubmitArr[] = $input;
                    }
                        //dd($finalSubmitArr);
                    foreach ($finalSubmitArr as $record) {
                        $result = EconomicDataAdditionalInfo::create($record);
                          //  dd(DB::getQueryLog());
                    }

                    //coolingloadprofile
                    foreach ($chillers as $chiller) {
                        # iterate over the list of chiller.
                        $chiller['unique_row_id'] = $insertedId;
                        $result = CoolingLoadProfile::create($chiller);
                        //dd($result);
                    }

                    //heatingprofiles
                    foreach ($heatingprofiles as $heatingprofile) {
                        # iterate over the list of heatingprofiles.
                        $heatingprofile['unique_row_id'] = $insertedId;
                        $result = HeatingLoadProfile::create($heatingprofile);
                        //dd($result);
                    }

                    //compressionchiller
                    foreach ($chillerDatas as $chillerData) {
                        # iterate over the list of chillerDatas.
                        $chillerData['unique_row_id'] = $insertedId;
                        $result = CompressionChiller::create($chillerData);
                        //dd($result);
                    }

                    //heatSourceDatas
                    foreach ($heatSourceDatas as $heatSourceData) {
                        # iterate over the list of heatSourceDatas.
                        $heatSourceData['unique_row_id'] = $insertedId;
                        $result = HeatSource::create($heatSourceData);
                        //dd($result);
                    }

                    //heatingprofiles
                    foreach ($heatingprofiles as $heatingprofile) {
                        # iterate over the list of heatingprofiles.
                        $heatingprofile['unique_row_id'] = $insertedId;
                        $result = HeatingLoadProfile::create($heatingprofile);
                        //dd($result);
                    }
                    $fahrenheit['unique_row_id'] = $insertedId;
                    $fahrenheit_id = Fahrenheit::create($fahrenheit)->fahrenheit_id;
                    //chillerInfos
                    foreach ($chillerInfos as $chillerInfo) {
                        # iterate over the list of chillerInfos.
                        $chillerInfo['fahrenheit_id'] = $fahrenheit_id;
                        $result = Chiller::create($chillerInfo);
                            //dd($result);
                    }

                    //recoolings
                    foreach ($recoolings as $recooling) {
                        # iterate over the list of recoolings.
                        $recooling['fahrenheit_id'] = $fahrenheit_id;
                        $result = RecoolingSystem::create($recooling);
                            //dd($result);
                    }
                }
            } catch (\Throwable $th) {
                return $th;
            }

            try {
                app('App\Http\Controllers\MailController')->sendProjectEmailAdmin($generalData);
            } catch (Error $e) {
                return response()->json(['errors' => $e, 'key' => 'general']);
            }
        }

        return response()->json(['success' => 'Record is successfully added']);

    }
    public function storeProfileInformation(Request $request)
    {
        $validator = \Validator::make($request->all(), []);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->keys()]);
        }
        return response()->json(['success' => 'Record is successfully added']);

    }
    public function storeChillerInformation(Request $request)
    {
        $validator = \Validator::make($request->all(), []);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->keys()]);
        }
        return response()->json(['success' => 'Record is successfully added']);

    }
    public function storeRecoolerInformation(Request $request)
    {
        $validator = \Validator::make($request->all(), []);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->keys()]);
        }
        return response()->json(['success' => 'Record is successfully added']);

    }


    function getTemperatureMeteonorm()
    {
        $resArr = array();

        $myfile = file_get_contents(public_path() . '/location_data/berlin.txt');
        $resArr = json_decode($myfile, true);
        //print_r($resArr);
        // $sum =0;
        // foreach($resArr['payload']['meteonorm']['target'] as $result_arry)
        // {

        //   foreach($result_arry as $val)
        //   {
        //    $sum+=$val;
        //   }
        // }
        ///echo $sum;
       // print_r(array_column($resArr['payload']['meteonorm']['target'], 'ta'));
        $result = array_sum(array_column($resArr['payload']['meteonorm']['target'], 'ta')); // output 5
        return $result;
    }

    function coldWaterCircuit($tempIn, $Qlt, $vlt)
    {
        $_p = .999;
        $_cp = 4.18;
        $tempOut = $tempIn - ($Qlt * 3600) / ($_cp * $_p * $vlt);
        return $tempOut;
    }

    /*/*
      Function to calculate $a and $b for cooling capacity of sika
     */
    function calculateCoolingCapacity($ht_in, $lt_in, $chiller_type)
    {
        // $ht_in = ,$lt_in
       
        //'SELECT id,a,b,abs(ht-'.$ht_in.') as htdist, abs (lt-'.$lt_in.') as ltdist,ht,lt,(b*LN(25)+a) as Qlt,power(abs(ht-'.$ht_in.'),2) + power(abs(lt-'.$lt_in.'),2)*10 as dist FROM `calculations` order by dist limit 0,8'
   //     echo 'SELECT id,a,b,abs(ht-'.$ht_in.') as htdist, abs (lt-'.$lt_in.') as ltdist,ht,lt,(b*LN(25)+a) as Qlt FROM `calculations` where type_data ="'.$chiller_type.'" AND    ht in (select * from  (select distinct ht FROM calculations order by abs(ht-'.$ht_in.') LIMIT 0,2) as ht1 ) and lt in (select * from ( select distinct lt FROM calculations order by abs(lt-'.$lt_in.')LIMIT 0,2)as lt1) order by ht, lt';

        $res = DB::select('SELECT id,a,b,abs(ht-' . $ht_in . ') as htdist, abs (lt-' . $lt_in . ') as ltdist,ht,lt,(b*LN(25)+a) as Qlt FROM `calculations` where type_data ="' . $chiller_type . '" AND    ht in (select * from  (select distinct ht FROM calculations order by abs(ht-' . $ht_in . ') LIMIT 0,2) as ht1 ) and lt in (select * from ( select distinct lt FROM calculations order by abs(lt-' . $lt_in . ')LIMIT 0,2)as lt1) order by ht, lt');
        $temp = array();

        foreach ($res as $value) {

            $temp[] = $value;
        }
       // echo "<pre>";
     //  print_r($temp);
       // die;

      //  echo $ht_in." LT_____________".$lt_in;
        $temp = json_decode(json_encode($temp), true);
        //print_r($temp);

        if ($temp[0]['ht'] == $ht_in && $temp[0]['lt'] == $lt_in) {
         // take a0 and b0
 
          
          //echo "<br/>";
            $a6 = $temp[0]['a'];
            $b6 = $temp[0]['b'];
          //echo "a6==> ".$a6."</br>";
        //  echo "b6==> ".$b6."</br>";
        } else if ($temp[0]['ht'] == $ht_in) {
       // echo '2nd';
       //  echo "<br/>";


        // $a6= (($a2-$a0)/($temp[2]['lt']-$temp[0]['lt']))*($lt_in-$temp[0]['lt'])+$a0;
        // echo "a6==>".$a6."</br>";
        // $b6= (($b2-$b0)/($temp[2]['lt']-$temp[0]['lt']))*($lt_in-$temp[0]['lt'])+$b0;
        // echo "b6==>".$b6."</br>";


     //   echo '2nd';
     //    echo "<br/>";
            $a6 = (($temp[1]['a'] - $temp[0]['a']) / ($temp[1]['lt'] - $temp[0]['lt'])) * ($lt_in - $temp[0]['lt']) + $temp[0]['a'];
      //  echo "a6==> ".$a6."</br>";
            $b6 = (($temp[1]['b'] - $temp[0]['b']) / ($temp[1]['lt'] - $temp[0]['lt'])) * ($lt_in - $temp[0]['lt']) + $temp[0]['b'];
       // echo "b6==> ".$b6."</br>";


        } else if ($temp[0]['lt'] == $lt_in) {
       // echo '3rd';
       //  echo "<br/>";
            $a6 = (($temp[1]['a'] - $temp[0]['a']) / ($temp[1]['ht'] - $temp[0]['ht'])) * ($ht_in - $temp[0]['ht']) + $temp[0]['a'];
  //  echo "a4==> ".$a6."</br>";
            $b6 = (($temp[1]['b'] - $temp[0]['b']) / ($temp[1]['ht'] - $temp[0]['ht'])) * ($ht_in - $temp[0]['ht']) + $temp[0]['b'];
  //  echo "b4==> ".$b6."</br>";
        } else {

    // usort($temp,'sortByLt');

            usort($temp, 'self::sortByLt');
     // echo '4th';
     // echo "<br/>";
     // echo ($temp[1]['a']-$temp[0]['a']);
     // die;
            $a4 = (($temp[1]['a'] - $temp[0]['a']) / ($temp[1]['ht'] - $temp[0]['ht'])) * ($ht_in - $temp[0]['ht']) + $temp[0]['a'];

   // echo "a4==> ".$a4."</br>";
            $a5 = (($temp[3]['a'] - $temp[2]['a']) / ($temp[3]['ht'] - $temp[2]['ht'])) * ($ht_in - $temp[2]['ht']) + $temp[2]['a'];
    
    
    // echo "a5==> ".$a5."</br>";
            $a6 = (($a5 - $a4) / ($temp[2]['lt'] - $temp[0]['lt'])) * ($lt_in - $temp[0]['lt']) + $a4;
   // echo "a6==> ".$a6."</br>";
            $b4 = (($temp[1]['b'] - $temp[0]['b']) / ($temp[1]['ht'] - $temp[0]['ht'])) * ($ht_in - $temp[0]['ht']) + $temp[0]['b'];
   // echo "b4==> ".$b4."</br>";
            $b5 = (($temp[3]['b'] - $temp[2]['b']) / ($temp[3]['ht'] - $temp[2]['ht'])) * ($ht_in - $temp[2]['ht']) + $temp[2]['b'];
    ///echo "b5==> ".$b5."</br>";
            $b6 = (($b5 - $b4) / ($temp[2]['lt'] - $temp[0]['lt'])) * ($lt_in - $temp[0]['lt']) + $b4;
   // echo "b6==> ".$b6."</br>";

        }

        $final_array['a'] = $a6;
        $final_array['b'] = $b6;

        return $final_array;

    }
    private static function sortByLt($a, $b)
    {
        $a = $a['lt'];
        $b = $b['lt'];

        if ($a == $b) return 0;
        return ($a < $b) ? -1 : 1;
    }


    /*/*
      Function to calculate $a and $b  &c for thermal COP of sika
     */
    function calculateCopVariable($ht_in, $lt_in, $chiller_type)
    {
       
        
// echo "<br/>";
//   echo 'SELECT id,aa as a,bb as b,c,abs(ht-'.$ht_in.') as htdist, abs (lt-'.$lt_in.') as ltdist,ht,lt,(b*LN(25)+a) as Qlt FROM `calculations` where type_data ="'.$chiller_type.'" AND   ht in (select * from  (select distinct ht FROM calculations order by abs(ht-'.$ht_in.') LIMIT 0,2) as ht1 ) and lt in (select * from ( select distinct lt FROM calculations order by abs(lt-'.$lt_in.')LIMIT 0,2)as lt1) order by ht, lt';
//   die;
        $res = DB::select('SELECT id,aa as a,bb as b,c,abs(ht-' . $ht_in . ') as htdist, abs (lt-' . $lt_in . ') as ltdist,ht,lt,(b*LN(25)+a) as Qlt FROM `calculations` where type_data ="' . $chiller_type . '" AND   ht in (select * from  (select distinct ht FROM calculations order by abs(ht-' . $ht_in . ') LIMIT 0,2) as ht1 ) and lt in (select * from ( select distinct lt FROM calculations order by abs(lt-' . $lt_in . ')LIMIT 0,2)as lt1) order by ht, lt');
        $temp = array();

        foreach ($res as $value) {

            $temp[] = $value;
        }
       // echo "<pre>";
       // print_r($temp);
       // die;

      //  echo $ht_in." LT_____________".$lt_in;
        $temp = json_decode(json_encode($temp), true);

        if ($temp[0]['ht'] == $ht_in && $temp[0]['lt'] == $lt_in) {
         // take a0 and b0

          
        //  echo "<br/>";
            $a6 = $temp[0]['a'];
            $b6 = $temp[0]['b'];
            $c6 = $temp[0]['c'];
          //echo "a6==> ".$a6."</br>";
        //  echo "b6==> ".$b6."</br>";
        } else if ($temp[0]['ht'] == $ht_in) {
     // echo '2nd';
       //echo "<br/>";


        // $a6= (($a2-$a0)/($temp[2]['lt']-$temp[0]['lt']))*($lt_in-$temp[0]['lt'])+$a0;
        // echo "a6==>".$a6."</br>";
        // $b6= (($b2-$b0)/($temp[2]['lt']-$temp[0]['lt']))*($lt_in-$temp[0]['lt'])+$b0;
        // echo "b6==>".$b6."</br>";


     //   echo '2nd';
     //    echo "<br/>";
            $a6 = (($temp[1]['a'] - $temp[0]['a']) / ($temp[1]['lt'] - $temp[0]['lt'])) * ($lt_in - $temp[0]['lt']) + $temp[0]['a'];
      //  echo "a6==> ".$a6."</br>";

            $b6 = (($temp[1]['b'] - $temp[0]['b']) / ($temp[1]['lt'] - $temp[0]['lt'])) * ($lt_in - $temp[0]['lt']) + $temp[0]['b'];

            $c6 = (($temp[1]['c'] - $temp[0]['c']) / ($temp[1]['lt'] - $temp[0]['lt'])) * ($lt_in - $temp[0]['lt']) + $temp[0]['c'];
       // echo "b6==> ".$b6."</br>";


        } else if ($temp[0]['lt'] == $lt_in) {
       //echo '3rd';
        //echo "<br/>";
            $a6 = (($temp[1]['a'] - $temp[0]['a']) / ($temp[1]['ht'] - $temp[0]['ht'])) * ($ht_in - $temp[0]['ht']) + $temp[0]['a'];
  //  echo "a4==> ".$a6."</br>";
            $b6 = (($temp[1]['b'] - $temp[0]['b']) / ($temp[1]['ht'] - $temp[0]['ht'])) * ($ht_in - $temp[0]['ht']) + $temp[0]['b'];
  //  echo "b4==> ".$b6."</br>";
            $c6 = (($temp[1]['c'] - $temp[0]['c']) / ($temp[1]['ht'] - $temp[0]['ht'])) * ($ht_in - $temp[0]['ht']) + $temp[0]['c'];
        } else {

     //echo '4th';
     //echo "<br/>";
            usort($temp, 'self::sortByLt');
            $a4 = (($temp[1]['a'] - $temp[0]['a']) / ($temp[1]['ht'] - $temp[0]['ht'])) * ($ht_in - $temp[0]['ht']) + $temp[0]['a'];
   // echo "a4==> ".$a4."</br>";
            $a5 = (($temp[3]['a'] - $temp[2]['a']) / ($temp[3]['ht'] - $temp[2]['ht'])) * ($ht_in - $temp[2]['ht']) + $temp[2]['a'];
   // echo "a5==> ".$a5."</br>";
            $a6 = (($a5 - $a4) / ($temp[2]['lt'] - $temp[0]['lt'])) * ($lt_in - $temp[0]['lt']) + $a4;

   // echo "a6==> ".$a6."</br>";
            $b4 = (($temp[1]['b'] - $temp[0]['b']) / ($temp[1]['ht'] - $temp[0]['ht'])) * ($ht_in - $temp[0]['ht']) + $temp[0]['b'];
   // echo "b4==> ".$b4."</br>";
            $b5 = (($temp[3]['b'] - $temp[2]['b']) / ($temp[3]['ht'] - $temp[2]['ht'])) * ($ht_in - $temp[2]['ht']) + $temp[2]['b'];
    ///echo "b5==> ".$b5."</br>";
            $b6 = (($b5 - $b4) / ($temp[2]['lt'] - $temp[0]['lt'])) * ($lt_in - $temp[0]['lt']) + $b4;
   // echo "b6==> ".$b6."</br>";


            $c4 = (($temp[1]['c'] - $temp[0]['c']) / ($temp[1]['ht'] - $temp[0]['ht'])) * ($ht_in - $temp[0]['ht']) + $temp[0]['c'];
   // echo "b4==> ".$b4."</br>";
            $c5 = (($temp[3]['c'] - $temp[2]['c']) / ($temp[3]['ht'] - $temp[2]['ht'])) * ($ht_in - $temp[2]['ht']) + $temp[2]['c'];
    ///echo "b5==> ".$b5."</br>";
            $c6 = (($c5 - $c4) / ($temp[2]['lt'] - $temp[0]['lt'])) * ($lt_in - $temp[0]['lt']) + $c4;


        }

        $final_array['aa'] = $a6;
        $final_array['bb'] = $b6;
        $final_array['c'] = $c6;
  //  print_r($final_array);
        return $final_array;

    }







    /**
     * Calculation for CWU cost
     *
     */
    function calculateCWUCost($QN_CWU, $QN_CWUmax)
    {
        //return response()->json(array('cost'=>200));
        $Fcwu = 4732.2487 * pow($QN_CWU, -0.7382) + 109.3;
        //Investment costs
        $kcwuinvestment = $QN_CWU * $Fcwu;
        //Maintenance costs
        $kcwumaintainence = $QN_CWUmax * $Fcwu;
        return Response::json(array('investment' => $kcwuinvestment, 'maintenence' => $kcwuinvestment));
    }

    /***
     * Calculation for CHP cos.
     *
     */
    function calculateCHPCost($Pel)
    {
        //The costs of module are calculated by:
        $Km = a . pow($Pel, b) * $Pel;
        //The costs of transport are calculated by:
        $Kt = $Km * 0.06;
        //The costs of installation  are calculated by:
        $ki = $km * 0.39;
        $chpCost = $km + $kt + $ki;
        return Response::json(array('cost' => $chpCost));
    }

    function getCalConstant($chiller_type)
    {

        $cal_constant = DB::table('cal_constants')->where('chiller_type', $chiller_type)->first();
        return $cal_constant;
    }


    function getModType($mod_types_id)
    {
        $mod_type = DB::table('mod_types')->where('mod_types_id', $mod_types_id)->first();
        return $mod_type;
    }

    function getMachineVolumeFlow($mod_types_id)
    {
        $volume_flow = DB::table('machine_volume_flows')->where('mod_types_id', $mod_types_id)->first();
        return $volume_flow;
    }


    public function calculateData(Request $request)
    {

        $ht_in = $request->drive_temperature;
        $lt_in = $request->cold_water;
        $mt_in = $request->outdoor_temperature;

        $mod_types_id = $request->adsorption_chiller;
        $chiller_type = $request->chiller_type;

        $calculation_type = 'calculation'; //re
        $n_AsHt_input = 3;
        $n_AsLt_input = 2;
        //'eCoo10'=>'1',array('eCoo10'=>'1');  //array('eCoo20'=>'1');  //
        $chillerarray = array('eCoo10' => '1', 'eCoo20' => '1', 'eCoo30' => '1', 'eCoo10X' => '2', 'eCoo20X' => '2', 'eCoo30X' => '2', 'eCoo40X' => '2');


        $i = 0;

        $cal_out = array();

        foreach ($chillerarray as $key => $value) {

            $mod_types_id = $value;

            $chiller_type = $key;

            $temp_constant = $this->getCalConstant($chiller_type);

            $modtype = $this->getModType($mod_types_id);
            //   echo "<pre>";print_r($temp_constant);
            // echo "<pre>";print_r($modtype);//die;



            if ($calculation_type == 'calculation') {
                $adka_input['Tn_HtIn'] = $ht_in;
                $adka_input['Tn_MtIn'] = $mt_in;
                $adka_input['Tn_LtIn'] = $lt_in;
                $adka_input['Mod_Ad'] = $modtype->mod_type;
                $adka_input['Mod_ad_id'] = $modtype->mod_types_id;

                $adka_input['n_AsHt'] = $temp_constant->n_AsHt;
                $adka_input['n_AsLt'] = $temp_constant->n_AsLt;
                $adka_input['n_ApHt'] = $temp_constant->n_ApHt;
                $adka_input['n_ApLt'] = $temp_constant->n_ApLt;
                $adka_input['cal_constants_id'] = $temp_constant->cal_constants_id;

                $output = $this->calculateADKA($adka_input);


                $cal_out[$i]['product_name'] = $key;
                $cal_out[$i]['cooling_capacity'] = number_format($output['Qth_Lt'], 1, '.', '') . " kW";  // $output['Qth_Lt'];
                $cal_out[$i]['driving_heat'] = number_format($output['Qth_Ht'], 1, '.', '') . " kW";

                $cal_out[$i]['driving_temp_outlet'] = number_format($output['Tn_HtOut'], 1, '.', '');
                $cal_out[$i]['cold_water_temp_outlet'] = number_format($output['Tn_LtOut'], 1, '.', '');
                $cal_out[$i]['recooling_temp_outlet'] = number_format($output['Tn_MtOut'], 1, '.', '');
                $i++;
            } else {   
                //echo  $key; echo "<br/>";
                $total_modules = $temp_constant->total_module;
                $n_ApHt_calculated = round($total_modules / $n_AsHt_input); //number of modules/n_AsHt ; 

                // echo "<br/>";
                $n_ApLt_calculated = round($total_modules / $n_AsLt_input); //number of modules/n_AsHt ; 
                //  echo "<br/>";

                if ((($n_AsHt_input * $n_ApHt_calculated) == $total_modules) && (($n_AsLt_input * $n_ApLt_calculated) == $total_modules)) {
                    $adka_input['Tn_HtIn'] = $ht_in;
                    $adka_input['Tn_MtIn'] = $mt_in;
                    $adka_input['Tn_LtIn'] = $lt_in;
                    $adka_input['Mod_Ad'] = $modtype->mod_type;
                    $adka_input['Mod_ad_id'] = $modtype->mod_types_id;

                    $adka_input['n_AsHt'] = $n_AsHt_input;
                    $adka_input['n_AsLt'] = $n_AsLt_input;
                    $adka_input['n_ApHt'] = $n_ApHt_calculated;
                    $adka_input['n_ApLt'] = $n_ApLt_calculated;
                    $adka_input['cal_constants_id'] = $temp_constant->cal_constants_id;


                    //print_r($adka_input);die;
                    $output = $this->calculateADKA($adka_input);


                    $cal_out[$i]['product_name'] = $key;
                    $cal_out[$i]['cooling_capacity'] = number_format($output['Qth_Lt'], 1, '.', '') . " kW";  // $output['Qth_Lt'];
                    $cal_out[$i]['driving_heat'] = number_format($output['Qth_Ht'], 1, '.', '') . " kW";

                    $cal_out[$i]['driving_temp_outlet'] = number_format($output['Tn_HtOut'], 1, '.', '');
                    $cal_out[$i]['cold_water_temp_outlet'] = number_format($output['Tn_LtOut'], 1, '.', '');
                    $cal_out[$i]['recooling_temp_outlet'] = number_format($output['Tn_MtOut'], 1, '.', '');
                    $i++;

                } else {

                    $i++;
                }

            }


        }
        if (empty($cal_out)) {
            $cal_out[0]['no_record'] = 'false';
        }
    //echo "<pre>";print_r($cal_out);
// // die;

        return response()->json($cal_out);

    }

    /** 
     * Calculation adka ppt 2 Calculation of an ADKA
     */
    function calculateADKA($adka_input)
    {

        DB::table('adka_calculations')->truncate();

        $Mod_Ad = $adka_input['Mod_Ad'];
        $Mod_ad_id = $adka_input['Mod_ad_id'];
        $Tn_HtIn = $adka_input['Tn_HtIn'];
        $Tn_MtIn = $adka_input['Tn_MtIn'];
        $Tn_LtIn = $adka_input['Tn_LtIn'];
        $n_AsHt = $adka_input['n_AsHt'];
        $n_AsLt = $adka_input['n_AsLt'];
        $n_ApHt = $adka_input['n_ApHt'];
        $n_ApLt = $adka_input['n_ApLt'];
        $cal_constants_id = $adka_input['cal_constants_id'];

        if (($n_AsHt * $n_ApHt) == ($n_AsLt * $n_ApLt)) {
        // echo 'correct';

            $data['tn_htIn'] = $Tn_HtIn;
            $data['tn_mtIn'] = $Tn_MtIn;      // if user not provided the company , can later change
            $data['tn_ltIn'] = $Tn_LtIn;
            $data['cal_constants_id'] = $cal_constants_id;

            $result = AdkaCalculation::create($data)->id;
            $adka_calculations_id = DB::getPdo()->lastInsertId();


            $adka_data['adka_calculations_id'] = $adka_calculations_id;
            $adka_data['Mod_Ad'] = $Mod_Ad;
            $adka_data['Tn_HtIn'] = $Tn_HtIn;
            $adka_data['n_AsHt'] = $n_AsHt;
            $adka_data['n_ApHt'] = $n_ApHt;
            $adka_data['Mod_ad_id'] = $Mod_ad_id;


        // $adka_data_lt['adka_calculations_id'] = $adka_calculations_id;
            $adka_data_lt['Mod_Ad'] = $Mod_Ad;
            $adka_data_lt['Tn_LtIn'] = $Tn_LtIn;
            $adka_data_lt['n_AsLt'] = $n_AsLt;
            $adka_data_lt['n_ApLt'] = $n_ApLt;
            $adka_data_lt['Mod_ad_id'] = $Mod_ad_id;

      //  print_r($adka_data);
            $ht_array = $this->calculateSerialHTConnection($adka_data);
     //  $Qth_Lt1 = $ht_array['Qth_LtAd'];

      
       // print_r($ht_array);
       // die;
            $lt_array = $this->calculateSerialLTConnection($adka_data_lt);
// die;

            $adka_final = $this->finalAdkaCalculation($n_ApHt, $n_AsHt, $n_ApLt);

        } else {
            $adka_final['error'] = 'error';
        }


        return $adka_final;
    }
    /**
     * 2.1 calculation for serial connection of HT  $Mod_Ad,$Tn_HtIn,$n_AsHt,$n_ApHt
     */
    function calculateSerialHTConnection($ht_array)
    {
            //echo "<pre>";

        $adka_calculations_id = $ht_array['adka_calculations_id'];
        $Mod_Ad = $ht_array['Mod_Ad'];
        $Tn_HtIn = $ht_array['Tn_HtIn'];
        $n_AsHt = $ht_array['n_AsHt'];
       // echo "<br/>";
        $n_ApHt = $ht_array['n_ApHt'];
        $Mod_ad_id = $ht_array['Mod_ad_id'];
       // print_r($ht_array);

        $i_Ad = 1;
        $i_Ap = 1;
        $i_As = 1;
        $Tn_HtI = $Tn_HtIn;



        if ($i_Ap == 1) {
                //echo "**********";    echo "<br/>";
            $output = $this->addHtSerialCalculation($adka_calculations_id, $Mod_Ad, $Tn_HtI, $Mod_ad_id, 'update');
        }
        for ($i_Ap = 1; $i_Ap <= $n_ApHt; ) {
       // for($i_Ad = 1 ; $i_Ad<=$n_ApHt;){
// echo  $i_Ad."_i_Ad";
//  echo "<br/>" ;
//  echo  $i_As."i_As";
//   echo "<br/>" ;




            if ($i_As == $n_AsHt) {
          // echo '*';

                if ($i_Ap == $n_ApHt) {
              //echo 'return ';die;
                    return $output;
                } else {


                    $Tn_HtI = $output['Tht_in'];  
                 
 // echo "______________"; echo "<br/>" ;echo "<br/>";
                    $output = $this->addHtSerialCalculation($adka_calculations_id, $Mod_Ad, $Tn_HtI, $Mod_ad_id, 'add');

                    $i_Ap = $i_Ap + 1;
                    $i_As = 1;
                    $i_Ad = $i_Ad + 1;
                }

            } else { 
            // echo "<br/>";
            //  echo '%%%';
            //  echo "<br/>";



                $Tn_HtI = number_format($output['Tht_out'], 1, '.', ''); //$output['Tht_out'];
               
 // echo "__rrrrrrrrrrrrrrrr"; echo "<br/>" ;echo "<br/>";
                $output = $this->addHtSerialCalculation($adka_calculations_id, $Mod_Ad, $Tn_HtI, $Mod_ad_id, 'add');
        
           
         // echo "<br/>";
                $i_As = $i_As + 1;
                $i_Ad = $i_Ad + 1;

            }

        }

    }

    function addHtSerialCalculation($adka_calculations_id, $Mod_Ad, $Tn_HtI, $Mod_ad_id, $action)
    {
        $adka_info = DB::table('adka_calculations')->where('adka_calculations_id', $adka_calculations_id)->first();

        // echo "<pre>";print_r($adka_info);die;
        $Tn_LtIn = $adka_info->tn_ltIn;
        // echo "<br/>";
        $tn_mtIn = $adka_info->tn_mtIn;
        $cal_constants_id = $adka_info->cal_constants_id;

        $output = $this->calculateModuleValue($Mod_Ad, $Tn_HtI, $tn_mtIn, $Tn_LtIn, $Mod_ad_id);
     
     //   echo "<pre>";print_r($output);
        // die;
     //  store value in database

 // die;

      //  $data['adka_calculations_id'] =  $adka_calculations_id ;

        $data['tn_htIn'] = $output['Tht_in'];
        $data['tn_mtIn'] = $output['Tmt_in'];      // if user not provided the company , can later change
        $data['tn_ltIn'] = $output['Tlt_in'];
        $data['cal_constants_id'] = $cal_constants_id;
        $data['qth_lt'] = $output['Qth_LtAd'];
        $data['qth_ht'] = $output['Qth_HtAd'];
        $data['qth_mt'] = $output['Qth_MtAd'];
        $data['cop_th'] = $output['COP'];
        $data['tn_htout'] = $output['Tht_out'];
        $data['tn_mtout'] = $output['Tmt_out'];
        $data['tn_ltout'] = $output['Tlt_out'];
        $data['vf_ht'] = $output['vht'];
        $data['vf_mt'] = $output['vmt'];
        $data['vf_lt'] = $output['vlt'];

        if ($action == 'update') {
            $ad_cal = AdkaCalculation::findOrFail($adka_calculations_id);
            $ad_cal->update($data);
        } else {

            $result = AdkaCalculation::create($data)->id;
            $adka_calculations_id = DB::getPdo()->lastInsertId();
        }


        return $output;
    }


    /**
     * 2.1 calculation for serial connection of LT  $Mod_Ad,$Tn_LtIn,$n_AsLt,$n_ApLt
     */
    function calculateSerialLTConnection($lt_array)
    {
           //die;

       // $adka_calculations_id = $lt_array['adka_calculations_id'];
        $Mod_Ad = $lt_array['Mod_Ad'];
        $Tn_LtIn = $lt_array['Tn_LtIn'];
        $n_AsLt = $lt_array['n_AsLt'];
        $n_ApLt = $lt_array['n_ApLt'];
        $Mod_ad_id = $lt_array['Mod_ad_id'];

       // print_r($lt_array);

        $i_Ad = $n_AsLt * $n_ApLt;
        $i_Ap = 1;
        $i_As = 1;
        $Tn_LtI = $Tn_LtIn;
        $action = 'update';

        $offset = $i_Ad;

        for ($i_Ap == 1; $i_Ap <= $n_ApLt; ) {


            if ($i_Ap == 1) {
                $output = $this->addLTSerialCalculation($Mod_Ad, $Tn_LtI, $Mod_ad_id, $action, $offset);
            }


            if ($i_As == $n_AsLt) {


                if ($i_Ap == $n_ApLt) {
                    return $output;
                } else {


                    $Tn_LtI = $output['Tlt_in'];
                    $action = 'update';

                    $output = $this->addLTSerialCalculation($Mod_Ad, $Tn_LtI, $Mod_ad_id, $action, $offset);

                    $i_Ap = $i_Ap + 1;
                    $i_As = 1;
                    $i_Ad = $i_Ad - 1;
                    $offset = $i_Ad;
                }

            } else {

                $offset = $i_Ad;


                $Tn_LtI = number_format($output['Tlt_out'], 1, '.', ''); //$output['Tht_out']; //$output['Tlt_out'];

                $output = $this->addLTSerialCalculation($Mod_Ad, $Tn_LtI, $Mod_ad_id, $action, $offset);
                $i_As = $i_As + 1;
                $i_Ad = $i_Ad + 1;
            }

        }
      

     // print_r($data);
       // $result = AdkaCalculation::update($data)->id;
        //$adka_calculations_id = DB::getPdo()->lastInsertId();
    }
    function addLTSerialCalculation($Mod_Ad, $Tn_LtI, $Mod_ad_id, $action, $offset)
    {
        //SELECT * FROM adka_calculations ORDER BY adka_calculations_id DESC LIMIT 1
        $adka_info = DB::table('adka_calculations')->orderBy('adka_calculations_id')->offset($offset - 1)->limit(1)->first();  // toSql(); 
      //  $adka_info = DB::table('adka_calculations')->orderBy('adka_calculations_id', 'asc')->get();
       // dd($adka_info);
       // die;

        //echo "<pre>";print_r($adka_info);die;
        $Tn_HtIn = $adka_info->tn_htIn;
        // echo "<br/>";

     //   echo "<pre>";print_r($adka_info);die;
        $tn_mtIn = $adka_info->tn_mtIn;
        $cal_constants_id = $adka_info->cal_constants_id;

        $output = $this->calculateModuleValue($Mod_Ad, $Tn_HtIn, $tn_mtIn, $Tn_LtI, $Mod_ad_id);
     
        // echo "<pre>";print_r($output);
        // // store value in database

        // // die;
        $adka_calculations_id = $adka_info->adka_calculations_id;

        $data['adka_calculations_id'] = $adka_calculations_id;

        $data['tn_htIn'] = $output['Tht_in'];
        $data['tn_mtIn'] = $output['Tmt_in'];      // if user not provided the company , can later change
        $data['tn_ltIn'] = $output['Tlt_in'];
        $data['cal_constants_id'] = $cal_constants_id;
        $data['qth_lt'] = $output['Qth_LtAd'];
        $data['qth_ht'] = $output['Qth_HtAd'];
        $data['qth_mt'] = $output['Qth_MtAd'];
        $data['cop_th'] = $output['COP'];
        $data['tn_htout'] = $output['Tht_out'];
        $data['tn_mtout'] = $output['Tmt_out'];
        $data['tn_ltout'] = $output['Tlt_out'];
        $data['vf_ht'] = $output['vht'];
        $data['vf_mt'] = $output['vmt'];
        $data['vf_lt'] = $output['vlt'];

        if ($action == 'update') {
            $ad_cal = AdkaCalculation::findOrFail($adka_calculations_id);
            $ad_cal->update($data);
        } else {

            $result = AdkaCalculation::create($data)->id;
            $adka_calculations_id = DB::getPdo()->lastInsertId();
        }


        return $output;
    }

    function finalAdkaCalculation($n_ApHt, $n_AsHt, $n_ApLt)
    {
        $i_Ad = 1;
        $adka_count = DB::table('adka_calculations')->count();

        $n_AdMax = $adka_count;

        // for($i_Ad; $i_Ad <$n_AdMax;)
        // {

        //      $adka_count = DB::table('adka_calculations')->count();


        // }
        $result = DB::table('adka_calculations')->get();
        $result = json_decode(json_encode($result), true);
     //    echo count($result);
    //  echo "<pre>";   print_r($result);
     //    die;
        $Qth_Lt = 0;
        $Qth_Ht = 0;
        $Qth_Mt = 0;
        $Tn_HtOut = '';
        $Tn_LtIn = '';
        $COPth = '';
        $Vf_Ht = '';
        $Vf_Mt = '';
        $Vf_Lt = '';

        $i = 0;


        foreach ($result as $value) {
            // echo $value['qth_lt'];
            // die;
            $Qth_Lt = $Qth_Lt + $value['qth_lt'];

            $Qth_Ht = $Qth_Ht + $value['qth_ht'];

            $Qth_Mt = $Qth_Mt + $value['qth_mt'];



            if ($i == 0) {
                $Tn_HtIn = $value['tn_htIn'];
                $Tn_MtIn = $value['tn_mtIn'];
                $Tn_LtOut = $value['tn_ltout'];



            }
            // else if(($n_AdMax -1) == $i)
            // {
              //  echo 'dd';
            $Tn_HtOut = $value['tn_htout'];
            $Tn_LtIn = $value['tn_ltIn'];
            $COPth = $Qth_Lt / $Qth_Ht;
            $Vf_Ht = $value['vf_ht'] * $n_ApHt;
            $Vf_Mt = $value['vf_mt'] * $n_ApHt * $n_AsHt;
            $Vf_Lt = $value['vf_lt'] * $n_ApLt;

            //}
            $i++;
        }


       // $Qth_Mt =  $Qth_Mt*-1000;  //=B21*-1000

        $adka_final['Qth_Lt'] = $Qth_Lt;
        $adka_final['Qth_Ht'] = $Qth_Ht;
        $adka_final['Qth_Mt'] = $Qth_Mt;
        $adka_final['COPth'] = $COPth;



        $adka_final['Vf_Ht'] = $Vf_Ht;

        $adka_final['Vf_Mt'] = $Vf_Mt;
        $adka_final['Vf_Lt'] = $Vf_Lt;







        $Tn_MtOut = $this->calculateOutletTempMt($Qth_Mt, $Tn_MtIn, $Vf_Mt, $medium = 'water');
       // $Tn_HtOut =  $Tn_HtOut;   // $this->calculateOutletTempHt($Qth_Ht,$Tn_HtIn,$Vf_Ht,$medium ='water');
       // $Tn_LtOut =   $Tn_LtOut; // $this->calculateOutletTempLt($Qth_Lt,$Tn_LtIn,$Vf_Lt,$medium ='water');

        $adka_final['Tn_MtOut'] = $Tn_MtOut;
        $adka_final['Tn_HtOut'] = $Tn_HtOut;
        $adka_final['Tn_LtOut'] = $Tn_LtOut;


      // echo "<pre>";   print_r($adka_final);
      // die;


        return $adka_final;


    }
    /**
     * function to calculate outlet temperatures 
     */
    function calculateOutletTempMt($Qth, $Tn_In, $Vf, $medium)
    {
        $Qth = $Qth * -1000;
        $rho = 0.993991038; // f(Tn_In, medium) (Coolprop)
        $cp = 1.160973538;  //f(Tn_In, medium) (CoolProp)

        $Tn_Out = $Tn_In - (($Qth) / ($Vf * $rho * $cp));

        return $Tn_Out;

    }

    function calculateOutletTempHT($Qth, $Tn_In, $Vf, $medium)
    {
        $Qth = $Qth * 1000;
        $rho = 0.993991038; // f(Tn_In, medium) (Coolprop)
        $cp = 1.160973538;  //f(Tn_In, medium) (CoolProp)

        $Tn_HtOut = $Tn_In - (($Qth) / ($Vf * $rho * $cp));

        return $Tn_HtOut;

    }

    function calculateOutletTempLT($Qth, $Tn_In, $Vf, $medium)
    {
        $Qth = $Qth * 1000;
        $rho = 0.993991038; // f(Tn_In, medium) (Coolprop)
        $cp = 1.160973538;  //f(Tn_In, medium) (CoolProp)

        $Tn_LtOut = $Tn_In - (($Qth) / ($Vf * $rho * $cp));

        return $Tn_LtOut;

    }

    function calculateModuleValue($Mod_Ad, $Tn_HtI, $Tn_MtIn, $Tn_LtIn, $Mod_ad_id)
    {   
        //Contants 
        $_p = 0.993991038; //0.999;

        $_cp = 1.160973538; //4.18
 //4.18;

        $volume_flow = $this->getMachineVolumeFlow($Mod_ad_id);
        $vlt = $volume_flow->vf_lt;
        $vht = $volume_flow->vf_ht;
        $vmt = $volume_flow->vf_mt;
       // echo $Mod_Ad;die;

        $final_ab_value = $this->calculateCoolingCapacity($Tn_HtI, $Tn_LtIn, $Mod_Ad);      
        
        //cooling capcity
        $Qlt = $this->calculateQLT($final_ab_value, $Tn_MtIn);


        $final_abc_value = $this->calculateCopVariable($Tn_HtI, $Tn_LtIn, $Mod_Ad);

        //cop value
        $COP = $this->calculateCOP($final_abc_value, $Tn_MtIn);

        // heat capacity
        $Qht = $this->calculateHeatCapacity($COP, $Qlt);
   
        //recooling capacity
        $Qmt = $this->calculateRecoolingCapacity($Qlt, $Qht, $COP);

        $Tltout = $this->calculateOutletTempLt($Qlt, $Tn_LtIn, $vlt, $medium = 'water');//$this->calculateOutletTemperatureLT($Tn_LtIn,$Qlt,$_p,$_cp,$vlt);

        $Thtout = $this->calculateOutletTempHt($Qht, $Tn_HtI, $vht, $medium = 'water');  ///$this->calculateOutletTemperatureHT($Tn_HtI,$Qht,$_p,$_cp,$vht);
        $Tmtout = $this->calculateOutletTemperatureMT($Tn_MtIn, $Qmt, $_p, $_cp, $vmt);

        $output['a'] = $final_ab_value['a'];
        $output['b'] = $final_ab_value['b'];
        $output['Qth_LtAd'] = number_format((float)$Qlt, 4, '.', '');

        $output['aa'] = $final_abc_value['aa'];
        $output['bb'] = $final_abc_value['bb'];
        $output['c'] = $final_abc_value['c'];
        $output['COP'] = number_format((float)$COP, 4, '.', '');

        $output['Qth_HtAd'] = number_format((float)$Qht, 4, '.', '');

        $output['Qth_MtAd'] = number_format((float)$Qmt, 4, '.', '');
        $output['Tlt_in'] = $Tn_LtIn;
        $output['Tlt_out'] = $Tltout;   ///number_format((float)$Tltout, 4, '.', ''); 
        $output['Tht_in'] = $Tn_HtI;
        $output['Tht_out'] = $Thtout; ////number_format((float)$Thtout, 4, '.', ''); 
        $output['Tmt_in'] = $Tn_MtIn;
        $output['Tmt_out'] = number_format((float)$Tmtout, 4, '.', '');
        $output['vlt'] = $vlt;
        $output['vht'] = $vht;
        $output['vmt'] = $vmt;


        return $output;
    }

    /**
     *  Function to calculate necessary drive heat” (Qth_LtAd) in kW
     *  cooling capacity Qth_LtAd or Qth_Lt
     */
    function calculateQLT($final_array, $mt_in)
    {
        $_a = $final_array['a'];
        $_b = $final_array['b'];

        $Qlt = $_b * (float)log($mt_in) + $_a;
        return $Qlt;
    }

    /**
     *  Function to calculate COP or COPth
     */
    function calculateCOP($final_array, $mt_in)
    {
        $_a = $final_array['aa'];
        $_b = $final_array['bb'];
        $_c = $final_array['c'];

        $cop = $_a + ($_b * $mt_in) + $_c * (pow($mt_in, 2));
        return $cop;

    }

    /**
     *  Function to calculate necessary drive heat” (Qth_HtAd) in kW
     *  heat capacity Qth_HtAd or Qth_Ht
     */
    function calculateHeatCapacity($COP, $Qlt)
    {
        $Qht = $Qlt / $COP;
        return $Qht;
    }

    /**
     *  Function to calculate Recooling capacity” (Qth_MtAd) in kW
     *   Recooling capacity Qth_MtAd or Qth_Mt
     */
    function calculateRecoolingCapacity($Qlt, $Qht, $Cop)
    {
        $Qmt = $Qlt + $Qht;
        return $Qmt;

    }

    /**
     *  Function to calculate Outlet temperature of LT” 
     *   TLtout or Tn_LtOut
     */
    function calculateOutletTemperatureLT($Tn_LtIn, $Qlt, $_p, $_cp, $vlt)
    {



        $Tltout = $Tn_LtIn - ($Qlt * 3600) / ($_cp * $_p * $vlt);
        return $Tltout;
    }

    /**
     *  Function to calculate Outlet temperature of HT” 
     *   THtout or Tn_HtOut
     */
    function calculateOutletTemperatureHT($Tn_HtIn, $Qht, $_p, $_cp, $vht)
    {

        $THtout = $Tn_HtIn - ($Qht * 3600) / ($_cp * $_p * $vht);
        return $THtout;
    }

    /**
     *  Function to calculate Outlet temperature of MT” 
     *   THtout or Tn_HtOut
     */
    function calculateOutletTemperatureMT($Tn_MtIn, $Qmt, $_p, $_cp, $vmt)
    {

        $TMtout = $Tn_MtIn + ($Qmt * 3600) / ($_cp * $_p * $vmt);
        return $TMtout;
    }







    function calculateAdsorptionSystem($Tn_AirIn, $Tn_AirInMin, $Tn_MtInMin, $Qth_NomSt, $dT_NomSt, $n_St, $Qth_NomRk, $dT_NomRk, $n_Rk)
    {

        $Tn_AirIn = 12; // Which value associated with it form meteonorm = ta
        $Tn_AirInMin = 17;
        $Tn_MtInMin = 23;

        //if true
        if ($Tn_AirIn < $Tn_AirInMin) {

            $Set_MtIn = 1;
            $Tn_MtIn = $Tn_MtInMin;
            $Qth_MtRk1 = 0;




        } else {
            $dT_St = $dT_NomSt;
            $dT_RkMin = $dT_NomRk;
            $Qth_MtRk1 = 0;
            $Set_MtIn = 0;
            $Tn_MtIn = $Tn_AirIn + $dT_St + $dT_RkMin;
        }

        $cooling_array['Mod_Ad'] = $Mod_Ad;
        $cooling_array['Mod_Cwu'] = $Mod_Cwu;
        $cooling_array['Qth_HeatMax'] = $Qth_HeatMax;
        $cooling_array['Tn_HtIn'] = $Tn_HtIn;
        $cooling_array['Tn_MtIn'] = $Tn_MtIn;
        $cooling_array['Tn_LtIn'] = $Tn_LtIn;
        $cooling_array['n_AsHt'] = $n_AsHt;
        $cooling_array['n_AsLt'] = $n_AsLt;
        $cooling_array['n_ApHt'] = $n_ApHt;
        $cooling_array['n_ApLt'] = $n_ApLt;

            //$resultCoolingSystemArr = $this->calculateCoolingSystem($Mod_Ad, $Mod_Cwu, $Qth_HeatMax, $Tn_HtIn, $Tn_MtIn, $Tn_LtIn, $n_AsHt, $n_AsLt, $n_ApHt, $n_ApLt);
        $resultCoolingSystemArr = $this->calculateCoolingSystem($cooling_array);

        $Qth_MtRk_out = $resultCoolingSystemArr['Qth_MtAd'] + $resultCoolingSystemArr['Qth_MtCwu'];

        if ($Qth_MtRk1 == $Qth_MtRk_out) {
            if ($Tn_MtIn < $Tn_MtInMin) {

                $Set_MtIn = 1;
                $Tn_MtIn = $Tn_MtInMin;
                $Qth_MtRk1 = 0;

            } else {
                $dT_Rk = $Tn_MtIn - $dT_St - $Tn_AirIn;

            }
        } else {
            $Qth_MtRk1 = $resultCoolingSystemArr['Qth_MtAd'] + $resultCoolingSystemArr['Qth_MtCwu'];
        }

        $recooling_array['type_Rk'] = $type_Rk;
        $recooling_array['Tn_MtInMin'] = $Tn_MtInMin;
        $recooling_array['Tn_AirIn'] = $Tn_AirIn;
        $recooling_array['p_AirIn'] = $p_AirIn;
        $recooling_array['Rh_AirIn'] = $Rh_AirIn;
        $recooling_array['Qth_MtAd'] = $Qth_MtAd;
        $recooling_array['Qth_MtCwu'] = $Qth_MtCwu;
        $recooling_array['Qth_NomSt'] = $Qth_NomSt;
        $recooling_array['dT_NomSt'] = $dT_NomSt;
        $recooling_array['n_St'] = $n_St;
        $recooling_array['Qth_NomRk'] = $Qth_NomRk;
        $recooling_array['dT_NomRk'] = $dT_NomRk;
        $recooling_array['n_Rk'] = $n_Rk;

        $resultRecoolingSystemArr = $this->calculateRecoolingSystem($recooling_array);
       // $resultRecoolingSystemArr=$this->calculateRecoolingSystem($type_Rk, $Tn_MtInMin, $Tn_AirIn, $p_AirIn, $Rh_AirIn, $Qth_MtAd, $Qth_MtCwu, $Qth_NomSt, $dT_NomSt, $n_St, $Qth_NomRk, $dT_NomRk, $n_Rk);
        if ($Set_MtIn == 1) {
            $dT_St = $resultRecoolingSystemArr['dT_St'];
            $dT_RkMin = $resultRecoolingSystemArr['dT_RkMin'];

            $dT_Rk = $Tn_MtIn - $dT_St - $Tn_AirIn;
        } else {
            $Tn_MtIn = $Tn_AirIn + $dT_St + $dT_RkMin;
        }

        return array('dT_St' => $dT_St, 'dT_Rk' => $dT_Rk, 'dT_RkMin' => $dT_RkMin, 'Tn_MtIn' => $Tn_MtIn);



    }

    /**
     * Function to find cooling system  $Mod_Ad, $Mod_Cwu, $Qth_HeatMax, $Tn_HtIn, $Tn_MtIn, $Tn_LtIn, $n_AsHt, $n_AsLt, $n_ApHt, $n_ApLt
     */

    function calculateCoolingSystem($cooling_array)
    {

        $Mod_Ad = $cooling_array['Mod_Ad'];
        $Mod_Cwu = $cooling_array['Mod_Cwu'];
        $Qth_HeatMax = $cooling_array['Qth_HeatMax'];
        $Tn_HtIn = $cooling_array['Tn_HtIn'];
        $Tn_MtIn = $cooling_array['Tn_MtIn'];
        $Tn_LtIn = $cooling_array['Tn_LtIn'];
        $n_AsHt = $cooling_array['n_AsHt'];
        $n_AsLt = $cooling_array['n_AsLt'];
        $n_ApHt = $cooling_array['n_ApHt'];
        $n_ApLt = $cooling_array['n_ApLt'];

            //$adka_input['Mod_Ad'] = $modtype->mod_type;
        $cooling_array['Mod_ad_id'] = 1;// $modtype->mod_types_id;
            // $adka_input['Tn_HtIn'] = $ht_in;
            // $adka_input['Tn_MtIn'] = $mt_in;
            // $adka_input['Tn_LtIn'] = $lt_in;
            // $adka_input['n_AsHt'] = $temp_constant->n_AsHt;
            // $adka_input['n_AsLt'] = $temp_constant->n_AsLt;
            // $adka_input['n_ApHt'] = $temp_constant->n_ApHt;
            // $adka_input['n_ApLt'] = $temp_constant->n_ApLt;
        $cooling_array['cal_constants_id'] = 1; //$temp_constant->cal_constants_id;

        $adka_output = $this->calculateADKA($cooling_array);
        $Qth_MtAd = $adka_output['Qth_Mt'];

        $Qth_MtCwu = 0; //$this->calculateCWU();  // for now 0;
        $this->calculateMaxCapacityHeatSource();
        return array('Qth_MtAd' => $Qth_MtAd, 'Qth_MtCwu' => $Qth_MtCwu);
    }
    //$type_Rk, $Tn_MtInMin, $Tn_AirIn, $p_AirIn, $Rh_AirIn, $Qth_MtAd, $Qth_MtCwu, $Qth_NomSt, $dT_NomSt, $n_St, $Qth_NomRk, $dT_NomRk, $n_Rk
    function calculateRecoolingSystem($recooling_array)
    {


        $type_Rk = $recooling_array['type_Rk'];
        $Tn_MtInMin = $recooling_array['Tn_MtInMin'];
        $Tn_AirIn = $recooling_array['Tn_AirIn'];
        $p_AirIn = $recooling_array['p_AirIn'];
        $Rh_AirIn = $recooling_array['Rh_AirIn'];
        $Qth_MtAd = $recooling_array['Qth_MtAd'];
        $Qth_MtCwu = $recooling_array['Qth_MtCwu'];
        $Qth_NomSt = $recooling_array['Qth_NomSt'];
        $dT_NomSt = $recooling_array['dT_NomSt'];
        $n_St = $recooling_array['n_St'];
        $Qth_NomRk = $recooling_array['Qth_NomRk'];
        $dT_NomRk = $recooling_array['dT_NomRk'];
        $n_Rk = $recooling_array['n_Rk'];

        $dT_St = $this->calculateSystemSepration($Qth_MtAd, $Qth_NomSt, $dT_NomSt, $n_St);
        switch ($type_Rk) {
            case 'closed recooler':
                $dT_RkMin = $this->calculateClosedRecooler($Qth_MtAd, $Qth_MtCwu, $Qth_NomRk, $dT_NomRk, $n_Rk);
                break;
            case 'open recooler':
                $dT_RkMin = $this->calculateOpenRecooler($Tn_AirIn, $p_AirIn, $Rh_AirIn, $Tn_MtIn, $dT_St);
                break;
            case 'springs/geothermal':
                $dT_RkMin = 0;
                break;

            default:
                $dT_RkMin = 0;
                break;
        }
        return array('dT_St' => $dT_St, 'dT_RkMin' => $dT_RkMin);

    }
    /**
     * calculate System Sepration
     *
     */

    function calculateSystemSepration($Qth_MtAd, $Qth_NomSt, $dT_NomSt, $n_St)
    {
        if ($Qth_NomSt = 0 || $n_St = 0) {
            $dT_St = 0;
        } else {
            $Qth_MtSt = $Qth_MtAd;
            $dT_St = $Qth_MtSt * $dt_NomSt / ($Qth_NomSt * $n_St);
        }
        return $dT_St;
    }
    /**
     * calculate Closed Recooler
     *
     */
    function calculateClosedRecooler($Qth_MtAd, $Qth_MtCwu, $Qth_NomRk, $dT_NomRk, $n_Rk)
    {
        $Qth_MtRk = $Qth_MtAd + $Qth_MtCwu;
        $dT_RkMin = $Qth_MtRk * $dt_NomRk / ($Qth_NomRk * $n_Rk);
        return $dT_RkMin;
    }
    /**
     *  calculate Open Recooler
     */
    function calculateOpenRecooler($Tn_AirIn, $p_AirIn, $Rh_AirIn, $Tn_MtIn, $dT_St)
    {
        //$Tn_WbAirIn = f(Tn_AirIn, p_AirIn, Rh_AirIn) (Coolprop);
        $Tn_RkIn = $Tn_MtIn + $dT_St;
        $Tn_RkOut = $Tn_RkIn - (0.7 * ($Tn_RkIn - $Tn_WbAirIn));
        $dT_RkMin = $Tn_RkOut - $Tn_AirIn;
        return $dT_RkMin;
    }






}
