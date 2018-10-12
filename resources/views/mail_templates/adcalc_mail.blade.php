
 <?php //
 $siteUrl =  url('/').'/public/images/logo-banner.jpg';
// die;

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
                        <td>Congratulations! You have just received a new user registration for the AdCalc app!
                        </td>
                    </tr>
                    <tr>
                        <td><b>DETAILS OF USER</b>
                        </td>
                    </tr>
                    <tr>
                        <td width='800'>
                            Full Name:  <?php echo $customer; ?> <br/>
                            Email: <?php echo $email_address; ?>  <br/>
                            Phone Number: <?php echo $phone_number; ?>  <br/>
                            Contact: <?php echo $contact; ?>  <br/>
                            Location: <?php echo $location; ?><br/>
                            Project Number: <?php echo $project_number; ?><br/>
                            Project Name: <?php echo $project_name; ?><br/>

                            Editor: <?php echo $editor; ?><br/>
                            Company: <?php echo $company; ?><br/>
                            Address: <?php echo $address; ?><br/>
                            Tel. Number: <?php echo $personal_phone_number; ?><br/>
                            Mobile: <?php echo $mobile_number; ?><br/>
                            Email: <?php echo $personal_email_address; ?><br/>
                            </td>
                    </tr>
                    <tr>
                        <td >Regards,
                  </tr>
                    <tr>
                        <td ><b>Fahrenheit Team</b></td>
                  </tr>







            </table></td></tr>
            </table></td></tr>
            </table></td></tr>
             </table>

</body>
