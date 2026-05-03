<?php
session_start();

require_once __DIR__ . '/includes/send_premium_mail.php';

if(isset($_REQUEST['submit_collection_inquiry'])) {

    // CSRF/Spam Protection
    if (!isset($_POST['form_time']) || (time() - $_POST['form_time'] < 3)) {
        echo json_encode(['status' => 'error', 'message' => 'Spam detected. Please try again.']);
        exit;
    }
    if (!empty($_POST['firstname'])) {
        echo json_encode(['status' => 'error', 'message' => 'Spam detected.']);
        exit;
    }

    $product      = htmlspecialchars(trim($_POST['product_name'] ?? ''));
    $wood_type    = htmlspecialchars(trim($_POST['wood_type'] ?? ''));
    $finish_type  = htmlspecialchars(trim($_POST['finish_type'] ?? ''));
    $color_shade  = htmlspecialchars(trim($_POST['color_shade'] ?? ''));
    $custom_color = htmlspecialchars(trim($_POST['custom_color'] ?? ''));
    $size         = htmlspecialchars(trim($_POST['size'] ?? ''));
    $requirements = htmlspecialchars(trim($_POST['requirements'] ?? ''));
    
    // User Info
    $user_name    = htmlspecialchars(trim($_POST['user_name'] ?? ''));
    $user_email   = htmlspecialchars(trim($_POST['user_email'] ?? ''));
    $user_phone   = htmlspecialchars(trim($_POST['user_phone'] ?? ''));

    if (empty($product) || empty($wood_type) || empty($finish_type) || empty($user_name) || empty($user_email) || empty($user_phone)) {
        echo json_encode(['status' => 'error', 'message' => 'Please fill in the required fields including Name, Email, and Phone.']);
        exit;
    }

    $final_shade = ($color_shade === 'Custom' && !empty($custom_color)) ? $custom_color : $color_shade;

    $details_html = "
        <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>Name:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$user_name}</td></tr>
        <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>Email:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$user_email}</td></tr>
        <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>Phone:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$user_phone}</td></tr>
        <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>Product:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$product}</td></tr>
        <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>Wood Type:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$wood_type}</td></tr>
        <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>Finish Type:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$finish_type}</td></tr>
        <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>Color Shade:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$final_shade}</td></tr>
        <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>Size/Dimensions:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$size}</td></tr>
        <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;' valign='top'><strong>Special Requirements:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>" . nl2br($requirements) . "</td></tr>
    ";

    $subject = "New Custom Furniture Inquiry: $product";
    $title = "Your Custom Furniture Selection";
    $subtitle = "Dear <strong>{$user_name}</strong>,<br>Thank you for exploring our custom furniture collection. We have received your inquiry for the <strong>{$product}</strong>.";

    $status = send_premium_mail($user_email, $user_name, $subject, $title, $subtitle, $details_html, false);

    if ($status) {
        echo json_encode(['status' => 'success', 'message' => 'Your inquiry has been sent successfully! We have also sent a copy to your email.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => "Message could not be sent. Please try again later."]);
    }
}
?>
