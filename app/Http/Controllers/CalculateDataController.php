<?php

namespace App\Http\Controllers;

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

        $recooling_products = array(
            array('recooling_products_id' => '1', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRec 10 | 29', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '29', 'dt_nomrk' => '2'),
            array('recooling_products_id' => '2', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRec 10 | 40', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '40', 'dt_nomrk' => '2'),
            array('recooling_products_id' => '3', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRec 20 | 58', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '58', 'dt_nomrk' => '2'),
            array('recooling_products_id' => '4', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRec 20 | 80', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '80', 'dt_nomrk' => '2'),
            array('recooling_products_id' => '5', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRec 30 | 87', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '87', 'dt_nomrk' => '2'),
            array('recooling_products_id' => '6', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRec 30 | 120', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '120', 'dt_nomrk' => '2'),
            array('recooling_products_id' => '7', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRec 40 | 116', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '116', 'dt_nomrk' => '2'),
            array('recooling_products_id' => '8', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRec 40 | 160', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '160', 'dt_nomrk' => '2'),
            array('recooling_products_id' => '9', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRec 50 | 145', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '145', 'dt_nomrk' => '2'),
            array('recooling_products_id' => '10', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRec 50 | 200', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '200', 'dt_nomrk' => '2'),
            array('recooling_products_id' => '11', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRec 60 | 170 | VB', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '170', 'dt_nomrk' => '3'),
            array('recooling_products_id' => '12', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRec 60 | 174', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '174', 'dt_nomrk' => '2'),
            array('recooling_products_id' => '13', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRec 60 | 240', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '240', 'dt_nomrk' => '2'),
            array('recooling_products_id' => '14', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRec 70 | 203', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '203', 'dt_nomrk' => '2'),
            array('recooling_products_id' => '15', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRec 70 | 280', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '280', 'dt_nomrk' => '2'),
            array('recooling_products_id' => '16', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRec 80 | 232', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '232', 'dt_nomrk' => '2'),
            array('recooling_products_id' => '17', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRec 80 | 320', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '320', 'dt_nomrk' => '2'),
            array('recooling_products_id' => '18', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRis 10 | 29', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '29', 'dt_nomrk' => '4'),
            array('recooling_products_id' => '19', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRis 10 | 40', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '40', 'dt_nomrk' => '4'),
            array('recooling_products_id' => '20', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRis 20 | 58', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '58', 'dt_nomrk' => '4'),
            array('recooling_products_id' => '21', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRis 20 | 80', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '80', 'dt_nomrk' => '4'),
            array('recooling_products_id' => '22', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRis 30 | 87', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '87', 'dt_nomrk' => '4'),
            array('recooling_products_id' => '23', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRis 30 | 120', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '120', 'dt_nomrk' => '4'),
            array('recooling_products_id' => '24', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRis 40 | 116', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '116', 'dt_nomrk' => '4'),
            array('recooling_products_id' => '25', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRis 40 | 160', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '160', 'dt_nomrk' => '4'),
            array('recooling_products_id' => '26', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRis 50 | 145', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '145', 'dt_nomrk' => '4'),
            array('recooling_products_id' => '27', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRis 50 | 200', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '200', 'dt_nomrk' => '4'),
            array('recooling_products_id' => '28', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRis 60 | 174', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '174', 'dt_nomrk' => '4'),
            array('recooling_products_id' => '29', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRis 60 | 240', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '240', 'dt_nomrk' => '4'),
            array('recooling_products_id' => '30', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRis 70 | 203', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '203', 'dt_nomrk' => '4'),
            array('recooling_products_id' => '31', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRis 70 | 280', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '280', 'dt_nomrk' => '4'),
            array('recooling_products_id' => '32', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRis 80 | 232', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '232', 'dt_nomrk' => '4'),
            array('recooling_products_id' => '33', 'rooling_component_type' => 're_cooler', 'product_name' => 'eRis 80 | 320', 'qth_nomst' => '0', 'dt_nomst' => '0', 'qth_nomrk' => '320', 'dt_nomrk' => '4'),
            array('recooling_products_id' => '34', 'rooling_component_type' => 'circuit_separation', 'product_name' => 'ST10', 'qth_nomst' => '39', 'dt_nomst' => '2', 'qth_nomrk' => '0', 'dt_nomrk' => '0'),
            array('recooling_products_id' => '35', 'rooling_component_type' => 'circuit_separation', 'product_name' => 'ST10X', 'qth_nomst' => '5973', 'dt_nomst' => '2', 'qth_nomrk' => '0', 'dt_nomrk' => '0'),
            array('recooling_products_id' => '36', 'rooling_component_type' => 'circuit_separation', 'product_name' => 'ST20', 'qth_nomst' => '80', 'dt_nomst' => '2', 'qth_nomrk' => '0', 'dt_nomrk' => '0'),
            array('recooling_products_id' => '37', 'rooling_component_type' => 'circuit_separation', 'product_name' => 'ST30', 'qth_nomst' => '112', 'dt_nomst' => '2', 'qth_nomrk' => '0', 'dt_nomrk' => '0'),
            array('recooling_products_id' => '38', 'rooling_component_type' => 'circuit_separation', 'product_name' => 'ST20X', 'qth_nomst' => '1116', 'dt_nomst' => '2', 'qth_nomrk' => '0', 'dt_nomrk' => '0'),
            array('recooling_products_id' => '39', 'rooling_component_type' => 'circuit_separation', 'product_name' => 'ST40', 'qth_nomst' => '159', 'dt_nomst' => '2', 'qth_nomrk' => '0', 'dt_nomrk' => '0'),
            array('recooling_products_id' => '40', 'rooling_component_type' => 'circuit_separation', 'product_name' => 'ST30X', 'qth_nomst' => '2035', 'dt_nomst' => '2', 'qth_nomrk' => '0', 'dt_nomrk' => '0'),
            array('recooling_products_id' => '41', 'rooling_component_type' => 'circuit_separation', 'product_name' => 'ST20+ST30', 'qth_nomst' => '192', 'dt_nomst' => '2', 'qth_nomrk' => '0', 'dt_nomrk' => '0'),
            array('recooling_products_id' => '42', 'rooling_component_type' => 'circuit_separation', 'product_name' => 'ST40X', 'qth_nomst' => '2828', 'dt_nomst' => '2', 'qth_nomrk' => '0', 'dt_nomrk' => '0'),
            array('recooling_products_id' => '43', 'rooling_component_type' => 'circuit_separation', 'product_name' => 'ST30+ST40', 'qth_nomst' => '270', 'dt_nomst' => '2', 'qth_nomrk' => '0', 'dt_nomrk' => '0')
        );

        $recooling_products = collect($recooling_products);

        $recooling_products = $recooling_products->filter(function ($product) use($type){
            return $product['rooling_component_type'] == $type;
        });
        
        if($recooling_products->isNotEmpty()){
            $recooling_products = $recooling_products->map(function ($item) {
                $item['id'] = $item['recooling_products_id'];
                return $item;
            })->values();
        }
        

        return response()->json($recooling_products->toArray());
    }
}
