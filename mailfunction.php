<?php 
 session_start();
 
 require_once __DIR__ . '/includes/send_premium_mail.php';

// Contact Mail Functions
if(isset($_REQUEST['submit_contact'])){
    $form_time = $_POST['form_time'] ?? 0;
    $current_time = time();
    if ($current_time - $form_time < 2) {
        echo "Form submitted too quickly. Please try again.";
        exit; 
    }
    
    $honeypot = $_POST['firstname'] ?? '';
    if(!empty($honeypot)){
         echo "You are a Bot!";
         exit;
    }

    $errors = [];
    $name = isset($_REQUEST['name']) ? htmlspecialchars(trim($_REQUEST['name'])) : '';
    $phone = isset($_REQUEST['phone']) ? htmlspecialchars(trim($_REQUEST['phone'])) : '';
    $email = isset($_REQUEST['email']) ? htmlspecialchars(trim($_REQUEST['email'])) : '';
    $service = isset($_REQUEST['service']) ? htmlspecialchars(trim($_REQUEST['service'])) : '';
    $requirements = isset($_REQUEST['requirements']) ? htmlspecialchars(trim($_REQUEST['requirements'])) : '';

    if (empty($name)) { $errors[] = "Name is required."; }
    if (empty($phone)) { $errors[] = "Phone number is required."; }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) { $errors[] = "Valid email is required."; }
    if (empty($service)) { $errors[] = "Service is required."; }
    if (empty($requirements)) { $errors[] = "Requirements are required."; }

    if (empty($errors)) {
        
        $details_html = "
            <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>Name:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$name}</td></tr>
            <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>Phone:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$phone}</td></tr>
            <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>Email:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$email}</td></tr>
            <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>Service Interest:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$service}</td></tr>
            <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;' valign='top'><strong>Requirements:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>" . nl2br($requirements) . "</td></tr>
        ";

        $subject = 'Furniture Inquiry from ' . $name;
        $title = 'Thank You for Contacting Us';
        $subtitle = 'Dear <strong>' . $name . '</strong>,<br>We have received your custom furniture inquiry. Here are the details you submitted:';

        // Send using centralized premium mailer
        $status = send_premium_mail($email, $name, $subject, $title, $subtitle, $details_html, false);

        if($status){
            $_SESSION["message"]=true;
            header("Location: success.php");
            exit;
        } else{
            $_SESSION["message"]=false;
            header("Location: contact-blessing-furniture-coimbatore.php?status=error");
            exit;
        }
    } else {
        echo "<div style='font-family: sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; border: 1px solid #C89F56; border-radius: 8px; background-color: #FDF8F2;'>";
        echo "<h2 style='color: #3B2A1E; margin-top: 0;'>Inquiry Details Issue</h2>";
        echo "<p>Please review and fix the following issues:</p><ul>";
        foreach ($errors as $error) { echo "<li style='color:#CC6C5B; margin-bottom: 5px;'>$error</li>"; }
        echo "</ul>";
        echo "<a href='javascript:history.back()' style='display: inline-block; padding: 10px 20px; background-color: #3B2A1E; color: white; text-decoration: none; border-radius: 4px; margin-top: 10px;'>Go Back</a>";
        echo "</div>";
    }
}

