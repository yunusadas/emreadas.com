<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

session_cache_limiter('nocache');
header('Expires: ' . gmdate('r', 0));
header('Content-type: application/json');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $name = isset($_POST["name"]) ? $_POST["name"] : null;
    $email = isset($_POST["email"]) ? $_POST["email"] : null;
    $message = isset($_POST["message"]) ? $_POST["message"] : null;
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : null;
    $form_title = isset($_POST["baslik"]) ? $_POST["baslik"] : null;

    if (empty($email) || empty($name) || empty($message)) {
        $response = array('response' => 'error', 'message' => "Please fill all blanks.");
        echo json_encode($response);
        return false;
    }


    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = TRUE;
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;
    $mail->Username = "admin@baygunhirdavat.com";
    $mail->Password = "v46a.TYz3.:Ic2L-";
    $mail->Host = "mail.kurumsaleposta.com";
    $mail->Mailer = "smtp";
    $mail->CharSet = 'UTF-8';
    $mail->AddAddress("info@baygunhirdavat.com");
    $mail->SetFrom("admin@baygunhirdavat.com", "Baygun Hırdavat İletişim");
    $mail->IsHTML();
    $mail->WordWrap = 80;

    $tatil_template_durum = eposta_gonder($mail, 'İletişim Formu Yeni İleti', tatil_template($form_title, $_POST), "info@baygunhirdavat.com");
    $response = ['response' => 'success'];

    if ($tatil_template_durum)
        eposta_gonder($mail, "Başvurunuz için teşekkür ederiz.", tesekkur_template($name, $form_title), $email);
    else
        $response = ['response' => 'error', 'message' => $mail->ErrorInfo];


     header('Location: ../iletisim.php');


};

function eposta_gonder($mail_obj, $baslik, $template, $giden_adres)
{
    $mail_obj->clearAddresses();
    $mail_obj->AddAddress($giden_adres);
    $mail_obj->Subject = $baslik;
    $mail_obj->MsgHTML($template);

    if ($mail_obj->Send())
        return true;
    else
        return false;
}

function tesekkur_template($name, $form_title)
{
    $kullanici_mail_template = '<table width="100%" cellspacing="40" cellpadding="0" bgcolor="#F5F5F5"><tbody><tr><td>';
    $kullanici_mail_template .= '<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F5F5" style="border-spacing:0;font-family:sans-serif;color:#475159;margin:0 auto;width:100%;max-width:600px"><tbody>';
    $kullanici_mail_template .= '<tr><td style="padding-top:20px;padding-left:0px;padding-right:0px;width:100%;text-align:right; font-size:12px;line-height:22px">Bu e-posta &nbsp;' . $_SERVER['HTTP_HOST'] . '&nbsp; iletişim formundan gönderilmiştir.</td></tr>';
    $kullanici_mail_template .= '</tbody></table>';
    $kullanici_mail_template .= '<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F5F5" style="padding: 50px; border-spacing:0;font-family:sans-serif;color:#475159;margin:0 auto;width:100%;max-width:600px; background-color:#ffffff;"><tbody>';
    $kullanici_mail_template .= '<tr><td style="font-weight:bold;font-family:Arial,sans-serif;font-size:36px;line-height:42px">' . $form_title . '</td></tr>';
    $kullanici_mail_template .= '<tr><td style="padding-top:25px;padding-bottom:40px; font-size:16px;">';
    $kullanici_mail_template .= '<p style="display:block;margin-bottom:10px;"><strong>Sayın ' . $name . ', </strong></p>';
    $kullanici_mail_template .= '<p style="display:block;margin-bottom:10px;">Web sitemizden doldurmuş olduğunuz form tarafımıza ulaştı. Göstermiş olduğunuz ilgiden dolayı teşekkür ederiz. </strong></p>';
    $kullanici_mail_template .= '<p style="display:block;margin-bottom:10px;">Müşteri danışmanlarımız, en kısa sürede tarafına dönüş sağlayacaktır.. İhtiyaçlarınızı anlamak ve sizi  bilgilendirmek için en kısa sürede tarafınızla iletişime geçeceğiz.</p>';
    $kullanici_mail_template .= '<p style="display:block;margin-bottom:10px;">Sağlıklı ve keyifli günler dileriz.</p>';
    $kullanici_mail_template .= '<img src="cid:signature" alt="">';
    $kullanici_mail_template .= '</td></tr>';
    $kullanici_mail_template .= '<tr><td style="padding-top:16px;font-size:12px;line-height:24px;color:#767676; border-top:1px solid #f5f7f8;">E-Posta Gönderim Zamanı: ' . date("F j, Y, g:i a") . '</td></tr>';
    $kullanici_mail_template .= '</tbody></table>';
    $kullanici_mail_template .= '</td></tr></tbody></table>';


    return $kullanici_mail_template;
}

function tatil_template($form_title, $post)
{
    $mail_template = '<table width="100%" cellspacing="40" cellpadding="0" bgcolor="#F5F5F5"><tbody><tr><td>';
    $mail_template .= '<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F5F5" style="border-spacing:0;font-family:sans-serif;color:#475159;margin:0 auto;width:100%;max-width:600px"><tbody>';
    $mail_template .= '<tr><td style="padding-top:20px;padding-left:0px;padding-right:0px;width:100%;text-align:right; font-size:12px;line-height:22px">Bu e-posta &nbsp;' . $_SERVER['HTTP_HOST'] . '&nbsp; iletişim formundan gönderilmiştir.</td></tr>';
    $mail_template .= '</tbody></table>';
    $mail_template .= '<table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F5F5" style="padding: 50px; border-spacing:0;font-family:sans-serif;color:#475159;margin:0 auto;width:100%;max-width:600px; background-color:#ffffff;"><tbody>';
    $mail_template .= '<tr><td style="font-weight:bold;font-family:Arial,sans-serif;font-size:36px;line-height:42px">' . $form_title . '</td></tr>';
    $mail_template .= '<tr><td style="padding-top:25px;padding-bottom:40px; font-size:16px;">';
    $mail_template .= '<p style="display:block;margin-bottom:10px;">Adı Soyadı: <strong>' . $post["name"] . '</strong></p>';
    $mail_template .= '<p style="display:block;margin-bottom:10px;">E-posta Adresi: <strong>' . $post["email"] . '</strong></p>';
    $mail_template .= '<p style="display:block;margin-bottom:10px;">Telefon No: <strong>' . $post["phone"] . '</strong></p>';
    $mail_template .= '<p style="display:block;margin-bottom:10px;">Konu: <strong>' . $post["service"] . '</strong></p>';
    $mail_template .= '<p style="display:block;margin-bottom:10px;">Mesaj: <strong>' . $post["message"] . '</strong></p>';
    $mail_template .= '</td></tr>';
    $mail_template .= '<tr><td style="padding-top:16px;font-size:12px;line-height:24px;color:#767676; border-top:1px solid #f5f7f8;">E-Posta Gönderim Zamanı: ' . date("F j, Y, g:i a") . '</td></tr>';
    $mail_template .= '</tbody></table>';
    $mail_template .= '</td></tr></tbody></table>';
    return $mail_template;
}