<?php
error_reporting(0);

date_default_timezone_set("Asia/Jakarta");

require 'koneksi.inc.php';
require 'generate-token.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


function kirimEmail($nim, $email, $namaLengkap)
{
    $mail = new PHPMailer();
    $mail->isSMTP();
    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    //Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';
    //Set the hostname of the mail server
    /*$mail->Host = 'ssl://mail.microipb.id';*/
    // $mail->Host = "ssl://smtp.gmail.com";
    $mail->Host = 'smtp.gmail.com';
    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6
    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    /*$mail->Port = 465;*/
    $mail->Port = 587;
    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;
    //Username to use for SMTP authentication - use full email address for gmail
    /*$mail->Username = "pemira@microipb.id";*/
    $mail->Username = 'yoviputrantoo@gmail.com';
    //Password to use for SMTP authentication
    /*$mail->Password = "!+U2$0*aalNi";*/
    $mail->Password = "yovi2605";

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    $mail->setFrom('pemira@microipb.ac.id', 'Pemira MICRO IT IPB');
    //$mail->setFrom('admin@localhost', 'Pemira MICRO IT IPB');
    $mail->addAddress($email);
    $mail->Subject  = 'Token Pemira MICRO IT IPB 2019';
    $mail->isHTML(true);

    //$oldtoken = random_str(6);
    $token = "PEMIRA-" . getToken(5);
    //$token = 'P'.$oldtoken.'2019';
    $sql = "UPDATE pemilih SET token = '$token' WHERE nim = '$nim'";
    mysqli_query($GLOBALS['kon'], $sql);
    /*
    $mail->Body = '
    <div style="background-color: #3668e4; color: white;">
        <h2 style="padding: 20px;">Pemira MICRO IT IPB 2019</h2>
    </div>
    <div style="font-family: Arial; padding: 20px;">
        <h3 style="font-weight: normal; margin-bottom: 25px;">Halo, <b>'.$namaLengkap.'</b>!</h3>
        <p style="margin-bottom: 15px;">Terima kasih telah melakukan verifikasi E-Vote Pemira HIMAVO MICRO IT IPB.</p>
        <p style="margin-bottom: 15px;">Untuk langkah selanjutnya, ketikkan token dibawah ini pada website Pemira HIMAVO MICRO IT IPB (pemira.microipb.id) untuk memverifikasi NIM Anda.</p>

        <p>Catatan : Token ini hanya bisa digunakan sekali saja. Gunakan hak suara Anda dengan bijak.</p>
        
        <p>Salam,</p>
        <p>Admin Pemira HIMAVO MICRO IT IPB 2019</p>

        <div style="width: fit-content; border-radius: 2px; background-color: #3668e4; color: white;">
            <h3 style="padding: 15px 30px;">'.$token.'</h3>
        </div>
    </div>';
    */
    $mail->Body = '
    <!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <meta name="format-detection" content="telephone=no,address=no,email=no,date=no,url=no"> <!-- Tell iOS not to automatically link certain text strings. -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <!-- Web Font / @font-face : BEGIN -->
    <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->

    <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->
    <!--[if mso]>
        <style>
            * {
                font-family: sans-serif !important;
            }
        </style>
    <![endif]-->

    <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
    <!--[if !mso]><!-->
    <!--<![endif]-->

    <!-- Web Font / @font-face : END -->

    <!-- CSS Reset : BEGIN -->
    <style>

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
		table,
		/*
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
		}
		*/

        /* What it does: Fixes webkit padding issue. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
        a {
            text-decoration: none;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        a[x-apple-data-detectors],  /* iOS */
        .unstyle-auto-detected-links a,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from changing the text color in conversation threads. */
        .im {
            color: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
        .a6S {
           display: none !important;
           opacity: 0.01 !important;
		}
		img.g-img + div {
		   display: none !important;
		}

        /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            u ~ div .email-container {
                min-width: 320px !important;
            }
        }
        /* iPhone 6, 6S, 7, 8, and X */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            u ~ div .email-container {
                min-width: 375px !important;
            }
        }
        /* iPhone 6+, 7+, and 8+ */
        @media only screen and (min-device-width: 414px) {
            u ~ div .email-container {
                min-width: 414px !important;
            }
        }

    </style>

    <!-- What it does: Makes background images in 72ppi Outlook render at correct size. -->
    <!--[if gte mso 9]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->

    <!-- CSS Reset : END -->

    <!-- Progressive Enhancements : BEGIN -->
    <style>

        /* What it does: Hover styles for buttons */
        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }
	    .button-td-primary:hover,
	    .button-a-primary:hover {
	        background: #555555 !important;
	        border-color: #555555 !important;
	    }

        /* Media Queries */
        @media screen and (max-width: 600px) {

            .email-container {
                width: 100% !important;
                margin: auto !important;
            }

            /* What it does: Forces table cells into full-width rows. */
            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
            /* And center justify these ones. */
            .stack-column-center {
                text-align: center !important;
            }

            /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }

            /* What it does: Adjust typography on small screens to improve readability */
            .email-container p {
                font-size: 17px !important;
            }
        }

    </style>
    <!-- Progressive Enhancements : END -->

