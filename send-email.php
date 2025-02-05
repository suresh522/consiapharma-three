

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require 'vendor/autoload.php'; // If using Composer
// require 'path/to/PHPMailer/src/PHPMailer.php'; // If manually downloaded

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $position = $_POST["jobPosition"];
    
    $mail = new PHPMailer(true); // Enable exceptions

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // SMTP server (e.g., smtp.gmail.com)
        $mail->SMTPAuth   = true;
        $mail->Username   = 'kajasuresh522@gmail.com'; // Your SMTP email
        $mail->Password   = 'Lazaru@522'; // Your SMTP password (Use App Password if using Gmail)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS
        $mail->Port       = 587; // TLS port (Use 465 for SSL)

        // Email Headers
        $mail->setFrom($email, $name);
        $mail->addAddress('kajasuresh522@gmail.com'); // HR email
        $mail->Subject = "Job Application for $position";
        $mail->Body    = "Name: $name\nEmail: $email\nPosition: $position";

        // Handle file upload
        if (isset($_FILES["resume"]) && $_FILES["resume"]["error"] == 0) {
            $file_tmp = $_FILES["resume"]["tmp_name"];
            $file_name = $_FILES["resume"]["name"];
            move_uploaded_file($file_tmp, "uploads/" . $file_name);
            $mail->addAttachment("uploads/" . $file_name);
        }

        // Send Email
        if ($mail->send()) {
            echo "Application sent successfully!";
        } else {
            echo "Error sending application.";
        }

    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>