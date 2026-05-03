<?php 
session_start();

// 1. FORCE THE SERVER TO SHOW ERRORS (Temporarily)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. CHECK IF PHPMAILER FILES ACTUALLY EXIST
if (!file_exists('PHPMailer/Exception.php')) {
    die("<h1>FATAL ERROR: I cannot find the PHPMailer folder!</h1><p>Check your file manager. Is the folder uploaded? Is it spelled exactly 'PHPMailer' with capital P, H, P, M?</p>");
}

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Contact Mail Functions
if(isset($_REQUEST['contactbutton'])){
	    
	    
	    
	        // Get the timestamp when the form was loaded
    $form_time = $_POST['form_time'];

    // Get the current timestamp
    $current_time = time();

    // Check if the form was submitted too quickly (less than 5 seconds)
    if ($current_time - $form_time < 5) {
        echo "Form submitted too quickly. Please try again.";
        exit; // Stop further processing
    }
       
       
       
        $honeypot = $_POST['firstname'];

//check if the honeypot field is filled out. If not, send a mail.
     
         if( ! empty( $honeypot ) ){
             echo "Your are Bot!";
             exit;
         }
         
      else{  

// Initialize an array to hold error messages
$errors = [];

// Sanitize the inputs and store them in variables
$name = isset($_REQUEST['name']) ? htmlspecialchars(trim($_REQUEST['name'])) : '';
$phone = isset($_REQUEST['phone']) ? htmlspecialchars(trim($_REQUEST['phone'])) : '';
$email = isset($_REQUEST['email']) ? htmlspecialchars(trim($_REQUEST['email'])) : '';
$services = isset($_REQUEST['services']) ? htmlspecialchars(trim($_REQUEST['services'])) : '';
$city = isset($_REQUEST['locatin']) ? htmlspecialchars(trim($_REQUEST['locatin'])) : '';
$date = isset($_REQUEST['evendate']) ? htmlspecialchars(trim($_REQUEST['evendate'])) : '';
$remarks = isset($_REQUEST['massage']) ? htmlspecialchars(trim($_REQUEST['massage'])) : '';

// Server-side validation

// 1. Name: Only alphabets and spaces allowed
if (empty($name)) {
    $errors[] = "Name is required.";
} elseif (!preg_match("/^[A-Za-z\s]+$/", $name)) {
    $errors[] = "Name can only contain alphabets and spaces.";
}

// 2. Phone: Only numbers, spaces, and '+' allowed (max 12 characters)
if (empty($phone)) {
    $errors[] = "Phone number is required.";
} elseif (!preg_match("/^[\d\s\+]{1,12}$/", $phone)) {
    $errors[] = "Phone number is invalid. Only numbers, spaces, and '+' are allowed (max 12 characters).";
}

// 3. Email: Must be a valid email format
if (empty($email)) {
    $errors[] = "Email is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}

// 4. Services: Optional, but you can add validation if needed
// Example: ensure not too long
if (!empty($services) && strlen($services) > 100) {
    $errors[] = "Services text is too long.";
}

// 5. City: Mandatory field
if (empty($city)) {
    $errors[] = "City is required.";
}

// 6. Message: Disallow URLs (only normal text allowed)
if (empty($remarks)) {
    $errors[] = "Message is required.";
} elseif (preg_match("/https?:\/\/|www\./", $remarks)) {
    $errors[] = "Message should not contain URLs.";
}


// 6. Date validation: only prevent past dates
if (!empty($date)) {
    $current_timestamp = time();
    $input_timestamp = strtotime($date); // convert user input to timestamp
    
    if ($input_timestamp < $current_timestamp) {
        $errors[] = "Event date cannot be in the past.";
    }
}

// If no errors, process the form
if (empty($errors)) {
   
					
			$booking_mail = '';
			$booking_mail .= '<span style="color:#009aff;display:block;margin-bottom:20px">Dear <b>'.$name.', </b></span>';
			$booking_mail .= '<span style="color:#646464;display:block;margin-bottom:20px">Thanks for Contacting us. Please check your details</span>';
			$booking_mail .= '<div style="padding:10px;border:1px solid #ddd;background:#f8f8f8;margin-bottom:20px">';
			$booking_mail .= '<h4 style="font-weight:500;color:#fff;background-color:#cb7a4f;margin:0px;padding:10px;font-size:15px;margin-bottom:15px">Enquiry Details</h4>';
			$booking_mail .= '<div style="font-size:14px;color:#646464">';
			$booking_mail .= '<span style="display:block;padding-top:10px;border-bottom:1px solid #ddd"><b>Name : </b><span>'.$name.'</span></span>';
            $booking_mail .= '<span style="display:block;padding-top:10px;border-bottom:1px solid #ddd"><b>Phone : </b><span>'.$phone.'</span></span>';
            $booking_mail .= '<span style="display:block;padding-top:10px;border-bottom:1px solid #ddd"><b>Email : </b><span>'.$email.'</span></span>';
            $booking_mail .= '<span style="display:block;padding-top:10px;border-bottom:1px solid #ddd"><b>Location : </b><span>'.$city.'</span></span>';
            $booking_mail .= '<span style="display:block;padding-top:10px;border-bottom:1px solid #ddd"><b>Services : </b><span>'.$services.'</span></span>';
            $booking_mail .= '<span style="display:block;padding-top:10px;border-bottom:1px solid #ddd"><b>Event Date : </b><span>'.$date.'</span></span>';
            $booking_mail .= '<span style="display:block;padding-top:10px;border-bottom:1px solid #ddd"><b>Message : </b><span>'.$remarks.'</span></span>';

			$booking_mail .= '<br>';
			$booking_mail .= '</div>';
			$booking_mail .= '</div>';
			$booking_mail .= '<div style="padding:10px;border:1px solid #f2f2f2;background:#f7f7f7;margin-bottom:10px">';
			$booking_mail .= '<span style="font-size:14px">Our team will contact you shortly</span><br>';;
			$booking_mail .= '</div>';
			$booking_mail .= '<span style="color:#009aff;display:block;margin-bottom:5px">Thanks,</span>';
			$booking_mail .= '<h3 style="color:#cb7a4f;padding:0px;margin:0px;margin-bottom:10px">Demo Company Name</h3>';
            $msg = '';
			$msg .= '<table style="border : 0px; border-spacing : 0px; width : 900px; \'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif" cellpadding="5"><tr><td style="width : 100%;border : 1px solid #FFA400;" colspan="3">';
			$msg .= '<table style="border : 0px; border-spacing : 0px; width : 100%;" cellpadding="5">';
			$msg .= '<tr>';
			$msg .= '<td style="width : 425px; border: 1px solid #DDD;border-right : 3px solid #DDD; Padding : 20px;background:#FDFDFD;" valign="top">';
			$msg .= '<h4 style="color:#009AFF;padding-bottom:5px;margin:0px;margin-bottom:10px;text-transform : uppercase;border-bottom:1px solid #DDD;font-size:15px;">Demo Company Name</h4>';
			$msg .= '<div style="padding-bottom : 5px; margin-bottom : 10px;">';
			$msg .= '<img style=" width :150px;" src="https://via.placeholder.com/150x50?text=Demo+Logo" style="width:250px" class="CToWUd">';
			$msg .= '</div>';
			$msg .= '<div style="padding:10px;border:1px solid #f2f2f2;background:#f7f7f7;margin-bottom:10px">';
			$msg .= '<span style="color:#009aff;display:block;margin-bottom:5px;font-size:14px"><b>ADDRESS &nbsp;: </b></span>';
			$msg .= '<span style="font-size:14px">123 Demo Street, Dummy Area,<br> Main Road, Demo District,<br> City Name - 000000</span><br>';
			$msg .= '</div>';
			$msg .= '<div style="padding:10px;border:1px solid #f2f2f2;background:#f7f7f7;margin-bottom:10px">';
			$msg .= '<span style="color:#009aff;display:block;margin-bottom:5px;font-size:14px"><b>CALL US &nbsp;: </b></span>';
			$msg .= '<span style="font-size:14px"><a style="color:#000;" href="tel:+1234567890">+1 23456 7890 </a></span>';
			$msg .= '</div>';
			$msg .= '<div style="padding:10px;border:1px solid #f2f2f2;background:#f7f7f7;margin-bottom:10px">';
			$msg .= '<span style="color:#009aff;display:block;margin-bottom:5px;font-size:14px"><b>EMAIL &nbsp;: </b></span>';
			$msg .= '<span style="font-size:14px"><a style="color:#000;" href="mailto:info@democompany.com" target="_blank">info@democompany.com</a> </span><br>';
			$msg .= '</div>';
			$msg .= '</td>';
			$msg .= '<td style="width : 425px; border: 1px solid #DDD;border-left:0px; Padding:20px;background:#FFF;" valign="top">';
			$msg .= $booking_mail;										
			$msg .= '</td>';										
			$msg .= '</tr>';
			$msg .= '</table>';
			$msg .= '</td></tr></table>';
			$subject='Demo Company Contact details from '.$name;	
			
        //   echo($msg);
        //       exit;
             

			   
			   
			
$mail = new PHPMailer(true);


try {
    $mail->CharSet = 'UTF-8';
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
   $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'v06139343@gmail.com';                     //SMTP username
    $mail->Password   = 'vowtssylzigbnhgo';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('v06139343@gmail.com','Demo Company');
   

    $mail->addBCC('sivaprakashpm02@gmail.com');
    $mail->addBCC('jhonthewicked0314@gmail.com');
 
   
     $mail->addAddress($email);
     
     
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
      $mail->Body = $msg;  
   

    $status = $mail->send();
   
    // var_dump($status);
    // exit;
   
   if($status){
    $_SESSION["message"]=true;
    header("Location:contact.php");
}
else{
    $_SESSION["message"]=false;
    header("Location:contact.php");
}
   
   
}

 catch (Exception $e) {
     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
   
}


} else {
        // Display validation errors
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }

		}
	    
	}
?>