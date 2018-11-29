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
        $generalData = $request->input('generalData') ;
        $economicData = $request->input('economicData');
        $chillers = $request->input('chiller') ??  array(); //coolingloadprofile
        $chillerDatas = $request->input('chillerData') ??  array(); //compressionchiller
        $heatSourceDatas = $request->input('heatSourceData') ??  array(); //heat source
        $heatingprofiles = $request->input('heatingprofile') ??  array(); //heatingprofile
        $chillerInfos = $request->input('chillerInfo') ??  array(); //fahrenheit chiller
        $recoolings = $request->input('recooling') ??  array(); //fahrenheit recooling
        $option = $request->input('option') ??  array(); //heatingprofile



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
            $project_number = $generalData['project_number'] ?? rand(500,1000);
            $data['user_id'] = $user;
            $data['title'] = strtoupper($project_name . "_" . $project_number);
            try {

                $insertedId = UserReport::create($data)->id;
                $generalData['unique_row_id'] = $insertedId;
                $resultGen=GeneralInformation::create($generalData);

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
                        $input=array();
                        $finalSubmitArr=array();
                        $economicData['eeg_apportion_costs[]'] = $economicData['eeg_apportion_costs[]'] ?? array();
                        $economicData['planning[]'] = $economicData['planning[]'] ?? array();
                        $economicData['eeg_chp_apportion_costs[]'] = $economicData['eeg_chp_apportion_costs[]'] ?? array();
                        $economicData['planning_maintenence[]'] = $economicData['planning_maintenence[]'] ?? array();
                        foreach($economicData['eeg_apportion_costs[]'] as  $key =>$eeg_apportion_cost ){
                            $input['economic_data_id']=$economicId;
                            $input['tab_name']='general';
                            $economicData['eeg_apportion_costs[]'][$key]['fieldname']=array_reverse($economicData['eeg_apportion_costs[]'][$key]['fieldname']);
                            //dd($economicData['eeg_apportion_costs[]'][$key]['fieldname']);
                            $input['additional_field_name']=$economicData['eeg_apportion_costs[]'][$key]['fieldname'][$key];

                            $input['additional_field_value']=$eeg_apportion_cost['value'];
                            $finalSubmitArr[]=$input;
                        }

                        foreach ($economicData['eeg_chp_apportion_costs[]']  as  $key => $eeg_chp_apportion_costs) {
                            $input['economic_data_id']=$economicId;
                            $input['tab_name']='chp';
                            $economicData['eeg_chp_apportion_costs[]'][$key]['fieldname']=array_reverse($economicData['eeg_chp_apportion_costs[]'][$key]['fieldname']);
                            $input['additional_field_name']=$economicData['eeg_chp_apportion_costs[]'][$key]['fieldname'][$key];
                            $input['additional_field_value']=$eeg_chp_apportion_costs['value'];
                            $finalSubmitArr[]=$input;
                        }

                        foreach ($economicData['planning[]']  as $key => $planning) {
                            $input['economic_data_id']=$economicId;
                            $input['tab_name']='investment';
                            $economicData['planning[]'][$key]['fieldname']=array_reverse($economicData['planning[]'][$key]['fieldname']);
                            $input['additional_field_name']=$economicData['planning[]'][$key]['fieldname'][$key];
                            $input['additional_field_value']=$planning['value'];
                            $input['additional_field_discount']=$economicData['planning_discount[]'][$key]['value'];
                            $finalSubmitArr[]=$input;
                        }
                        //dd($finalSubmitArr);
                        foreach ($economicData['planning_maintenence[]']  as $key => $planning_maintenence) {
                            $input['economic_data_id']=$economicId;
                            $input['tab_name']='maintenence';
                            $economicData['planning_maintenence[]'][$key]['fieldname']=array_reverse($economicData['planning_maintenence[]'][$key]['fieldname']);
                            $input['additional_field_name']=$economicData['planning_maintenence[]'][$key]['fieldname'][$key];
                            $input['additional_field_value']= $planning_maintenence['value'];
                            $input['additional_field_discount']=null;
                            $finalSubmitArr[]=$input;
                        }
                        //dd($finalSubmitArr);
                        foreach($finalSubmitArr as $record){
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


    function coldWaterCircuit($tempIn,$Qlt,$vlt)
    {
        $_p=.999;
        $_cp=4.18;
        $tempOut= $tempIn-($Qlt*3600)/($_cp*$_p*$vlt);
        return $tempOut;
    }

    function heatCapacity($COP,$Qlt)
    {

        $result= $Qlt/$COP;
        return $result;
    }

    function calculateQLT($_a, $_b)
    {
        $Qlt= $_b * (float)log(MT) + $_a;
        return number_format((float)$Qlt, 4, '.', '');
    }

    function calculateCOP($_a, $_b, $_c)
    {
        $COP= $_a+($_b*MT)+$_c*(pow(MT, 2));
        return number_format((float)$COP, 4, '.', '');
    }


    function calculateCWUCost(){
        $Fcwu= 4732.2487*pow(QN_CWU, -0.7382)+109.3;
        $kcwuinvestment= QN_CWU*$Fcwu;
        $kcwumaintainence= QN_CWUmax*$Fcwu;
        return Response::json(array('investment'=>$kcwuinvestment,'maintenence'=>$$kcwuinvestment));

    }

    function calculateCHPCost($electricCapacity)
    {
        //The costs of module are calculated by:
        $Km= a.pow($Pel,b)*$Pel;
        //The costs of transport are calculated by:
        $Kt= $Km*0.06;
        //The costs of installation  are calculated by:
        $ki=$km*0.39;
        $chpCost=$km+$kt+$ki;
        return Response::json(array('cost'=>$chpCost));


    }









}
