<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: index.html");
  exit;
}

$name    = htmlspecialchars(trim($_POST["name"]));
$email   = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
$message = htmlspecialchars(trim($_POST["message"]));

if (empty($name) || empty($email) || empty($message)) {
  die("Please fill in all fields.");
}

$to = "your-email@example.com"; // 🔴 CHANGE THIS
$subject = "New Booking Request – Josh KD Entertainment";

$headers  = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$body = "
New message from your website:

Name: $name
Email: $email

Message:
$message
";

if (mail($to, $subject, $body, $headers)) {
  echo "<h2>Thank you!</h2><p>Your message has been sent.</p>";
} else {
  echo "<h2>Error</h2><p>Message could not be sent.</p>";
}
?>
