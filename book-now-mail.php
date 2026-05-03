<?php
session_start();
require_once __DIR__ . '/includes/send_premium_mail.php';

// Check if it's an AJAX request (from modal)
$is_ajax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

if(isset($_REQUEST['submit_booking'])){
    $form_time = $_POST['form_time'] ?? 0;
    $current_time = time();
    if ($current_time - $form_time < 2) {
        $msg = "Form submitted too quickly. Please try again.";
        if ($is_ajax) { echo json_encode(['status' => 'error', 'message' => $msg]); exit; }
        else { $_SESSION["message"]=false; header("Location: index.php?status=error"); exit; }
    }
    
    $honeypot = $_POST['firstname'] ?? '';
    if(!empty($honeypot)){
         if ($is_ajax) { echo json_encode(['status' => 'error', 'message' => "Bot detected."]); exit; }
         else { exit; }
    }

    $errors = [];
    $name = isset($_REQUEST['name']) ? htmlspecialchars(trim($_REQUEST['name'])) : '';
    $phone = isset($_REQUEST['phone']) ? htmlspecialchars(trim($_REQUEST['phone'])) : '';
    $email = isset($_REQUEST['email']) ? htmlspecialchars(trim($_REQUEST['email'])) : '';
    $service = isset($_REQUEST['service']) ? htmlspecialchars(trim($_REQUEST['service'])) : '';
    $requirements = isset($_REQUEST['requirements']) && !empty(trim($_REQUEST['requirements'])) ? htmlspecialchars(trim($_REQUEST['requirements'])) : 'None provided';

    if (empty($name)) { $errors[] = "Name is required."; }
    if (empty($phone)) { $errors[] = "Phone number is required."; }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) { $errors[] = "Valid email is required."; }
    if (empty($service)) { $errors[] = "Service is required."; }

    if (empty($errors)) {
        
        $details_html = "
            <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>Name:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$name}</td></tr>
            <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>Phone:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$phone}</td></tr>
            <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>Email:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$email}</td></tr>
            <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>Service Required:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$service}</td></tr>
            <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;' valign='top'><strong>Requirements:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>" . nl2br($requirements) . "</td></tr>
        ";

        $subject = 'New Booking Request from ' . $name;
        $title = 'Booking Request Received';
        $subtitle = 'Dear <strong>' . $name . '</strong>,<br>Thank you for requesting a booking with Blessing Furniture. Here are the details you submitted:';

        // Send using centralized premium mailer
        $status = send_premium_mail($email, $name, $subject, $title, $subtitle, $details_html, false);

        if($status){
            if ($is_ajax) {
                echo json_encode(['status' => 'success', 'message' => 'Your booking request has been sent successfully!']);
                exit;
            } else {
                $_SESSION["message"]=true;
                header("Location: success.php");
                exit;
            }
        } else{
            if ($is_ajax) {
                echo json_encode(['status' => 'error', 'message' => 'Mailer Error. Could not send.']);
                exit;
            } else {
                $_SESSION["message"]=false;
                header("Location: index.php?status=error");
                exit;
            }
        }
    } else {
        if ($is_ajax) {
            echo json_encode(['status' => 'error', 'message' => implode(' ', $errors)]);
            exit;
        } else {
            echo "<div style='font-family: sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; border: 1px solid #C89F56; border-radius: 8px; background-color: #FDF8F2;'>";
            echo "<h2 style='color: #3B2A1E; margin-top: 0;'>Booking Details Issue</h2>";
            echo "<p>Please review and fix the following issues:</p><ul>";
            foreach ($errors as $error) { echo "<li style='color:#CC6C5B; margin-bottom: 5px;'>$error</li>"; }
            echo "</ul>";
            echo "<a href='javascript:history.back()' style='display: inline-block; padding: 10px 20px; background-color: #3B2A1E; color: white; text-decoration: none; border-radius: 4px; margin-top: 10px;'>Go Back</a>";
            echo "</div>";
        }
    }
}
?>
