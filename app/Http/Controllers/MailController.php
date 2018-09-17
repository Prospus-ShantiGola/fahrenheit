<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {
   public function basic_email(){
      $data = array('name'=>"Virat Gandhi");
   
      Mail::send(['text'=>'mail'], $data, function($message) {
         $message->to('prospus.artisharma@gmail.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
         $message->from('support@prospus.com','Fahrenheit');
      });
      echo "success";
      exit();
   }
   public function html_email($message_ary){


   	 $msg = $message_ary['message'];
   	echo  $email_address = $message_ary['email_address_to'];

	$user_name = $message_ary['user_name'] ;
	$subject = $message_ary['subject'];
	


      $data = array('name'=>$user_name,'email_address'=>$email_address);
      Mail::send('pages.adcalc', $data, function($message) {
       //  $message->to($data['email_address_to'],  'asasas' );

         $message->to($email_address, $name = null);
         $message->subject($subject);
           // ('sssssssssssssssssss');
          $message->from('support@prospus.com','Fahrenheit');
      });
      echo "HTML Email Sent. Check your inbox.";
   }
   public function attachment_email(){
      $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message) {
         $message->to('abc@gmail.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
         $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
         $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
         $message->from('xyz@gmail.com','Virat Gandhi');
      });
      echo "Email Sent with attachment. Check your inbox.";
   }

   /**
    *  Send mail to user
    */
   public function contactUsUserMail($contact_form)
   {

		$user_name = $contact_form['full_name'];
		$company_type = $contact_form['company_type'];
		$contact_number = $contact_form['contact_number'];
		$email_address = $contact_form['email_address'];
		$contact_message = $contact_form['message'];


	


// 		$msg = "<body>
// 		<table width='800' cellpadding='50' cellspacing='0' style='font-family: Arial, Helvetica, sans-serif; color:#000; font-size:12px; background:#eee;'>
// 		    <tr>
// 		        <td>
// 		            <table cellpadding='0' cellspacing='0'>
// 		                <tr>
// 		                    <td><img src='" . $siteUrl . "/fahrenheit_logo.png'></td>
// 		                </tr>
// 		                <tr>
// 		                    <td><table style='font-family: Arial, Helvetica, sans-serif; color:#000; font-size:12px; background:#fff' cellpadding='0' cellspacing='20'>
// 		                <tr>
// 		                    <td><table style='font-family: Arial, Helvetica, sans-serif; color:#000; font-size:12px;' cellpadding='7' cellspacing='0'>
// 		                <tr>
// 		                    <td >Dear " . $user_name . ",</td>
// 		                </tr>
// 		                <tr>
// 		                    <td>Thank you for contacting us. We will get back to you within the next 48 hours. If you need urgent attention or assistance please contact us on (Germany) +49 89 340 762-20..
// 				</td>
// 		                </tr>
// 		                <tr>
// 		                    <td >Below is a copy of your message for your records</td>
// 		                </tr>
// 		                <tr>
// 		                    <td >" . $contact_message . "</td>
// 		                </tr>
		               
// 		                <tr>
// 		                      <td >Fahrenheit Team <br/> 
// 							 www.fahrenheit.cool</td>
// 		                </tr>

		               
// 		                <tr>
// 		                    <td><table  cellpadding='0' cellspacing='0' style='color:#b2b2b2; font-size:11px; font-family: Arial, Helvetica, sans-serif; line-height:13px'>
// 		                <tr>
// 		                        <td> IMPORTANT INFORMATION *</td>
// 		                </tr>
// 		                <tr>
// 		                        <td >This document should be read only by those persons to whom it is addressed and its content is not intended for use by any other persons. If you have received this message in error, please notify us immediately at <a href ='mailto:hq@theentropolis.com' style='color:blue;'>info@fahrenheit.cool</a>. Please also destroy and delete the message from your computer. Any unauthorised form of reproduction of this message is strictly prohibited.
// FAHRENHEIT GmbH is not liable for the proper and complete transmission of the information contained in this communication, nor for any delay in its receipt.
//  </td><br/>
// 		                </tr>
		                
// 		        </table></td>
// 		                                                                                </tr>
// 		                                                                        </table></td>
// 		                                                        </tr>
// 		                                                </table></td>
// 		                                </tr>
		                              
// 		                                                </table></td>
// 		                                </tr>
// 		                        </table>
// 		                </td>
// 		        </tr>
// 		</table>
// 		</body>";


		$subject ='Contact via Contact Us Form';
		$data = array('name'=>$user_name,'contact_message'=>$contact_message,'type'=>'user');
        Mail::send('mail_templates.contact_us', $data, function($message) use($email_address,$subject) {
       //  $message->to($data['email_address_to'],  'asasas' );

         $message->to($email_address, $name = null);
         $message->subject($subject);
           // ('sssssssssssssssssss');
          $message->from('support@prospus.com','Fahrenheit');
      });

  		echo "HTML Email Sent. Check your inbox.";
   }

   /**
    *  Send mail to user
    */
   public function contactUsAdminMail($contact_form)
   {
		$user_name = $contact_form['full_name'];
		$company_type = $contact_form['company_type'];
		$contact_number = $contact_form['contact_number'];
		$email_address = $contact_form['email_address'];
		$contact_message = $contact_form['message'];

		// echo $siteUrl =	asset('/images/');


		// $msg = "<body>
		// <table width='800' cellpadding='50' cellspacing='0' style='font-family: Arial, Helvetica, sans-serif; color:#000; font-size:12px; background:#eee;'>
		//     <tr>
		//         <td>
		//             <table cellpadding='0' cellspacing='0'>
		//                 <tr>
		//                     <td><img src='" . $siteUrl . "/fahrenheit_logo.png'></td>
		//                 </tr>
		//                 <tr>
		//                     <td><table style='font-family: Arial, Helvetica, sans-serif; color:#000; font-size:12px; background:#fff' cellpadding='0' cellspacing='20'>
		//                 <tr>
		//                     <td><table style='font-family: Arial, Helvetica, sans-serif; color:#000; font-size:12px;' cellpadding='7' cellspacing='0'>
		//                 <tr>
		//                     <td >Hello,</td>
		//                 </tr>
		//                 <tr>
		//                     <td>You have received a new enquiry message for AdCalc via the Contact Us form:
		// 		</td>
		//                 </tr>
		//                 <tr>
		//                     <td ><b>Name:</b>  $user_name </td><br/>
		//                     <td ><b>Company:</b> $company_type</td><br/>
		//                     <td ><b>Tel No.:</b> $contact_number</td><br/>
		//                     <td ><b>Email:</b> $email_address</td><br/>
		//                 </tr>


		//                 <tr>
		//                     <td ><b>Message:</b> $contact_message</td>
		//                 </tr>
		               
		           

		                
		//         </table></td></tr>
		//         </table></td></tr>
		//         </table></td></tr>
		//          </table></td></tr>
		                   
		// </body>";

// echo $msg;die;
		$subject ='Enquiry via Contact Us Form';
		$data = array('user_name'=>$user_name,'contact_message'=>$contact_message,'type'=>'Admin','company_type'=>$company_type,'email_address'=>$email_address,'contact_number'=>$contact_number);
      
        Mail::send('mail_templates.contact_us', $data, function($message) use($email_address,$subject) {
   

         $message->to($email_address, $name = null);
         $message->subject($subject);

          $message->from('support@prospus.com','Fahrenheit');
      });

  		echo "HTML Email Sent. Check your inbox.";

   }
}