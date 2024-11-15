<?php
require_once 'Submission.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $message = $_POST['message'];
    $password = $_POST['password'];
    $file = $_FILES['file'];
    // Validate file type and size
    if ($file['size'] > 500000 || !in_array($file['type'], ['image/jpeg', 'image/jpg'])) {
        die("File should be JPEG and max 500KB.");
    }

    // Set the upload directory and ensure it exists
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    // Save the file
    $image_path = $upload_dir . basename($file["name"]);
    if (!move_uploaded_file($file["tmp_name"], $image_path)) {
        die("Failed to upload file.");
    }

    // Initialize database and submission
    $database = new Database();
    $db = $database->getConnection();

    $submission = new Submission($db);
    $submission->name = $name;
    $submission->email = $email;
    $submission->mobile = $mobile;
    $submission->message = $message;
    $submission->password = $password;
    $submission->image_path = $image_path;

    // Save submission and send email
    if ($submission->save()) {
        sendConfirmationEmail($email, $name, $image_path);
        echo "Submission successful!";
        header("Location: view_submissions.php");
    } else {
        echo "Unable to save submission.";
    }
}




// function sendConfirmationEmail($to, $name, $file_path) {
//     $subject = "Form Submission Received";
//     $message = "Hello $name,\n\nWe have received your submission. Thank you for reaching out!\n\nBest regards,\nSupport Team Abdul Qadir";

//     $headers = "From: abdulqadir4344@gmail.com.com\r\n";
//     $headers .= "MIME-Version: 1.0\r\n";
//     $boundary = md5(time()); // unique boundary string
//     $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

//     // Compose email body with attachment
//     $body = "--$boundary\r\n";
//     $body .= "Content-Type: text/plain; charset=UTF-8\r\n\r\n";
//     $body .= "$message\r\n";
//     $body .= "--$boundary\r\n";
//     $body .= "Content-Type: image/jpeg; name=\"" . basename($file_path) . "\"\r\n";
//     $body .= "Content-Disposition: attachment; filename=\"" . basename($file_path) . "\"\r\n";
//     $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
//     $body .= chunk_split(base64_encode(file_get_contents($file_path))) . "\r\n";
//     $body .= "--$boundary--";

//     if (!mail($to, $subject, $body, $headers)) {
//         echo "Failed to send confirmation email.";
//     }
// }



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendConfirmationEmail($to, $name, $file_path) {
    require 'vendor/autoload.php'; // Ensure PHPMailer is loaded

    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'abdulqadir4344@gmail.com';
        $mail->Password = 'cmbrmzezvzhpeahb'; // Use your app password
        $mail->SMTPSecure = 'tls'; // or PHPMailer::ENCRYPTION_SMTPS
        $mail->Port = 587; // Use 465 for SSL, 587 for TLS

        // Email content
        $mail->setFrom('abdulqadir4344@gmail.com', 'Support Team Abdul Qadir');
        $mail->addAddress($to);

        $mail->Subject = "Form Submission Received";
        $mail->Body = "Hello $name,\n\nWe have received your submission. Thank you for reaching out!\n\nBest regards,\nSupport Team Abdul Qadir";

        // Attachment
        if (!empty($file_path) && file_exists($file_path)) {
            $mail->addAttachment($file_path);
        }

        // Send the email
        $mail->send();
        echo "Confirmation email sent successfully.";
    } catch (Exception $e) {
        echo "Failed to send confirmation email. Error: {$mail->ErrorInfo}";
    }
}



?>
