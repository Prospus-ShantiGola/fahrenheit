
 <?php
 $siteUrl =  url('/').'/public/images/logo-banner.jpg';
 $new_user_html="";

 //Array ( [id] => 11 [name] => shanti gola [company] => Prospus Testing [phoneno] => 9582222957 [email] => shaan.gola4@gmail.com [password] => $2y$10$1NaMNQm25hXvOzo6SpgDNOo5Ff/r2WHEB2tOaXkHIk9QEZXf.LFoC [user_type_id] => 1 [status] => 1 [remember_token] => [created_at] => [updated_at] => [new_user] => 0 )
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
                            <td >Dear {{ ucwords($name) }},</td>
                        </tr>
                        <tr>
                            <td>Thank you for registering on Fahrenheit.</td>
                        </tr>
                        <tr>
                            <td ><b>Your Dashboard is Now Active</b></td>
                        </tr>
                        <?php
                        if($new_user==0){
                            $new_user_html = '<tr>
                                <td >Login: '.$email.'</td>
                            </tr>
                            <tr>
                                <td >Password: '.$password.'</td>
                            </tr>';
                            }
                            echo $new_user_html;
                        ?>
                        <tr>
                            <td> <b>Important to note</b></td>
                        </tr>
                        <tr>
                            <td> <ul>
                            <li>Go to <a href ='https://fahrenheit.cool/' style='color:blue;'>https://fahrenheit.cool/</a> and click on the login button on the top left of your screen and use the login provided to access your Dashboard.</li>
                            <li>Once you have logged into your dashboard you will be able to access the reports generated by you.</li>
                            <li>For questions in the meantime, please email us at <a href ='mailto:info@fahrenheit.cool' style='color:blue;'>info@fahrenheit.cool</a>.</li>
                            </ul></td>
                        </tr>
                        <tr>
                            <td>
                                    If you would like to discuss the program with a member of our team please phone +49 89 340762-20 or email <a href ='mailto:info@fahrenheit.cool' style='color:blue;'>info@fahrenheit.cool</a>.
                            </td>
                        </tr>
                        <tr>
                            <td>
                                    Warm regards,
                            </td>
                        </tr>
                        <tr>
                              <td ><b>Fahrenheit Team</b></td>
                        </tr>
                        <tr>
                                <td>
                                        FAHRENHEIT GmbH
                                </td>
                            </tr>
                            <tr>
                                    <td>
                                            Zscherbener Landstr. 17<br>
                                            06126 Halle (Saale)<br>
                                            Germany
                                    </td>
                                </tr>
                                <tr>
                                        <td>
                                                <b>E</b> info@fahrenheit.cool<br>
                                                <b>P</b> +49 89 340762-20<br>
                                                <a href ='https://fahrenheit.cool/adcalc' style='color:blue;'>https://fahrenheit.cool/adcalc</a>
                                        </td>
                                    </tr>


                        <tr>
                            <td><table  cellpadding='0' cellspacing='0' style='color:#b2b2b2; font-size:11px; font-family: Arial, Helvetica, sans-serif; line-height:13px'>
                        <tr>
                                <td> IMPORTANT INFORMATION *</td>
                        </tr>
                        <tr>
                                <td >This document should be read only by those persons to whom it is addressed and its content is not intended for use by any other persons. If you have received this message in error, please notify us immediately at <a href ='mailto:info@fahrenheit.cool' style='color:blue;'>info@fahrenheit.cool</a>. Please also destroy and delete the message from your computer. Any unauthorised form of reproduction of this message is strictly prohibited.
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


