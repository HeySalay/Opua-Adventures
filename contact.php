<?php
// Check if the form was actually submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // If the hidden honeypot field is filled out, it's a bot! Kill the script silently.
    if (!empty($_POST["website"])) {
        exit; 
    }   

    // 1. Grab the form data using the exact 'name' attributes from the HTML
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"]));
    $message = trim($_POST["message"]);

    // Check that necessary data was sent
    if (empty($name) || empty($phone) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please fill out all fields correctly.";
        exit;
    }

    // 2. Set up the email details
    $to = "info@opuaadventures.com"; 
    $subject = "New Contact Form Submission from $name";

    // 3. Build the email body
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Phone: $phone\n\n";
    $email_content .= "Message:\n$message\n";

    // 4. Build the email headers
    $headers = "From: info@opuaadventures.com\r\n"; 
    $headers .= "Reply-To: $email\r\n"; 

    // 5. Send the email!
    if (mail($to, $subject, $email_content, $headers)) {
        // Send them back to your homepage (or a custom thank you page)
        header("Location: index.html?status=success");
        exit;
    } else {
        echo "Oops! Something went wrong and we couldn't send your message.";
    }

} else {
    echo "There was a problem with your submission, please try again.";
}
?>