<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;

class PdfGenerateController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
   /* public function pdfview(Request $request)
    {
        $users = DB::table("users")->get();
        view()->share('users',$users);

        if($request->has('download')){
            // Set extra option
            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            // pass view file
            $pdf = PDF::loadView('pdfview');
            // download pdf
            return $pdf->download('pdfview.pdf');
        }
        return view('pdfview');
    }*/


     /**
     * Display a listing of the resource.
      * @return \Illuminate\Http\Response
     */

    public function generatePDF()
    {

        $data = ['title' => 'Welcome to Fahrenheit'];
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);

        $pdf = PDF::loadView('report_pdf', $data);


        
       return $pdf->download('report.pdf');
        return view('report_pdf');

    }
     public function generateHtml()
    {

       
        return view('report_pdf');

    }
}