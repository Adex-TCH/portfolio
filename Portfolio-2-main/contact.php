<?php
// Configuration
$recipient_email = 'emmanueladesina713@gmail.com'; // Replace with your email address
$subject = 'Contact Form Submission';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  // Validate form data
  if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    $error = 'Please fill in all fields.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'Invalid email address.';
  } else {
    // Send email
    $headers = 'From: ' . $email . "\r\n" .
               'Reply-To: ' . $email . "\r\n" .
               'MIME-Version: 1.0' . "\r\n" .
               'Content-Type: text/html; charset=UTF-8';
    $body = '<p>Name: ' . $name . '</p>' .
             '<p>Email: ' . $email . '</p>' .
             '<p>Subject: ' . $subject . '</p>' .
             '<p>Message: ' . $message . '</p>';
    if (mail($recipient_email, $subject, $body, $headers)) {
      $success = 'Message sent successfully!';
    } else {
      $error = 'Error sending message. Please try again.';
    }
  }
}

// Display form
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <label for="name">Name:</label>
  <input type="text" id="name" name="name"><br><br>
  <label for="email">Email:</label>
  <input type="email" id="email" name="email"><br><br>
  <label for="subject">Subject:</label>
  <input type="text" id="subject" name="subject"><br><br>
  <label for="message">Message:</label>
  <textarea id="message" name="message"></textarea><br><br>
  <input type="submit" value="Send">
  <?php if (isset($error)) { echo '<p style="color: red;">' . $error . '</p>'; } ?>
  <?php if (isset($success)) { echo '<p style="color: green;">' . $success . '</p>'; } ?>
</form>