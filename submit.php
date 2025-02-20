<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $jobPosition = $_POST["jobPosition"];

    // Create an uploads directory if it doesn't exist
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Handle file upload
    $resumePath = $uploadDir . basename($_FILES["resume"]["name"]);
    if (move_uploaded_file($_FILES["resume"]["tmp_name"], $resumePath)) {
        $fileUploaded = true;
    } else {
        echo "<span style='color: red;'>Error uploading file.</span>";
        exit();
    }

    // Email details
    $to = "kajasuresh522@gmail.com";  // Change to your email
    $subject = "New Job Application from $name";
    $message = "Name: $name\nEmail: $email\nJob Position: $jobPosition";
    $headers = "From: $email";

    if (mail($to, $subject, $message, $headers)) {
        echo "<span style='color: green;'>Application submitted successfully! Check your email.</span>";
    } else {
        echo "<span style='color: red;'>Error sending email. Please try again.</span>";
    }
} else {
    echo "<span style='color: red;'>Invalid request.</span>";
}
?>