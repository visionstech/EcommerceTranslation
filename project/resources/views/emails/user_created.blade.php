<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<html>
    <head>
    </head>
    <body>
        <table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#F4F3F4">
            <tbody>
                <tr>
                    <td style="padding: 15px;"><center>
                <table width="600" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff">
                    <tbody>
                        <tr>
                            <td align="left">
                                <table id="header" style=" padding: 10px; text-align: center; line-height: 1.6; font-size: 12px; font-family: Helvetica, Arial, sans-serif; color: #444;" border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" valign="bottom"><a href="http://staging.visionsdemo.com/EQHO"><img class="alignleft size-full wp-image-4420" src="{{ asset('/images/VICE_DIGITAL_BLACK-02.png') }}" alt="success_email_header" width="150" /></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table id="footer" style="line-height: 1.5; font-size: 12px; font-family: Arial, sans-serif; margin-right: 15px; margin-left: 15px; text-align: left;  padding: 10px; width: 100%; margin: 15px auto;" border="0" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                    <tbody>
                                        <tr>
                                            <td> Hi {{ $name }},<br/> <br/> 
                                                You have registered successfully by Admin.<br/>
                                                Below are the details of your account.<br/></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table id="content" style="margin-top: 15px; margin-right: 15px; margin-left: 15px; color: #444; line-height: 1.6; font-size: 12px; font-family: Arial, sans-serif;" border="0" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                    <tbody>
                                        <tr>
                                            <td style="border-top: solid 1px #d9d9d9;" colspan="2">
                                                <div style="padding: 15px 0;">
                                                    <b>Email : </b>{{ $email }}
                                                    <br/>
                                                     <b>Password : </b>{{ $password }}
                                                    <br/>
                                                    <b>Domain : </b>{{ $domain }}
                                                    <br/>
                                                     <b>You subscribed the following products:
                                                    <br/>
                                                    <?php
                                                        if($overlays!=0){
                                                            echo "<b>Overlays</b><br/>";
                                                        }
                                                        if($infusion!=0){
                                                            echo "<b>Infusion</b><br/>";
                                                        }
                                                        if($dynamic_ads!=0){
                                                            echo "<b>Dynamic Ads</b><br/>";
                                                        }
                                                        if($programmatic!=0){
                                                            echo "<b>Programmatic</b><br/>";
                                                        }
                                                        if(($overlays==0) && ($infusion==0) && ($dynamic_ads==0) && ($programmatic==0)){
                                                            echo "<b>N/A</b><br/>";
                                                        }
                                                    ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table id="footer" style="line-height: 1.5; font-size: 11px; font-family: Arial, sans-serif; margin-right: 15px; margin-left: 15px; text-align: center; background: #4c4845; color: #ffffff; padding: 10px; width: 600px; margin: 15px auto;" border="0" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                    <tbody>
                                        <tr>
                                            <td>© Copyright {{ date('Y') }} Vice Digital. All Rights Reserved.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </center></td>
    </tr>
</tbody>
</table>
</body>
</html> 