</head>
<!--
	The email background color (#222222) is defined in three places:
	1. body tag: for most email clients
	2. center tag: for Gmail and Inbox mobile apps and web versions of Gmail, GSuite, Inbox, Yahoo, AOL, Libero, Comcast, freenet, Mail.ru, Orange.fr
	3. mso conditional: For Windows 10 Mail
-->
<body width="100%" style="margin: 0; padding: 0 !important; /*mso-line-height-rule: exactly;*/ background-color: #ffffff;">
	<center style="width: 100%; background-color: #ffffff;">
    <!--[if mso | IE]>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #222222;">
    <tr>
    <td>
    <![endif]-->

        <!-- Visually Hidden Preheader Text : BEGIN -->
        <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; /*mso-hide: all;*/ font-family: sans-serif;">
        Terima kasih telah melakukan verifikasi token. Silakan salin tokenmu ke halaman verifikasi token PEMIRA HIMAVO MICRO IT 2019.
        </div>
        <!-- Visually Hidden Preheader Text : END -->

        <!-- Create white space after the desired preview text so email clients don’t pull other distracting text into the inbox preview. Extend as necessary. -->
        <!-- Preview Text Spacing Hack : BEGIN -->
        <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; /*mso-hide: all;*/ font-family: sans-serif;">
	        &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
        </div>
        <!-- Preview Text Spacing Hack : END -->

        <!-- Email Body : BEGIN -->
		<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="margin: auto;" class="email-container">
			
			
	        <!-- Clear Spacer : BEGIN -->
	        <tr>
				<td aria-hidden="true" height="40" style="font-size: 0px; line-height: 0px;">
					&nbsp;
				</td>
			</tr>
			<!-- Clear Spacer : END -->
	

	        <!-- Email Header : BEGIN -->
            <!--tr>
                <td style="padding: 20px 0; text-align: center">
                    <img src="https://via.placeholder.com/200x50" width="200" height="50" alt="alt_text" border="0" style="height: auto; background: #dddddd; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;">
                </td>
            </tr-->
	        <!-- Email Header : END -->


	        <!-- Thumbnail Left, Text Right : BEGIN -->
	        <tr>
	            <td dir="ltr" width="100%" style="padding: 10px; background-color: #ffffff;">
	                <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
	                    <tr>
	                        <!-- Column : BEGIN -->
	                        <td width="33.33%" class="stack-column-center">
	                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
	                                <tr>
	                                    <td dir="ltr" valign="top" style="padding: 0 10px;">
	                                        <img src="http://naufalist.com/pemira.microipb.id/images/microit.png" width="170" height="170" alt="alt_text" border="0" class="center-on-narrow" style="height: auto; background: #ffffff; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;">
	                                    </td>
	                                </tr>
	                            </table>
	                        </td>
	                        <!-- Column : END -->
	                        <!-- Column : BEGIN -->
	                        <td width="66.66%" class="stack-column-center">
	                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
	                                <tr>
	                                    <td dir="ltr" valign="top" style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 10px; text-align: left;" class="center-on-narrow">
	                                        <h2 style="margin: 0 0 10px 0; font-family: sans-serif; font-size: 18px; line-height: 22px; color: #333333; font-weight: bold;">Halo, ' . $namaLengkap . '!</h2>
	                                        <p style="margin: 0 0 10px 0; text-align: justify">Terima kasih telah melakukan verifikasi E-Vote.<br>Token ini hanya bisa digunakan sekali saja.<br>Gunakan hak suara Anda dengan bijak.</p>
	                                        <!-- Button : BEGIN -->
	                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" class="center-on-narrow" style="float:left;">
	                                            <tr>
                                                    <td style="border-radius: 4px; background: #222222;">
														<span style="background: #7a75b5; border: 1px solid #7a75b5; font-family: sans-serif; font-size: 25px; line-height: 15px; text-decoration: none; padding: 13px 17px; color: #ffffff; display: block; border-radius: 4px;"><b>' . $token . '</b></span>
													</td>
	                                          </tr>
	                                      </table>
	                                      <!-- Button : END -->
	                                    </td>
	                                </tr>
	                            </table>
	                        </td>
	                        <!-- Column : END -->
	                    </tr>
	                </table>
	            </td>
	        </tr>
			<!-- Thumbnail Left, Text Right : END -->
			

	    </table>
	    <!-- Email Body : END -->

	    <!-- Email Footer : BEGIN -->
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="margin: auto;" class="email-container">
	        <tr>
	            <td style="padding: 20px; font-family: sans-serif; font-size: 12px; line-height: 15px; text-align: center; color: #888888;">
	                <br>
	                Sekolah Vokasi Institut Pertanian Bogor<br><span class="unstyle-auto-detected-links">Jl. Kumbang No.24, Babakan, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16128.</span>
	            </td>
	        </tr>
	    </table>
        <!-- Email Footer : END -->


    <!--[if mso | IE]>
    </td>
    </tr>
    </table>
    <![endif]-->
    </center>
</body>
</html>

    ';
    if (!$mail->send()) {
        $log = "[" . date('d-m-Y H:i:s') . "] GAGAL | " . $nim . " | " . $email . "
        ";
        $a = fopen("mail_log", "a");
        fwrite($a, $log);
        fclose($a);

        // echo 'Message was not sent.';
        // echo 'Mailer error: ' . $mail->ErrorInfo;
        // exit();
    } else {

        $log = "[" . date('d-m-Y H:i:s') . "] BERHASIL | " . $nim . " | " . $email . "
";
        $a = fopen("mail_log", "a");
        fwrite($a, $log);
        fclose($a);

        // echo "Message was sent";
        // exit();
    }
}

// kirimEmail('J3D118042', 'muhammad_naufal@apps.ipb.ac.id', 'Muhammad Naufal');
// kirimEmail('fakhranhadyan@gmail.com', 'Muhammad Fakhran Hadyan');
// kirimEmail('chat.buditmj@gmail.com', 'Budi Triatmojo');
