<?php
// $Id: calculateDataController.php

/**
 * @file:
 * Controller file to maintain the function used in saving tile information on Adcalc Page as well as function used in calculating ADKA.
 * author : Prospus
 * contact : support@prospus.com
 * copyright reserved with Prospus Consulting Pvt. Ltd.
 */

namespace App\Http\Controllers;
use App\Models\AdkaCalculation;
use DB;
use Illuminate\Http\Request;

class CalculateDataController extends Controller
{

    /**
     * Function to represent view of calculate page 
     */
    public function calculate()
    {
        $cal_constants = DB::table('cal_constants')->get();

        if ($cal_constants->isNotEmpty()) {
            $cal_constants = $cal_constants->map(function ($item) {
                $item->id = $item->cal_constants_id;
                return $item;
            });
        }

        // get all the circuit separation type
        $circuit_sep  = $this->getRecoolingProducts($type ='circuit_separation');

        // get all the recooler type 
        $re_cooler  = $this->getRecoolingProducts($type ='re_cooler');

        return view('pages.calculate', compact( 'cal_constants','circuit_sep','re_cooler'));
    }

    /**
     * Function to calculate ADKA values on calculate page
     */
    public function calculateData(Request $request)
    {
        $ht_in = $request->drive_temperature;
        $lt_in = $request->cold_water;
        $mt_in = $request->outdoor_temperature;

        $mod_types_id = $request->adsorption_chiller;
        $chiller_type = trim($request->chiller_type);
        $qth_nomst = trim($request->qth_nomst);
        $dt_nomst = trim($request->dt_nomst);
        $qth_nomrk = trim($request->qth_nomrk);
        $dt_nomrk = trim($request->dt_nomrk);


        $calculation_type = $request->calculation_type; 
        $n_AsHt_input =  $request->dtu_up;
        $n_AsLt_input =  $request->cwt_output_up; 

        $tn_airln = $request->tn_airln;

        // for now required cooling capacity will be 15
        $max_cooling_capacity =  15; 
      
        // when we have Tn_Airln value instead of Tn_Mtln and when we have calculate one chiller at a time
        if($tn_airln) {

            $chillerarray = array($chiller_type => $mod_types_id);

        }
        // when we need to calculate values for all chiller type 
        else {

        $chillerarray = array('eCoo10' => '1', 'eCoo20' => '1', 'eCoo30' => '1', 'eCoo10X' => '2', 'eCoo20X' => '2', 'eCoo30X' => '2', 'eCoo40X' => '2');
        }


        $i = 0;
        $cal_out = array();

        foreach ($chillerarray as $key => $value) {

            $mod_types_id = $value;

            $chiller_type = $key;

            $temp_constant = $this->getCalConstant($chiller_type);

            $modtype = $this->getModType($mod_types_id);


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
            $adka_input['calculation_type'] = $calculation_type;
            

            // Calculating ADKA with  n_AsHt , n_AsLt,n_ApHt,n_ApLt associated with type of selected chiller.
            if ($calculation_type == 'calculation') {

               // calculate ADKA values 
                $output = $this->calculateADKA($adka_input);

                // if($tn_airln){
                    
                //     $Qth_Mt = $output['Qth_Mt'];

                //     $dt_st = $this->calculateDtSt($Qth_Mt, $dt_nomst,$qth_nomst);              
                //     $dT_rk = $this->calculateDtRk($Qth_Mt, $dt_nomrk,$qth_nomrk);
               
                //     $tn_mtIn = $output['Tn_MtIn'] +  $dt_st + $dT_rk ;
                    
                //     // new input for Tn_Mtln value  to calculate again ADKA value 
                //     $adka_input['Tn_MtIn'] = $tn_mtIn;

                //     // calculate ADKA values for calculated  Tn_Mtln
                //     $output = $this->calculateADKA($adka_input);
                // }
                 $this->calculateRequiredCoolingCapacity($tn_airln,$dt_nomst,$qth_nomst,$dt_nomrk,$qth_nomrk,$output,$adka_input,$max_cooling_capacity);

                $cal_out[$i]['product_name'] = $key;
                $cal_out[$i]['cooling_capacity'] = number_format($output['Qth_Lt'], 2, '.', '') . " kW"; 
                $cal_out[$i]['driving_heat'] = number_format($output['Qth_Ht'], 2, '.', '') . " kW";
                $cal_out[$i]['driving_temp_outlet'] = number_format($output['Tn_HtOut'], 2, '.', '');
                $cal_out[$i]['cold_water_temp_outlet'] = floor($output['Tn_LtOut'] * 10) / 10; 
                $cal_out[$i]['recooling_temp_outlet'] = number_format($output['Tn_MtOut'], 2, '.', '');                  
                $cal_out[$i]['COPth'] = number_format($output['COPth'], 3, '.', '');
                $cal_out[$i]['Tn_MtIn'] = number_format($tn_mtIn, 2, '.', '');

                $i++;

            } 
            // Calculating ADKA with radnom value of  n_AsHt , n_AsLt associated with type of selected chiller or for all chiller at once.
            else{   
                
                // total module associated with n_AsHt and n_AsLt
                $total_modules = $temp_constant->total_module;   
                
                $n_ApHt_calculated = round($total_modules / $n_AsHt_input);                 
           
                $n_ApLt_calculated = round($total_modules / $n_AsLt_input); //number of modules/n_AsHt ; 
              

                if ((($n_AsHt_input * $n_ApHt_calculated) == $total_modules) && (($n_AsLt_input * $n_ApLt_calculated) == $total_modules)) {
                                    
                    $adka_input['n_AsHt'] = $n_AsHt_input;
                    $adka_input['n_AsLt'] = $n_AsLt_input;
                    $adka_input['n_ApHt'] = $n_ApHt_calculated;
                    $adka_input['n_ApLt'] = $n_ApLt_calculated;                   

                   
                    $output = $this->calculateADKA($adka_input);


                    if($tn_airln){
                    
                        $Qth_Mt = $output['Qth_Mt'];

                        $dt_st = $this->calculateDtSt($Qth_Mt, $dt_nomst,$qth_nomst);              
                        $dT_rk = $this->calculateDtRk($Qth_Mt, $dt_nomrk,$qth_nomrk);
                   
                        $tn_mtIn = $output['Tn_MtIn'] +  $dt_st + $dT_rk ;
                        
                        // new input for Tn_Mtln value  to calculate again ADKA value 
                        $adka_input['Tn_MtIn'] = $tn_mtIn;

                        // calculate ADKA values for calculated  Tn_Mtln
                        $output = $this->calculateADKA($adka_input);
                    }

                $cal_out[$i]['product_name'] = $key;
                $cal_out[$i]['cooling_capacity'] = number_format($output['Qth_Lt'], 2, '.', '') . " kW"; 
                $cal_out[$i]['driving_heat'] = number_format($output['Qth_Ht'], 2, '.', '') . " kW";
                $cal_out[$i]['driving_temp_outlet'] = number_format($output['Tn_HtOut'], 2, '.', '');
                $cal_out[$i]['cold_water_temp_outlet'] = floor($output['Tn_LtOut'] * 10) / 10; 
                $cal_out[$i]['recooling_temp_outlet'] = number_format($output['Tn_MtOut'], 2, '.', '');                  
                $cal_out[$i]['COPth'] = number_format($output['COPth'], 3, '.', '');
                $cal_out[$i]['Tn_MtIn'] = number_format($tn_mtIn, 2, '.', '');

                $i++;

                } 
                else {

                    $i++;
                }

            }
        }
        if (empty($cal_out)) {
            $cal_out[0]['no_record'] = 'false';
        }

    return response()->json($cal_out);

    }

