<?php
$receiving_email_address = 'akankshaslksingh@gmail.com';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
        include($php_email_form);
    } else {
        die('Unable to load the "PHP Email Form" Library!');
    }

    $contact = new PHP_Email_Form;
    $contact->ajax = true;

    $contact->to = $receiving_email_address;
    $contact->from_name = $_POST['name'];
    $contact->from_email = $_POST['email'];
    $contact->subject = $_POST['subject'];

    // Uncomment and configure SMTP settings if needed
    /*
    $contact->smtp = array(
      'host' => 'your.smtp.host',
      'username' => 'your_smtp_username',
      'password' => 'your_smtp_password',
      'port' => '587'
    );
    */

    $contact->add_message($_POST['name'], 'From');
    $contact->add_message($_POST['email'], 'Email');
    $contact->add_message($_POST['message'], 'Message', 10);

    echo $contact->send();
} else {
    // Handle incorrect request method, e.g., by sending a 405 header or a specific message
    header('HTTP/1.1 405 Method Not Allowed');
    echo 'Method Not Allowed';
}
?>

