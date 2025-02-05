
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $position = $_POST["jobPosition"];

    $to = "kajasuresh522@gmail.com"; 
    $subject = "Job Application for $position";
    $message = "Name: $name\nEmail: $email\nPosition: $position";

    $headers = "From: $email";

    if (isset($_FILES["resume"]) && $_FILES["resume"]["error"] == 0) {
        $file_tmp = $_FILES["resume"]["tmp_name"];
        $file_name = $_FILES["resume"]["name"];
        move_uploaded_file($file_tmp, "uploads/" . $file_name);
        $message .= "\nResume: uploads/$file_name";
    }


    if (mail($to, $subject, $message, $headers)) {
        echo "Application sent successfully!";
    } else {
        echo "Error sending application.";
    }
}
?>

