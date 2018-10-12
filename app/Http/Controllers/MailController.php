<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
    public function basic_email()
    {
        $data = array('name' => "Virat Gandhi");

        Mail::send(['text' => 'mail'], $data, function ($message) {
            $message->to('prospus.artisharma@gmail.com', 'Tutorials Point')->subject('Laravel Basic Testing Mail');
            $message->from('support@prospus.com', 'Fahrenheit');
        });
        echo "success";
        exit();
    }
    public function html_email($message_ary)
    {


        $msg = $message_ary['message'];
        echo $email_address = $message_ary['email_address_to'];

        $user_name = $message_ary['user_name'];
        $subject = $message_ary['subject'];



        $data = array('name' => $user_name, 'email_address' => $email_address);
        Mail::send('pages.adcalc', $data, function ($message) {
       //  $message->to($data['email_address_to'],  'asasas' );

            $message->to($email_address, $name = null);
            $message->subject($subject);
           // ('sssssssssssssssssss');
            $message->from('support@prospus.com', 'Fahrenheit');
        });
        echo "HTML Email Sent. Check your inbox.";
    }
    public function attachment_email()
    {
        $data = array('name' => "Virat Gandhi");
        Mail::send('mail', $data, function ($message) {
            $message->to('abc@gmail.com', 'Tutorials Point')->subject('Laravel Testing Mail with Attachment');
            $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
            $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
            $message->from('xyz@gmail.com', 'Virat Gandhi');
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
        $email_address = $contact_form['emailaddress'];
        $contact_message = $contact_form['message'];


        $subject = 'Contact via Contact Us Form';
        $data = array('user_name' => $user_name, 'contact_message' => $contact_message, 'type' => 'User');

        Mail::send('mail_templates.contact_us', $data, function ($message) use ($email_address, $subject) {
       //  $message->to($data['email_address_to'],  'asasas' );

            $message->to($email_address, $name = null);
            $message->subject($subject);
           // ('sssssssssssssssssss');
            $message->from('support@prospus.com', 'Fahrenheit');
        });

  		//echo "success";
    }

    /**
     *  Send mail to user
     */
    public function contactUsAdminMail($contact_form)
    {
        $user_name = $contact_form['full_name'];
        $company_type = $contact_form['company_type'];
        $contact_number = $contact_form['contact_number'];
        $email_address = $contact_form['emailaddress'];
        $contact_message = $contact_form['message'];


        $subject = 'Enquiry via Contact Us Form';
        $data = array('user_name' => $user_name, 'contact_message' => $contact_message, 'type' => 'Admin', 'company_type' => $company_type, 'email_address' => $email_address, 'contact_number' => $contact_number);

        Mail::send('mail_templates.contact_us', $data, function ($message) use ($email_address, $subject) {


            $message->to('bhanu.bhowmik@prospus.com', $name = null);
            $message->subject($subject);

            $message->from('support@prospus.com', 'Fahrenheit');
        });

        return "success";

    }
    public function sendProjectEmailAdmin($contact_form)
    {
        $subject="New User Registration Confirmation";
        $email_address = $contact_form['email_address'];
        dd($contact_form);
        Mail::send('mail_templates.adcalc_mail', $contact_form, function ($message) use ($email_address, $subject) {
            $message->to('prospus.shantigola@gmail.com', $name = null);
            $message->subject($subject);
            $message->from('support@prospus.com', 'Fahrenheit');
        });
        return "success";

    }
    /**
     * Send User activation email
     *
     */
    public function sendActivationEmailUser($contact_form)
    {
        $subject = 'Welcome to Fahrenheit';
        $email_address = 'prospus.shantigola@gmail.com';
        Mail::send('mail_templates.activate_user', $contact_form, function ($message) use ($email_address, $subject) {
            $message->to('prospus.shantigola@gmail.com', $name = null);
            $message->subject($subject);
            $message->from('support@prospus.com', 'Fahrenheit');
        });
        return "success";

    }
}
