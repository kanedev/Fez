<?php
// check if fields passed are empty
require_once 'lib/swift_required.php';






if(empty($_POST['name']) ||
empty($_POST['email']) ||
empty($_POST['message'])	||
!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
{
echo "No arguments Provided!";
return false;
}


// Récup
$name = $_POST['name'];
$email_address = $_POST['email'];
$message_body = $_POST['message'];
// Récup
//$name = "lol";
//$email_address = "mazarine333@yahoo.fr";
//$message_body = "mon message";
//


 
 $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com',465, 'ssl')
  ->setUsername('kzadev@gmail.com')  
  ->setPassword('Casablanca1985') 
  ;
 
// Create the message
$message = Swift_Message::newInstance();
$message->setTo(array(
  "kanedev@live.fr" => "SUBJECT" 
));
$message->setSubject("Contact form submitted by : $name");
$message->setBody("You have received a new message. \n\n".
" Here are the details:\n \n Name: $name \n ".
"Email: $email_address\n Message \n $message_body");
$message->setFrom($email_address, $name);
 
// Send the email
$mailer = Swift_Mailer::newInstance($transport);
$mailer->send($message);


 
return true;	
