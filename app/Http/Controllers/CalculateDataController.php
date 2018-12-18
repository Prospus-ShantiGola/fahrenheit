<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class CalculateDataController extends Controller
{ 
    public function calculateData(Request $request)
    {

        return (int) $request->cold_water +
                (int) $request->drive_temperature +
                (int) $request->outdoor_temperature;
    }

    public function getRecoolingProducts(Request $request, $type = 're_cooler')
    {
        $recooling_products = DB::table('recooling_products')->where('rooling_component_type', $type)->get();

        if($recooling_products->isNotEmpty()){
            $recooling_products = $recooling_products->map(function ($item) {
                $item->id = $item->recooling_products_id;
                return $item;
            });
        }
        

        return response()->json($recooling_products->toArray());
    }


    public function getChillerAdsorbentTypes(Request $request)
    {
        $data = DB::table('chiller_adsorbent_types')->get();
        return response()->json($data);
    }

    public function getChillerProducts(Request $request, $type_id)
    {
        $chiller_products = DB::table('chiller_products')->where('chiller_adsorbent_type_id', $type_id)->get();

        if ($chiller_products->isNotEmpty()) {
            $chiller_products = $chiller_products->map(function ($item) {
                $item->id = $item->chiller_products_id;
                return $item;
            });
        }


        return response()->json($chiller_products);
    }
}
  