    /**
     * Function to calculate required cooling capacity on given outdoor temperature provided
     */
    function calculateRequiredCoolingCapacity($tn_airln,$dt_nomst,$qth_nomst,$dt_nomrk,$qth_nomrk,$output,$adka_input,$max_cooling_capacity)
    {
        if($tn_airln)
        {
                    
            $Qth_Mt = $output['Qth_Mt'];

            $dt_st = $this->calculateDtSt($Qth_Mt, $dt_nomst,$qth_nomst);              
            $dT_rk = $this->calculateDtRk($Qth_Mt, $dt_nomrk,$qth_nomrk);
       
            $tn_mtIn = $output['Tn_MtIn'] +  $dt_st + $dT_rk ;
            
            // new input for Tn_Mtln value  to calculate again ADKA value 
            $adka_input['Tn_MtIn'] = $tn_mtIn;

            // calculate ADKA values for calculated  Tn_Mtln
            $output = $this->calculateADKA($adka_input);

        }

    }
   
    /** 
     * Function to calculate ADKA value
     */
    public function calculateADKA($adka_input)
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
        $calculation_type = $adka_input['calculation_type'];
        $cal_constants_id = $adka_input['cal_constants_id'];

        if (($n_AsHt * $n_ApHt) == ($n_AsLt * $n_ApLt)) {
     
            $data['tn_htIn'] = $Tn_HtIn;
            $data['tn_mtIn'] = $Tn_MtIn;      
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


            $adka_data_lt['Mod_Ad'] = $Mod_Ad;
            $adka_data_lt['Tn_LtIn'] = $Tn_LtIn;
            $adka_data_lt['n_AsLt'] = $n_AsLt;
            $adka_data_lt['n_ApLt'] = $n_ApLt;
            $adka_data_lt['Mod_ad_id'] = $Mod_ad_id;

            $adka_input['calculation_type'] = $calculation_type;
   
            for($i=0; $i<=50;){ 
               
                if($i==0){
                     $adka_data['type_data'] = '';
                    //calculate serial conection HT with associated n_Asht and n_Aslt value with chiller type 
                    $ht_array = $this->calculateSerialHTConnection($adka_data);

                }
                else {
                    $adka_data['type_data'] = 'update';
                  //calculate serial conection HT with provided n_Asht and n_Aslt as an input
                  $ht_array = $this->calculateSerialHTConnection($adka_data);
                    
                }

                // get sum of all cooling capacity    
                $sumQlt1 = $this->getSumUpCoolingCapacity();
                
                //calculate Serial Lt connection
                $lt_array = $this->calculateSerialLTConnection($adka_data_lt);
               
                // get sum of all cooling capacity after calculating LT 
                $sumQlt2 = $this->getSumUpCoolingCapacity();
         
                if($sumQlt1 == $sumQlt2) {
                
                    $adka_final = $this->finalAdkaCalculation($n_ApHt, $n_AsHt, $n_ApLt);  
                    break;
                }
                else {
                    $i++;               
                } 
            }
    
        } 
        else {
            $adka_final['error'] = 'error';
        }

