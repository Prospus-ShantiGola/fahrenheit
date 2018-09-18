<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use Constants;


class PagesController extends Controller
{
    public function adcalc()
    {
        return view('pages.adcalc');
    }
    public function submitContactForm(Request $request)
    {


  		$request_data = $request->all();        
	    $contact_form =  array();
	    parse_str($request_data['form_data'], $contact_form);
	    $message_val =  [
        'required' => 'Required field',
         'numeric' => 'Phone number should be numeric',
       	 'email' => 'Please provide valid email'
   		 ];


        $validator = \Validator::make($contact_form, [
            'full_name' => 'required',
            'contact_number' =>  'required|numeric',
            'emailaddress' =>'required|email'
           
            // 'manufacturer' => 'required',
            // 'compressor' => 'required',
        ], $message_val);

        if ($validator->fails())
        {
           return response()->json(['errors'=>$validator->errors()]);
        // return 	response()->json($validator->errors(), 422);
        }
        else
        {

        	app('App\Http\Controllers\MailController')->contactUsUserMail($contact_form);
		$return_val = app('App\Http\Controllers\MailController')->contactUsAdminMail($contact_form);
		return response()->json(['success'=>$return_val]);
        }
       

 

// 	  //  print_r($contact_form);
// 		//echo 'success';
// 	   // $this->mail();

// 		echo Config::get('constants.SITE_NAME');


// 		die;
// 	     $config = Config::all();

//     // View
//     var_dump($config);
//     die;

// 	   // echo config('custom_config.abc');
// 	   echo config('custom.abc');

// // echo config('custom.site_id');
// 	    // echo Config::get('custom_config.abc');
// 	    die;

	    // app('App\Http\Controllers\MailController')->html_email();

		
		
    }


	 public function mail()
	{
	   $user = User::find(1)->toArray();


	    Mail::send('emails.mailExample', $user, function($message) use ($user) {
	        $message->to('prospus.artisharma@gmail.com');
	        $message->subject('E-Mail Example');
	    });


	    dd('Mail Send Successfully');
	}
}