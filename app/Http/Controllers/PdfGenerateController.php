<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use PDF;
use DB;

 
class PdfGenerateController extends Controller {
 
    public function __construct() {
        
    }
 
    public function emailData() {
        return array('order_id' => '123', 'name' => 'Saurabh', 'email' => 'contact@coding4developers.com', 'city' => 'Gurgaon', 'unitPrice' => '340', 'paidUnit' => '340', 'subTotal' => '340', 'bookingId' => '1');
    }
 
    public function generatePDF($id) {
 
    
         try {
          $response = $this->emailData();
            $mpdf = new \Mpdf\Mpdf();//new \mPDF();

            $userReports = DB::table('user_reports')->where('id', $id)->first();
           
            //get general information
            $general_info = DB::table('general_informations')->where('unique_row_id', $id)->first();
           
               //economic data
            $economic_datas = DB::table('economic_datas')->where('unique_row_id', $id)->first();

   
               // options data
              $options_datas = DB::table('options')->where('unique_row_id', $id)->first();
             

               //heat_sources data
                $heat_sources = DB::table('heat_sources')->where('unique_row_id', $id)->get();

           // heating_load_profiles data
            $heating_load_profiles = DB::table('heating_load_profiles')->where('unique_row_id', $id)->get();
    

            //    // compression_chillers data
            $compression_chillers = DB::table('compression_chillers')->where('unique_row_id', $id)->get();
         

                // cooling_load_profiles data
             $cooling_load_profiles = DB::table('cooling_load_profiles')->where('unique_row_id', $id)->get();
     

             $fahrenheit_chiller = DB::table('fahrenheits')
            ->leftJoin('chillers', 'fahrenheits.fahrenheit_id', '=', 'chillers.fahrenheit_id')
            ->where('unique_row_id', $id)->get();
            

             $fahrenheit_recool = DB::table('fahrenheits')
            ->leftJoin('recooling_systems', 'fahrenheits.fahrenheit_id', '=', 'recooling_systems.fahrenheit_id')
            ->where('unique_row_id', $id)->get();

              // echo "<pre>"; print_r($fahrenheit_chiller);
              // die;

              $view = view('report_pdf', compact('userReports','general_info','economic_datas','options_datas','heat_sources','heating_load_profiles','compression_chillers','cooling_load_profiles','fahrenheit_chiller','fahrenheit_recool'));

              
               $contents = $view->render();
                  

               $mpdf->WriteHTML($contents);

     
              //  $mpdf->WriteHTML(\View::make('report_pdf')->with('data', $userReports)->render());
                $pdf_path = public_path() . '/report.pdf';
                //$mpdf->Output($pdf_path);
                  $mpdf->Output($pdf_path, 'D');
 
           // $subject = trans('messages.invoice_mail_subject');
            // $data = array('email' => $response['email'], 'name' => $response['name'], 'org_name' => 'Coding 4 Developers');
            // $status = Mail::send('email.pdf', $data, function($message) use ($data, $pdf_path, $subject) {
            //             $message->to($data['email'])->subject($subject);
            //             $message->from(env('MAIL_FROM', 'info@coding4developers.com'), 'Coding 4 Developers');
            //             $message->attach($pdf_path);
            //         });
            // if ($status) {
            //     unlink($pdf_path);
            // }
            // $result = array('success' => 1, 'message' => 'Invoice Sent');
            return \Illuminate\Support\Facades\Response::json($result)->header('Content-Type', "application/json");
        } catch (\Exception $e) {
            Log::error("UserController::" . __METHOD__ . "  " . $e->getMessage());
        }
    }

     public function generateHtml($id)
    {

          $userReports = DB::table('user_reports')->where('id', $id)->first();
            // echo "<pre>"; 
              //  dd($userReports);
    
            //   view('user_reports.create', compact('users'));

            //get general information
            $general_info = DB::table('general_informations')->where('unique_row_id', $id)->first();
               //   echo "<pre>"; print_r($general_info);
       // dd($general_info);
               //economic data
            $economic_datas = DB::table('economic_datas')->where('unique_row_id', $id)->first();

            // dd($economic_datas);
            //  //  echo "<pre>"; print_r($economic_datas);

               // options data
              $options_datas = DB::table('options')->where('unique_row_id', $id)->first();
             // dd($options_datas);

// $users = DB::table('users')->select('name', 'email as user_email')->get();
               //heat_sources data
                $heat_sources = DB::table('heat_sources')->where('unique_row_id', $id)->get();

                  //    // heating_load_profiles data
            $heating_load_profiles = DB::table('heating_load_profiles')->where('unique_row_id', $id)->get();
           // echo "<pre>"; print_r($heating_load_profiles);
// echo "<pre>"; print_r($heat_sources);die;


            //    // compression_chillers data
            $compression_chillers = DB::table('compression_chillers')->where('unique_row_id', $id)->get();
         //  //  echo "<pre>"; print_r($compression_chillers);

                // cooling_load_profiles data
             $cooling_load_profiles = DB::table('cooling_load_profiles')->where('unique_row_id', $id)->get();
         //  //  echo "<pre>"; print_r($cooling_load_profiles);

              $fahrenheits = DB::table('fahrenheits')->where('unique_row_id', $id)->get();



              $fahrenheit_chiller = DB::table('fahrenheits')
            ->leftJoin('chillers', 'fahrenheits.fahrenheit_id', '=', 'chillers.fahrenheit_id')
            ->where('unique_row_id', $id)->get();
            

             $fahrenheit_recool = DB::table('fahrenheits')
            ->leftJoin('recooling_systems', 'fahrenheits.fahrenheit_id', '=', 'recooling_systems.fahrenheit_id')
            ->where('unique_row_id', $id)->get();

              // echo "<pre>"; print_r($fahrenheit_chiller);
              // die;

             return  $view = view('report_pdf', compact('userReports','general_info','economic_datas','options_datas','heat_sources','heating_load_profiles','compression_chillers','cooling_load_profiles','fahrenheit_chiller','fahrenheit_recool'));

             

    }
 
}