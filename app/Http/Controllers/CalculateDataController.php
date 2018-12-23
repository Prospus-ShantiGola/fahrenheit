<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class CalculateDataController extends Controller
{
    public function calculateData(Request $request)
    {

        return (int)$request->cold_water +
            (int)$request->drive_temperature +
            (int)$request->outdoor_temperature;
    }

    public function getRecoolingProducts(Request $request, $type = 're_cooler')
    {
        $recooling_products = DB::table('recooling_products')->where('rooling_component_type', $type)->get();

        if ($recooling_products->isNotEmpty()) {
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

    public function getChillerOpratingModes(Request $request)
    {
        $opratingModes = DB::table('chiller_operating_modes')->get();
        return response()->json($opratingModes);
    }

    public function getChillerIntegratedSepSystem(Request $request)
    {
        $sysSep = DB::table('chiller_int_sys_separations')->get();
        return response()->json($sysSep);
    }

    public function getChillerIntegratedCWU(Request $request)
    {
        $intCwus = DB::table('chiller_int_cold_water_units')->get();
        return response()->json($intCwus);
    }
    
    public function getChillerProductIntercons(Request $request)
    {
        $productIntercons = DB::table('chiller_product_intercons')->get();
        return response()->json($productIntercons);
    }
}
  