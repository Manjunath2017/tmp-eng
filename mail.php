<?php
session_start();

$_SESSION['Feedback']=1;

$Fname=$_POST['Fname'];
$Email=$_POST['Email'];
$Contact=$_POST['Contact'];
$Query=$_POST['Query'];
$Sub="Feedback/Enquery";



//script written by pavan Bandodekar

// checks the syntax of the emailaddress
function check_email($emaildddress)
{
	$goodchars = '^[A-Za-z0-9\._-]+@([A-Za-z][A-Za-z0-9-]{1,62})(\.[A-Za-z][A-Za-z0-9-]{1,62})+$';

	$isvalid = true;
	if(!ereg($goodchars,$emaildddress))
	{
		$isvalid = false;
	}
	return $isvalid;
}

// sends the HTML email
function html_email($recipient,$subject,$message,$from,$replyto)
{
	$array = array("\'" => "'");
	$message = strtr($message, $array);
	$message = '<html><body>'.$message.'</body></html>'."\r\n\r\n";
	$extra = 'From: '.$from.' <'.$replyto.'>'."\r\n";
	$extra .= 'Content-Type: text/html; charset="ISO-8859-1"'."\r\n";
	$extra .= 'Content-Transfer-Encoding: quoted-printable'."\n\r\n";
	mail($recipient, $subject, $message, $extra);
}
// use like this
// specify the address the mail will be sent from
$mail_sender = $Email;
// specify the name of the sender
$mail_sender_name = $Fname;
// specify the recipient email address
$mail_recipient = 'info@tmpengg.in';
// specify the subject of the email (no HTML here!)
$mail_subject = $Sub;
// the body of the email - you can use HTML here
$mail_body = $Query."<br /><br />Thanks & Regards<br />".$Contact;


// if email addresses are valid
if(check_email($mail_recipient) && check_email($mail_sender))
{
	// send HTML mail with PHP
	html_email($mail_recipient,$mail_subject,$mail_body,$mail_sender_name,$mail_sender);
}

header('Location:index.php');

?>