        return $adka_final;
    }

    /** 
     * Function to calculate sum of cooling capacity
     */
    public function getSumUpCoolingCapacity()
    {
        $adka_info = DB::table('adka_calculations')->sum('adka_calculations.qth_lt');       
        $adka_info = json_decode(json_encode($adka_info), true);
        return  $adka_info;
    }


    /**
     * Function to calculate serial connection of HT       
     */
    public function calculateSerialHTConnection($ht_array)
    {
        
        $adka_calculations_id = $ht_array['adka_calculations_id'];
        $Mod_Ad = $ht_array['Mod_Ad'];
        $Tn_HtIn = $ht_array['Tn_HtIn'];
        $n_AsHt = $ht_array['n_AsHt'];
   
        $n_ApHt = $ht_array['n_ApHt'];
        $Mod_ad_id = $ht_array['Mod_ad_id'];
        $type_data = $ht_array['type_data'];
        
        $i_Ad = 1;
        $i_Ap = 1;
        $i_As = 1;
        $Tn_HtI = $Tn_HtIn;
        $offset = '';

        if($type_data == 'update')
        {
        
            $offset = $i_Ad;
        }

        if ($i_Ap == 1){
              
            $output = $this->addHtSerialCalculation($adka_calculations_id, $Mod_Ad, $Tn_HtI, $Mod_ad_id, 'update',$offset);
        }

        for ($i_Ap = 1; $i_Ap <= $n_ApHt; ) {            

            if ($i_As == $n_AsHt) {
         
                if ($i_Ap == $n_ApHt) {
            
                    return $output;
                } 
                else {

                    $i_As = 1;
                    $i_Ad = $i_Ad + 1;
                    $i_Ap = $i_Ap + 1;  

                    if($type_data == 'update'){

                        $offset = $i_Ad;
                        $action = 'update';
                    }
                    else{
                        $action = 'add';
                    }

                    $Tn_HtI =  $Tn_HtIn;                 

                    $output = $this->addHtSerialCalculation($adka_calculations_id, $Mod_Ad, $Tn_HtI, $Mod_ad_id, $action,$offset); 
                }

            } 
            else{ 
 
                $i_Ad = $i_Ad + 1;
                $i_As = $i_As + 1;  

                if($type_data == 'update'){
                    
                    $offset = $i_Ad;
                    $action = 'update';
                }
                else {
                    $action = 'add';
                }

                $Tn_HtI =  number_format($output['Tht_out'], 2, '.', ''); 
              
                $output = $this->addHtSerialCalculation($adka_calculations_id, $Mod_Ad, $Tn_HtI, $Mod_ad_id,  $action,$offset); 
        
            }

        }
    }

    /**
     * Function to calculate serial connection of HT and calculate module value       
     */
    public function addHtSerialCalculation($adka_calculations_id, $Mod_Ad, $Tn_HtI, $Mod_ad_id, $action,$offset)
    {
        if($offset =='')
        {
            // get first record 
            $adka_info = DB::table('adka_calculations')->first();
        }
        else
        {
            // get last record 
            $adka_info = DB::table('adka_calculations')->orderBy('adka_calculations_id')->offset($offset - 1)->limit(1)->first();
        }
        
        $Tn_LtIn = $adka_info->tn_ltIn;              
        $tn_mtIn = $adka_info->tn_mtIn;

        $cal_constants_id = $adka_info->cal_constants_id;
        $adka_calculations_id = $adka_info->adka_calculations_id;

        $output = $this->calculateModuleValue($Mod_Ad, $Tn_HtI, $tn_mtIn, $Tn_LtIn, $Mod_ad_id);
       

        $data['tn_htIn'] = $output['Tht_in'];
        $data['tn_mtIn'] = $output['Tmt_in'];      
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

        // update the table record 
        if ($action == 'update') {
            $ad_cal = AdkaCalculation::findOrFail($adka_calculations_id);
            $ad_cal->update($data);
        } 
        // add new record in the table  
        else {
            $result = AdkaCalculation::create($data)->id;
            $adka_calculations_id = DB::getPdo()->lastInsertId();
          
        }

        return $output;
    }

    /**
     *  NOT IN USE REMOVE LATER 
     */
    public function calculateSerialHTConnectionupdate($ht_array)
    {
        $adka_calculations_id = $ht_array['adka_calculations_id'];

        $Mod_Ad = $ht_array['Mod_Ad'];
        $Tn_HtIn = $ht_array['Tn_HtIn'];
        $n_AsHt = $ht_array['n_AsHt'];
   
        $n_ApHt = $ht_array['n_ApHt'];
        $Mod_ad_id = $ht_array['Mod_ad_id'];
     
        $i_Ad = 1;
        $i_Ap = 1;
        $i_As = 1;
        $Tn_HtI = $Tn_HtIn;
        $offset = $i_Ad;

        if ($i_Ap == 1) {
             
            $output = $this->addHtSerialCalculationupdate($adka_calculations_id, $Mod_Ad, $Tn_HtI, $Mod_ad_id, 'update',$offset);
        }

        for ($i_Ap = 1; $i_Ap <= $n_ApHt; ) {           

            if ($i_As == $n_AsHt) {

                if ($i_Ap == $n_ApHt) {
             
                    return $output;
                }   
                else {

                    $i_As = 1;
                    $i_Ad = $i_Ad + 1;
                    $i_Ap = $i_Ap + 1;                
                    $offset = $i_Ad;
                    $Tn_HtI =  $Tn_HtIn; 
                 

                    $output = $this->addHtSerialCalculationupdate($adka_calculations_id, $Mod_Ad, $Tn_HtI, $Mod_ad_id, 'update',$offset);
                   
                   
                }

            } else { 
  
                $i_Ad = $i_Ad + 1;
                $i_As = $i_As + 1;
                $offset = $i_Ad;          
                $Tn_HtI =  number_format($output['Tht_out'], 2, '.', '');              
           
                $output = $this->addHtSerialCalculationupdate($adka_calculations_id, $Mod_Ad, $Tn_HtI, $Mod_ad_id,'update',$offset);
            }

        }       

    }

    /**
     *  NOT IN USE REMOVE LATER     
     */
    public function addHtSerialCalculationupdate($adka_calculations_id, $Mod_Ad, $Tn_HtI, $Mod_ad_id, $action,$offset)
    {
        $adka_info = DB::table('adka_calculations')->orderBy('adka_calculations_id')->offset($offset - 1)->limit(1)->first();
      
        $Tn_LtIn = $adka_info->tn_ltIn;
       
        $tn_mtIn = $adka_info->tn_mtIn;
        $cal_constants_id = $adka_info->cal_constants_id;
        $adka_calculations_id = $adka_info->adka_calculations_id;

        $output = $this->calculateModuleValue($Mod_Ad, $Tn_HtI, $tn_mtIn, $Tn_LtIn, $Mod_ad_id);        
        
        $data['tn_htIn'] = $output['Tht_in'];
        $data['tn_mtIn'] = $output['Tmt_in'];     
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
        } 
        else {

            $result = AdkaCalculation::create($data)->id;
            $adka_calculations_id = DB::getPdo()->lastInsertId();
        }

        return $output;
    }

    


    /**
     * Function to calculate serial connection of LT  
     */
    public function calculateSerialLTConnection($lt_array)
    {  
        
        $Mod_Ad = $lt_array['Mod_Ad'];
        $Tn_LtIn = $lt_array['Tn_LtIn'];
        $n_AsLt = $lt_array['n_AsLt'];
       
        $n_ApLt = $lt_array['n_ApLt'];
        $Mod_ad_id = $lt_array['Mod_ad_id'];        
        $i_Ad = $n_AsLt * $n_ApLt;

        $i_Ap = 1;
        $i_As = 1;
        $Tn_LtI = $Tn_LtIn;
  
        $action = 'update';
        $offset = $i_Ad;

        if ($i_Ap == 1) {
                $output = $this->addLTSerialCalculation($Mod_Ad, $Tn_LtI, $Mod_ad_id, $action, $offset);
            }

        for ($i_Ap == 1; $i_Ap <= $n_ApLt; ) {

            if ($i_As == $n_AsLt) {
           
                if ($i_Ap == $n_ApLt) {
                
                    return $output;
                } 
                else {

                    $Tn_LtI =  $Tn_LtIn;
                    $action = 'update';
                    $i_Ap = $i_Ap + 1;
                    $i_As = 1;
                    $i_Ad = $i_Ad - 1;
                    $offset = $i_Ad;
                    $output = $this->addLTSerialCalculation($Mod_Ad, $Tn_LtI, $Mod_ad_id, $action, $offset);
                }

            } 
            else {
  
                $i_As = $i_As + 1;
                $i_Ad = $i_Ad - 1;
                $offset = $i_Ad;
                $Tn_LtI =  number_format($output['Tlt_out'], 2, '.', '');  //
 
                $output = $this->addLTSerialCalculation($Mod_Ad, $Tn_LtI, $Mod_ad_id, $action, $offset);               
            }

        }
    
    }

    /**
     * Function to calculate serial connection of LT and calculate module value       
     */
    public function addLTSerialCalculation($Mod_Ad, $Tn_LtI, $Mod_ad_id, $action, $offset)
    {
         // get the last record 
        $adka_info = DB::table('adka_calculations')->orderBy('adka_calculations_id')->offset($offset - 1)->limit(1)->first();  
   
        $Tn_HtIn = $adka_info->tn_htIn;      
        $tn_mtIn = $adka_info->tn_mtIn;
        $cal_constants_id = $adka_info->cal_constants_id;

        $output = $this->calculateModuleValue($Mod_Ad, $Tn_HtIn, $tn_mtIn, $Tn_LtI, $Mod_ad_id);
     
        $adka_calculations_id = $adka_info->adka_calculations_id;

        $data['adka_calculations_id'] = $adka_calculations_id;

        $data['tn_htIn'] = $output['Tht_in'];
        $data['tn_mtIn'] = $output['Tmt_in'];    
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
     * Function to calculate final ADKA connection of HT and calculate module value       
     */
    public function finalAdkaCalculation($n_ApHt, $n_AsHt, $n_ApLt)
    {
        $i_Ad = 1;
        $medium  = 'Water';       
        $adka_count = DB::table('adka_calculations')->count();
        $n_AdMax = $adka_count;

        $result = DB::table('adka_calculations')->get();
        $result = json_decode(json_encode($result), true);
  
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
            
            $Qth_Lt = $Qth_Lt + $value['qth_lt'];

            $Qth_Ht = $Qth_Ht + $value['qth_ht'];

            $Qth_Mt = $Qth_Mt + $value['qth_mt'];

            if ($i == 0) {
                $Tn_HtIn = $value['tn_htIn'];
                $Tn_MtIn = $value['tn_mtIn'];
               $Tn_LtOut = $value['tn_ltout'];
          
            }
           
            $Tn_HtOut = $value['tn_htout'];
            $Tn_LtIn = $value['tn_ltIn'];
            $COPth = $Qth_Lt / $Qth_Ht;
            $Vf_Ht = $value['vf_ht'] * $n_ApHt;
            $Vf_Mt = $value['vf_mt'] * $n_ApHt * $n_AsHt;
            $Vf_Lt = $value['vf_lt'] * $n_ApLt;

          
            $i++;
        }

        $adka_final['Qth_Lt'] =  $Qth_Lt;
        $adka_final['Qth_Ht'] =  $Qth_Ht;
        $adka_final['Qth_Mt'] = $Qth_Mt;
        $adka_final['COPth'] = $COPth;
        $adka_final['Vf_Ht'] = $Vf_Ht;

        $adka_final['Vf_Mt'] = $Vf_Mt;
        $adka_final['Vf_Lt'] = $Vf_Lt;

        //calculate Htout
        $Tn_HtOut =   $this->calculateOutletTempHt($Qth_Ht,$Tn_HtIn,$Vf_Ht,$medium);
        //calculate Mtout
        $Tn_MtOut =   $this->calculateOutletTempMt($Qth_Mt, $Tn_MtIn, $Vf_Mt, $medium);
        //calculate Ltout
        $Tn_LtOut =   $this->calculateOutletTempLt($Qth_Lt,$Tn_LtIn,$Vf_Lt,$medium);

        $adka_final['Tn_MtOut'] = $Tn_MtOut;
        $adka_final['Tn_HtOut'] = $Tn_HtOut;
        $adka_final['Tn_LtOut'] = $Tn_LtOut;
        $adka_final['Tn_MtIn'] = $Tn_MtIn;

        return $adka_final;
    }
    /**
     * Function to calculate outlet temperature MT 
     */
    public function calculateOutletTempMt($Qth, $Tn_In, $Vf, $medium)
    {
        $Qth = $Qth * -1000;

        // Get rho and cp from cool prop library
        $data_set = $this->calculateCoolPropVariable($Tn_In, $medium);
        
        $rho = $data_set['rho'];
        $cp = $data_set['cp'];

        $Tn_Out = $Tn_In - (($Qth) / ($Vf * $rho * $cp));

        return $Tn_Out;

    }

    /**
     * Function to calculate outlet temperature HT 
     */
    public function calculateOutletTempHT($Qth, $Tn_In, $Vf, $medium)
    {
        $Qth = $Qth * 1000;

        // Get rho and cp from cool prop library
        $data_set = $this->calculateCoolPropVariable($Tn_In, $medium);
        
        $rho = $data_set['rho'];
        $cp = $data_set['cp'];

        $Tn_HtOut = $Tn_In - (($Qth) / ($Vf * $rho * $cp));

        return $Tn_HtOut;

    }

    /**
     * Function to calculate outlet temperature LT 
     */
    public function calculateOutletTempLT($Qth, $Tn_In, $Vf, $medium)
    {
        $Qth = $Qth * 1000;

        // Get rho and cp from cool prop library
        $data_set = $this->calculateCoolPropVariable($Tn_In, $medium);
        
        $rho = $data_set['rho'];
        $cp = $data_set['cp'];

        $Tn_LtOut = $Tn_In - (($Qth) / ($Vf * $rho * $cp));

        return $Tn_LtOut;
    }

    /**
     * Function to calculate module value
     */
    public function calculateModuleValue($Mod_Ad, $Tn_HtI, $Tn_MtIn, $Tn_LtIn, $Mod_ad_id)
    {   
 
        $medium = 'Water';
        // get machine volume flow
        $volume_flow = $this->getMachineVolumeFlow($Mod_ad_id);
        $vlt = $volume_flow->vf_lt;
        $vht = $volume_flow->vf_ht;
        $vmt = $volume_flow->vf_mt;
       
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

        $Tltout = $this->calculateOutletTempLt($Qlt, $Tn_LtIn, $vlt, $medium);
     
 
        $Thtout =  $this->calculateOutletTempHt($Qht, $Tn_HtI, $vht, $medium );
       
        $Tmtout =  $this->calculateOutletTempMt($Qmt, $Tn_MtIn, $vmt, $medium);

        $output['a'] = $final_ab_value['a'];
        $output['b'] = $final_ab_value['b'];
        $output['Qth_LtAd'] =   number_format($Qlt, 2, '.', '');

        $output['aa'] = $final_abc_value['aa'];
        $output['bb'] = $final_abc_value['bb'];
        $output['c'] = $final_abc_value['c'];
        $output['COP'] = number_format($COP, 2, '.', '');

        $output['Qth_HtAd'] = number_format($Qht, 2, '.', '');

        $output['Qth_MtAd'] =  number_format($Qmt, 2, '.', '');

        $output['Tlt_in'] = $Tn_LtIn;
        $output['Tlt_out'] =   number_format($Tltout,2, '.', ''); 
        $output['Tht_in'] = $Tn_HtI;
        $output['Tht_out'] = number_format($Thtout,2, '.', '');  
        $output['Tmt_in'] = $Tn_MtIn;
        $output['Tmt_out'] = number_format((float)$Tmtout, 2, '.', '');
        $output['vlt'] = $vlt;
        $output['vht'] = $vht;
        $output['vmt'] = $vmt;

        
        return $output;
    }

    /*
     * Function to calculate $a and $b for cooling capacity of differnt mod type
    */
    public function calculateCoolingCapacity($ht_in, $lt_in, $chiller_type)
    {

        $res = DB::select('SELECT id,a,b,abs(ht-' . $ht_in . ') as htdist, abs (lt-' . $lt_in . ') as ltdist,ht,lt,(b*LN(25)+a) as Qlt FROM `calculations` where type_data ="' . $chiller_type . '" AND    ht in (select * from  (select distinct ht FROM calculations order by abs(ht-' . $ht_in . ') LIMIT 0,2) as ht1 ) and lt in (select * from ( select distinct lt FROM calculations order by abs(lt-' . $lt_in . ')LIMIT 0,2)as lt1) order by ht, lt');
        $temp = array();

        foreach ($res as $value) {

            $temp[] = $value;
        }
     
        $temp = json_decode(json_encode($temp), true);
      
        if ($temp[0]['ht'] == $ht_in && $temp[0]['lt'] == $lt_in) {
        
            $a6 = $temp[0]['a'];
            $b6 = $temp[0]['b'];
         
        } else if ($temp[0]['ht'] == $ht_in) 
        {
      
            $a6 = (($temp[1]['a'] - $temp[0]['a']) / ($temp[1]['lt'] - $temp[0]['lt'])) * ($lt_in - $temp[0]['lt']) + $temp[0]['a'];
    
            $b6 = (($temp[1]['b'] - $temp[0]['b']) / ($temp[1]['lt'] - $temp[0]['lt'])) * ($lt_in - $temp[0]['lt']) + $temp[0]['b'];
        } else if ($temp[0]['lt'] == $lt_in) {
       
            $a6 = (($temp[1]['a'] - $temp[0]['a']) / ($temp[1]['ht'] - $temp[0]['ht'])) * ($ht_in - $temp[0]['ht']) + $temp[0]['a'];
 
            $b6 = (($temp[1]['b'] - $temp[0]['b']) / ($temp[1]['ht'] - $temp[0]['ht'])) * ($ht_in - $temp[0]['ht']) + $temp[0]['b'];
  
        } else {

            usort($temp, 'self::sortByLt');
     
            $a4 = (($temp[1]['a'] - $temp[0]['a']) / ($temp[1]['ht'] - $temp[0]['ht'])) * ($ht_in - $temp[0]['ht']) + $temp[0]['a'];

            $a5 = (($temp[3]['a'] - $temp[2]['a']) / ($temp[3]['ht'] - $temp[2]['ht'])) * ($ht_in - $temp[2]['ht']) + $temp[2]['a'];
    
            $a6 = (($a5 - $a4) / ($temp[2]['lt'] - $temp[0]['lt'])) * ($lt_in - $temp[0]['lt']) + $a4;

            $b4 = (($temp[1]['b'] - $temp[0]['b']) / ($temp[1]['ht'] - $temp[0]['ht'])) * ($ht_in - $temp[0]['ht']) + $temp[0]['b'];

            $b5 = (($temp[3]['b'] - $temp[2]['b']) / ($temp[3]['ht'] - $temp[2]['ht'])) * ($ht_in - $temp[2]['ht']) + $temp[2]['b'];
 
            $b6 = (($b5 - $b4) / ($temp[2]['lt'] - $temp[0]['lt'])) * ($lt_in - $temp[0]['lt']) + $b4;
        }

        $final_array['a'] = $a6;
        $final_array['b'] = $b6;

        return $final_array;

    }
    public function sortByLt($a, $b)
    {
        $a = $a['lt'];
        $b = $b['lt'];

        if ($a == $b) return 0;
        return ($a < $b) ? -1 : 1;
    }


    /*
    * Function to calculate $a and $b  &c for thermal COP of different mod type
    */
     public function calculateCopVariable($ht_in, $lt_in, $chiller_type)
    {
       
        $res = DB::select('SELECT id,aa as a,bb as b,c,abs(ht-' . $ht_in . ') as htdist, abs (lt-' . $lt_in . ') as ltdist,ht,lt,(b*LN(25)+a) as Qlt FROM `calculations` where type_data ="' . $chiller_type . '" AND   ht in (select * from  (select distinct ht FROM calculations order by abs(ht-' . $ht_in . ') LIMIT 0,2) as ht1 ) and lt in (select * from ( select distinct lt FROM calculations order by abs(lt-' . $lt_in . ')LIMIT 0,2)as lt1) order by ht, lt');
        $temp = array();

        foreach ($res as $value) {

            $temp[] = $value;
        }
      
        $temp = json_decode(json_encode($temp), true);

        if ($temp[0]['ht'] == $ht_in && $temp[0]['lt'] == $lt_in) {
        
            $a6 = $temp[0]['a'];
            $b6 = $temp[0]['b'];
            $c6 = $temp[0]['c'];
      
        } else if ($temp[0]['ht'] == $ht_in) {
    
            $a6 = (($temp[1]['a'] - $temp[0]['a']) / ($temp[1]['lt'] - $temp[0]['lt'])) * ($lt_in - $temp[0]['lt']) + $temp[0]['a'];
     
            $b6 = (($temp[1]['b'] - $temp[0]['b']) / ($temp[1]['lt'] - $temp[0]['lt'])) * ($lt_in - $temp[0]['lt']) + $temp[0]['b'];

            $c6 = (($temp[1]['c'] - $temp[0]['c']) / ($temp[1]['lt'] - $temp[0]['lt'])) * ($lt_in - $temp[0]['lt']) + $temp[0]['c'];
       
        } else if ($temp[0]['lt'] == $lt_in) {
      
            $a6 = (($temp[1]['a'] - $temp[0]['a']) / ($temp[1]['ht'] - $temp[0]['ht'])) * ($ht_in - $temp[0]['ht']) + $temp[0]['a'];
  
            $b6 = (($temp[1]['b'] - $temp[0]['b']) / ($temp[1]['ht'] - $temp[0]['ht'])) * ($ht_in - $temp[0]['ht']) + $temp[0]['b'];

            $c6 = (($temp[1]['c'] - $temp[0]['c']) / ($temp[1]['ht'] - $temp[0]['ht'])) * ($ht_in - $temp[0]['ht']) + $temp[0]['c'];
        } else {
    
            usort($temp, 'self::sortByLt');

            $a4 = (($temp[1]['a'] - $temp[0]['a']) / ($temp[1]['ht'] - $temp[0]['ht'])) * ($ht_in - $temp[0]['ht']) + $temp[0]['a'];

            $a5 = (($temp[3]['a'] - $temp[2]['a']) / ($temp[3]['ht'] - $temp[2]['ht'])) * ($ht_in - $temp[2]['ht']) + $temp[2]['a'];

            $a6 = (($a5 - $a4) / ($temp[2]['lt'] - $temp[0]['lt'])) * ($lt_in - $temp[0]['lt']) + $a4;

            $b4 = (($temp[1]['b'] - $temp[0]['b']) / ($temp[1]['ht'] - $temp[0]['ht'])) * ($ht_in - $temp[0]['ht']) + $temp[0]['b'];
   
            $b5 = (($temp[3]['b'] - $temp[2]['b']) / ($temp[3]['ht'] - $temp[2]['ht'])) * ($ht_in - $temp[2]['ht']) + $temp[2]['b'];
 
            $b6 = (($b5 - $b4) / ($temp[2]['lt'] - $temp[0]['lt'])) * ($lt_in - $temp[0]['lt']) + $b4;

            $c4 = (($temp[1]['c'] - $temp[0]['c']) / ($temp[1]['ht'] - $temp[0]['ht'])) * ($ht_in - $temp[0]['ht']) + $temp[0]['c'];
 
            $c5 = (($temp[3]['c'] - $temp[2]['c']) / ($temp[3]['ht'] - $temp[2]['ht'])) * ($ht_in - $temp[2]['ht']) + $temp[2]['c'];
 
            $c6 = (($c5 - $c4) / ($temp[2]['lt'] - $temp[0]['lt'])) * ($lt_in - $temp[0]['lt']) + $c4;
        }

        $final_array['aa'] = $a6;
        $final_array['bb'] = $b6;
        $final_array['c'] = $c6;
 
        return $final_array;

    }

    /*
    * Function to get the value n_asht , n_aslt, n_apht, n_aplt associated with type of chiller
    */
     public function getCalConstant($chiller_type)
    {

        $cal_constant = DB::table('cal_constants')->where('chiller_type', $chiller_type)->first();
        return $cal_constant;
    }

    /*
    * Function to get the different mod type like sika , sikax  etc..
    */
     public function getModType($mod_types_id)
    {
        $mod_type = DB::table('mod_types')->where('mod_types_id', $mod_types_id)->first();
        return $mod_type;
    }

     /*
    * Function to get machine volume flow associated with  mod type like sika , sikax  etc..
    */
     public function getMachineVolumeFlow($mod_types_id)
    {
        $volume_flow = DB::table('machine_volume_flows')->where('mod_types_id', $mod_types_id)->first();
        return $volume_flow;
    }

    /**
     *  Function to calculate necessary drive heat” (Qth_LtAd) in kW
     *  cooling capacity Qth_LtAd or Qth_Lt
     */
    public function calculateQLT($final_array, $mt_in)
    {
        $_a = $final_array['a'];
        $_b = $final_array['b'];

        $Qlt = $_b * (float)log($mt_in) + $_a;
        return $Qlt;
    }

    /**
     *  Function to calculate COP or COPth
     */
    public function calculateCOP($final_array, $mt_in)
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
    public function calculateHeatCapacity($COP, $Qlt)
    {
        $Qht = $Qlt / $COP;   
        return $Qht;
    }

    /**
     *  Function to calculate Recooling capacity” (Qth_MtAd) in kW
     *  Recooling capacity Qth_MtAd or Qth_Mt
     */
    public function calculateRecoolingCapacity($Qlt, $Qht, $Cop)
    {
        $Qmt = $Qlt + $Qht;
        return $Qmt;

    }    

    /**
     *  Function to calculate value rho and cp by coolprop library though curl
     */
    public function calculateCoolPropVariable($input_temp, $medium)
    {
        // Specify your url
        $url='http://18.208.180.99/demo/index.php';

         // Add parameters in key value
        $data= array('q'=>$input_temp,'medium'=>$medium);

         // Initialize cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $res = curl_exec($ch);
        curl_close($ch);
        $result = explode(',', $res);
        $data=  array('rho'=> $result['0'],'cp'=>$result['1'] );
 
        return  $data;
    }

    /**
     *  Function to calculate DTST value
     */
    public function calculateDtSt($Qth_Mt, $dT_NomSt,$Qth_NomSt)
    {
        $dt_st = ($Qth_Mt*$dT_NomSt)/$Qth_NomSt;
        return $dt_st;
    }
    /**
     *  Function to calculate DTRK value
     */
    public function calculateDtRk($Qth_Mt, $dT_NomRk,$Qth_NomRk)
    {
        $dt_rk = ($Qth_Mt*$dT_NomRk)/$Qth_NomRk;
        return $dt_rk;
    }

    /**
     *  Function to get all the recooling products type
     */
    public function getRecoolingProducts($type)
    {
        $recooling_products = DB::table('recooling_products')->where('recooling_component_type', $type)->get();

        if ($recooling_products->isNotEmpty()) {
            $recooling_products = $recooling_products->map(function ($item) {
                $item->id = $item->recooling_products_id;
                return $item;
            });
        }

        return $recooling_products;
    }

    /**
     * Function to get qth_nomrk, dt_nomrk, qth_nomst, dt_nomst depending of the type of circuit separation or recooler type
     */
    public function getNomValue(Request $request)
    {
       
        $recooling_products_id =  $request->recooling_products_id;
        $product_type =  $request->product_type;

        $recooling_products = DB::table('recooling_products')->where('recooling_products_id', $recooling_products_id)->first();

        if($product_type =='re_cooler') {
            $qth_value = $recooling_products->qth_nomrk;
            $dt_value = $recooling_products->dt_nomrk;
        }
        else {
            $qth_value = $recooling_products->qth_nomst;
            $dt_value = $recooling_products->dt_nomst;
        }
        return  $qth_value .'~'.$dt_value;
    }

    /**
     * Function to creating a linear function out of two Points to calculate the cooling load at a particular outdoor temperature 
     */
    public function getCoolingLoad($profile_type, $highest_temp, $max_cooling_load,$constant_value,$Tn_AirIn)
    {

        if(strtoupper($profile_type) ==strtoupper('office space')){
            $x1 = $highest_temp;
            $y1 = $max_cooling_load;
            $x2 = $constant_value;
            $y2 = 0;

        }else{
            $x1 = $highest_temp;
            $y1 = $max_cooling_load;
            $x2 = $constant_value;
            $y2 = $max_cooling_load;
        }

        // function to calculate m and n value used in calculation Qload 
        //m = (Y1 - Y2) / (X1 - X2)   
        //n = Y2 - X2 * m 

        $m =  ($y1 - $y2)/($x1 - $x2);
        $n =  ($y2 - $x2)*$m ;

        //function to calculate Q_load = m * Tn_AirIn + n 

        $Q_load = ($m * $Tn_AirIn )+ $n ;

        //Cooling load at out door temperature
        return $Q_load;     
    }

 
}
  