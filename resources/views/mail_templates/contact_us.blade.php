
 <?php //
 $siteUrl =  url('/').'/public/images/logo-banner.jpg';
// die;

 //$siteUrl = 'C:\xampp7\htdocs\fahrenheit\public\images\logo-banner.jpg' ;//public_path().'\images\fahrenheit_logo.png';


if($type =='User')
{


 ?>
<body>
        <table width='800' cellpadding='50' cellspacing='0' style='font-family: Arial, Helvetica, sans-serif; color:#000; font-size:12px; background:#eee;'>
            <tr>
                <td>
                    <table cellpadding='0' cellspacing='0'>
                        <tr>
                            <td><img src="<?php echo $siteUrl; ?>"></td>
                        </tr>
                        <tr>
                            <td><table style='font-family: Arial, Helvetica, sans-serif; color:#000; font-size:12px; background:#fff' cellpadding='0' cellspacing='20'>
                        <tr>
                            <td><table style='font-family: Arial, Helvetica, sans-serif; color:#000; font-size:12px;' cellpadding='7' cellspacing='0'>
                        <tr>
                            <td >Dear {{ $user_name }},</td>
                        </tr>
                        <tr>
                            <td>Thank you for contacting us. We will get back to you within the next 48 hours. If you need urgent attention or assistance please contact us on (Germany) +49 89 340 762-20.
                </td>
                        </tr>
                        <tr>
                            <td >Below is a copy of your message for your records:</td>
                        </tr>
                        <tr>
                            <td >{{ $contact_message }}</td>
                        </tr>
                       
                        <tr>
                              <td >Fahrenheit Team <br/> 
                             www.fahrenheit.cool</td>
                        </tr>

                       
                        <tr>
                            <td><table  cellpadding='0' cellspacing='0' style='color:#b2b2b2; font-size:11px; font-family: Arial, Helvetica, sans-serif; line-height:13px'>
                        <tr>
                                <td> IMPORTANT INFORMATION *</td>
                        </tr>
                        <tr>
                                <td >This document should be read only by those persons to whom it is addressed and its content is not intended for use by any other persons. If you have received this message in error, please notify us immediately at <a href ='mailto:hq@theentropolis.com' style='color:blue;'>info@fahrenheit.cool</a>. Please also destroy and delete the message from your computer. Any unauthorised form of reproduction of this message is strictly prohibited.
FAHRENHEIT GmbH is not liable for the proper and complete transmission of the information contained in this communication, nor for any delay in its receipt.
 </td><br/>
                        </tr>
                        
                </table></td>
                                                                                        </tr>
                                                                                </table></td>
                                                                </tr>
                                                        </table></td>
                                        </tr>
                                      
                                                        </table></td>
                                        </tr>
                                </table>
                        </td>
                </tr>
        </table>
</body>

<?php } else{


    ?>

    <body>
        <table width='800' cellpadding='50' cellspacing='0' style='font-family: Arial, Helvetica, sans-serif; color:#000; font-size:12px; background:#eee;'>
            <tr>
                <td>
                    <table cellpadding='0' cellspacing='0'>
                        <tr>
                            <td><img src="<?php echo $siteUrl ;?>"></td>
                        </tr>
                        <tr>
                            <td><table style='font-family: Arial, Helvetica, sans-serif; color:#000; font-size:12px; background:#fff' cellpadding='0' cellspacing='20'>
                        <tr>
                            <td><table style='font-family: Arial, Helvetica, sans-serif; color:#000; font-size:12px;' cellpadding='7' cellspacing='0'>
                        <tr>
                            <td >Hello,</td>
                        </tr>
                        <tr>
                            <td>You have received a new enquiry message for AdCalc via the Contact Us form:
                            </td>
                        </tr>
                        <tr>
                            <td width='800'><b>Name:</b>  <?php echo $user_name; ?> <br/>   
                            <b>Company:</b> <?php echo $company_type; ?>  <br/>   
                             <b>Tel No.:</b> <?php echo $contact_number; ?>  <br/>   
                               
                               <b>Email:</b> <?php echo $email_address; ?>
                                </td>   </tr>
                    


                        <tr>
                            <td ><b>Message:</b> <?php echo $contact_message; ?>  </td>
                        </tr>
                       
                   

                        
                </table></td></tr>
                </table></td></tr>
                </table></td></tr>
                 </table>                 
                           
        </body>
<?php }?>