// Second Form Handler (Looks like a car booking form copy-pasted, preserving functionality)
if(isset($_REQUEST['contactbutton'])){
    
    $form_time = $_POST['form_time'] ?? 0;
    $current_time = time();

    if ($current_time - $form_time < 5) {
        echo "Form submitted too quickly. Please try again.";
        exit;
    }
   
    $honeypot = $_POST['firstname'] ?? '';

    if(!empty($honeypot)){
         echo "You are a Bot!";
         exit;
    } else {  

        $errors = [];
        $name = isset($_REQUEST['name']) ? htmlspecialchars(trim($_REQUEST['name'])) : '';
        $phone = isset($_REQUEST['phone']) ? htmlspecialchars(trim($_REQUEST['phone'])) : '';
        $email = isset($_REQUEST['email']) ? htmlspecialchars(trim($_REQUEST['email'])) : '';
        $carCategory = isset($_REQUEST['carCategory']) ? htmlspecialchars(trim($_REQUEST['carCategory'])) : '';
        $carModel = isset($_REQUEST['selectedCarName']) ? htmlspecialchars(trim($_REQUEST['selectedCarName'])) : (isset($_REQUEST['carModel']) ? htmlspecialchars(trim($_REQUEST['carModel'])) : '');
        $startDate = isset($_REQUEST['startDate']) ? htmlspecialchars(trim($_REQUEST['startDate'])) : '';
        $endDate = isset($_REQUEST['endDate']) ? htmlspecialchars(trim($_REQUEST['endDate'])) : '';
        $totalRate = isset($_REQUEST['totalRate']) ? htmlspecialchars(trim($_REQUEST['totalRate'])) : '';

        // Validation
        if (empty($name)) { $errors[] = "Name is required."; } 
        elseif (!preg_match("/^[A-Za-z\s]+$/", $name)) { $errors[] = "Name can only contain alphabets and spaces."; }

        if (empty($phone)) { $errors[] = "Phone number is required."; } 
        elseif (!preg_match("/^[\d\s\+]{1,12}$/", $phone)) { $errors[] = "Phone number is invalid. Only numbers, spaces, and '+' are allowed (max 12 characters)."; }

        if (empty($email)) { $errors[] = "Email is required."; } 
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $errors[] = "Invalid email format."; }

        if (!empty($carCategory) && strlen($carCategory) > 100) { $errors[] = "Car Category text is too long."; }
        if (empty($carModel)) { $errors[] = "Car Model is required."; }

        if (empty($totalRate)) { $errors[] = "Total Rate is required."; } 
        elseif (preg_match("/https?:\/\/|www\./", $totalRate)) { $errors[] = "Total Rate should not contain URLs."; }

        if (!empty($startDate)) {
            if (strtotime($startDate) < strtotime('today')) { $errors[] = "Start date cannot be in the past."; }
        }

        if (!empty($endDate)) {
            if (strtotime($endDate) < strtotime('today')) { $errors[] = "End date cannot be in the past."; }
        }

        if (empty($errors)) {
        
            require_once 'db_config.php';
            if (isset($db_connected) && $db_connected) {
                try {
                    $stmt = $pdo->prepare("INSERT INTO bookings (name, phone, email, car_category, car_model, start_date, end_date, total_rate, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Pending')");
                    $stmt->execute([$name, $phone, $email, $carCategory, $carModel, $startDate, $endDate, $totalRate]);
                } catch (PDOException $e) { }
            }
                            
            $details_html = "
                <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>Name:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$name}</td></tr>
                <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>Phone:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$phone}</td></tr>
                <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>Email:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$email}</td></tr>
                <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>Car Category:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$carCategory}</td></tr>
                <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>Car Model:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$carModel}</td></tr>
                <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>Start Date:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$startDate}</td></tr>
                <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>End Date:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$endDate}</td></tr>
                <tr><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE; color: #666;'><strong>Total Estimated Rate:</strong></td><td style='padding: 8px 0; border-bottom: 1px solid #E8DDCE;'>{$totalRate}</td></tr>
            ";

            $subject = 'Booking Details from ' . $name;
            $title = 'Booking Confirmation Details';
            $subtitle = 'Dear <strong>' . $name . '</strong>,<br>Thank you for your booking. Please review your details below:';
            
            $status = send_premium_mail($email, $name, $subject, $title, $subtitle, $details_html, false);
        
            if($status){
                $_SESSION["message"]=true;
                header("Location: success.php");
                exit;
            } else{
                $_SESSION["message"]=false;
                header("Location: index.php?status=error");
                exit;
            }
        
        } else {
            echo "<div style='font-family: sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; border: 1px solid #bf0435; border-radius: 8px; background-color: #fffafb;'>";
            echo "<h2 style='color: #bf0435; margin-top: 0;'>Booking Issue</h2>";
            echo "<p>Please review and fix the following issues:</p><ul>";
            foreach ($errors as $error) {
                echo "<li style='color:red; margin-bottom: 5px;'>$error</li>";
            }
            echo "</ul>";
            echo "<a href='javascript:history.back()' style='display: inline-block; padding: 10px 20px; background-color: #bf0435; color: white; text-decoration: none; border-radius: 4px; margin-top: 10px;'>Go Back</a>";
            echo "</div>";
        }
    }
}
?>