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






}
