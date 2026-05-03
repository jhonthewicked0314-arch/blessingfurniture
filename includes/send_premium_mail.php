<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../PHPMailer/Exception.php';
require_once __DIR__ . '/../PHPMailer/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/SMTP.php';

function send_premium_mail($to_email, $to_name, $subject, $title, $subtitle, $details_html, $is_admin_copy = false) {
    $mail = new PHPMailer(true);

    try {
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'v06139343@gmail.com'; 
        $mail->Password   = 'vowtssylzigbnhgo'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('v06139343@gmail.com', 'Blessings Furniture');

        if ($is_admin_copy) {
            // Send to admins directly
            $mail->addAddress('richvicky359@gmail.com', 'Admin');
            $mail->addAddress('jhonthewicked0314@gmail.com', 'Admin');
            $mail->addAddress('iamwithsanjay@gmail.com', 'Admin');
            $mail->addReplyTo($to_email, $to_name);
        } else {
            // Send to user
            $mail->addAddress($to_email, $to_name);
            // BCC Admins
            $mail->addBCC('richvicky359@gmail.com');
            $mail->addBCC('jhonthewicked0314@gmail.com');
            $mail->addBCC('iamwithsanjay@gmail.com');
            
        }

        $mail->isHTML(true);
        $mail->Subject = $subject;

        $logoUrl = "https://typequicky.com/blessings-furniture/assets/images/logo/mail-logo.webp";

        $html = "
        <div style='background-color:#FDF8F2; padding: 40px 20px; font-family: \"Helvetica Neue\", Helvetica, Arial, sans-serif; color: #594D42;'>
            <div style='max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(59, 42, 30, 0.05); border: 1px solid #E8DDCE;'>
                
                <!-- Header -->
                <div style='background-color: #3B2A1E; padding: 30px 20px; text-align: center; border-bottom: 4px solid #C89F56;'>
                    <img src='{$logoUrl}' alt='Blessings Furniture' style='height: 80px; width: auto; max-width: 100%; display: block; margin: 0 auto;'>
                </div>

                <!-- Body Content -->
                <div style='padding: 40px 30px;'>
                    <h2 style='color: #3B2A1E; margin-top: 0; font-size: 24px; font-weight: 600;'>{$title}</h2>
                    <p style='font-size: 16px; line-height: 1.6; color: #594D42; margin-bottom: 30px;'>{$subtitle}</p>
                    
                    <div style='background-color: #F9F5F0; border-left: 4px solid #C89F56; padding: 20px; border-radius: 4px; margin-bottom: 30px;'>
                        <h3 style='margin-top: 0; font-size: 16px; color: #3B2A1E; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px;'>Inquiry Details</h3>
                        <table style='width: 100%; border-collapse: collapse; font-size: 15px;'>
                            {$details_html}
                        </table>
                    </div>

                    <p style='font-size: 15px; line-height: 1.6; color: #666;'>
                        Our team will review your requirements and get back to you shortly. If you have any urgent queries, feel free to call us at <a href='tel:+919876543210' style='color: #C89F56; text-decoration: none; font-weight: bold;'>+91-9876543210</a>.
                    </p>
                </div>

                <!-- Footer -->
                <div style='background-color: #FDF8F2; padding: 20px; text-align: center; border-top: 1px solid #E8DDCE;'>
                    <p style='margin: 0; font-size: 13px; color: #888;'>
                        <strong>Blessings Furniture</strong><br>
                        Coimbatore, Tamil Nadu<br>
                        <a href='https://blessingfurnitures.in' style='color: #C89F56; text-decoration: none;'>www.blessingfurnitures.in</a>
                    </p>
                </div>
            </div>
        </div>
        ";

        $mail->Body = $html;
        return $mail->send();

    } catch (Exception $e) {
        return false;
    }
}
?>
