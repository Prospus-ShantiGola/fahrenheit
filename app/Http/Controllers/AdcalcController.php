<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Exception;
use Gate;
use Hash;
use Mail;
use PHPUnit\Framework\Error\Error;

class AdcalcController extends Controller
{

    public function index()
    {
        $user=array();
        if($user = Auth::user())
        {
            $user= Auth::user()->user_type_id;
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

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->keys()]);
        }
        return response()->json(['success'=>'Record is successfully added']);

  }


   public function storeGeneralInformation(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'location' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->keys()]);
        }
        return response()->json(['success'=>'Record is successfully added']);

  }
  public function storeEconomicInformation(Request $request)
    {
        $validator = \Validator::make($request->all(), [

        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->keys()]);
        }
        return response()->json(['success'=>'Record is successfully added']);

  }
  public function storeHeatSourceInformation(Request $request)
  {
      $validator = \Validator::make($request->all(), [
        'heat_type' => 'required',
        'drive_temp'=>'sometimes|required',
        'heat_capacity'=>'sometimes|required',
      ]);

      if ($validator->fails())
      {
          return response()->json(['errors'=>$validator->errors()->keys()]);
      }
      return response()->json(['success'=>'Record is successfully added']);

}
public function storeHeatingProfileInformation(Request $request)
  {
      $validator = \Validator::make($request->all(), [

      ]);

      if ($validator->fails())
      {
          return response()->json(['errors'=>$validator->errors()->keys()]);
      }
      return response()->json(['success'=>'Record is successfully added']);

}
public function storeCoolingProfileInformation(Request $request)
  {
      $validator = \Validator::make($request->all(), [

      ]);

      if ($validator->fails())
      {
          return response()->json(['errors'=>$validator->errors()->keys()]);
      }
      return response()->json(['success'=>'Record is successfully added']);

}
public function storeProjectInformation(Request $request)
  {
    $generalData = $request->input('generalData');

    if(empty($generalData)){
        return response()->json(['errors'=>'Please provide the mandatory field','key'=>'general']);
    }
    else{
        $email_address=$generalData['email_address'];
        try{
            app('App\Http\Controllers\MailController')->sendProjectEmailAdmin($generalData);
        }
            catch(Error $e){
                return response()->json(['errors'=>$e,'key'=>'general']);
            }
    }

      return response()->json(['success'=>'Record is successfully added']);

}
public function storeProfileInformation(Request $request)
    {
        $validator = \Validator::make($request->all(), [

        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->keys()]);
        }
        return response()->json(['success'=>'Record is successfully added']);

  }
  public function storeChillerInformation(Request $request)
    {
        $validator = \Validator::make($request->all(), [

        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->keys()]);
        }
        return response()->json(['success'=>'Record is successfully added']);

  }
  public function storeRecoolerInformation(Request $request)
    {
        $validator = \Validator::make($request->all(), [

        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->keys()]);
        }
        return response()->json(['success'=>'Record is successfully added']);

  }







}
