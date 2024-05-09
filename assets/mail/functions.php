<?php


use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/autoload.php';

$emailformat = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
$txtEmail = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SetLanguage('en');
$mail->SMTPDebug = 0;
$mail->Host = 'smtp.googlemail.com';
$mail->Username = 'enviro2connect@gmail.com';
$mail->Password = 'valdbjbsmsjtpjhb';
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->SMTPKeepAlive = true;
$mail->setFrom('enviro2connect@gmail.com', 'Envirocare');
$mail->CharSet = 'utf-8';

$mail->addAddress('envirocare4you@gmail.com', '');

if ($_POST["btn"] == 'mail') {
	if (empty($_POST["fullname"])) {

		echo json_encode(array("class_name" => 'fullname', "error" => "Please enter Name"));
		exit;
	} elseif (empty($_POST["email"])) {

		echo json_encode(array("class_name" => 'email', "error" => "Please enter Email Id"));
		exit;	
	} elseif (!preg_match($emailformat, $txtEmail) && !empty($txtEmail)) {

		echo json_encode(array("class_name" => 'email', "error" => "Please enter valid email id"));
		exit;
	} elseif (empty($_POST["phoneno"])) {

		echo json_encode(array("class_name" => 'phoneno', "error" => "Please enter Phone No."));
		exit;
	} elseif ((strlen($_POST["phoneno"]) < 10 || strlen($_POST["phoneno"]) > 10) && !empty($_POST["phoneno"])) {

		echo json_encode(array("class_name" => 'phoneno', "error" => "Phone number must be equal to 10 digit"));
		exit;
	} elseif (empty($_POST["subject"])) {

		echo json_encode(array("class_name" => 'subject', "error" => "Please enter subject"));
		exit;
	} elseif (empty($_POST["message"])) {

		echo json_encode(array("class_name" => 'message', "error" => "Please write your message"));
		exit;
	} else {


		$content = file_get_contents(dirname(__FILE__) . '/message.html');
		$content = str_replace('%fullname%', $_POST["fullname"], $content);
		$content = str_replace('%email%', $_POST["email"], $content);
		$content = str_replace('%phoneno%', $_POST["phoneno"], $content);
		$content = str_replace('%subject%', $_POST["subject"], $content);
		$content = str_replace('%message%', $_POST["message"], $content);

		$mail->Subject = 'Enviro Connect from Envirocare';
		$mail->msgHTML($content, __DIR__);

		if (!$mail->Send()) {
			echo json_encode(array("class_name" => 'success-message', "error" => 'Error while sending Email.: ' . $mail->ErrorInfo));
		} else {
			echo json_encode(array("class_name" => 'success-message', "msg" => 'Awesome start! Your green commitment is noted. Expect a response from us soon.!'));
		}
		$mail->clearAddresses();
		$mail->smtpClose();

		exit;
	}
}

if ($_POST["btn"] == 'donate') {
	
	

	if (empty($_POST["fullname"])) {

		echo json_encode(array("class_name" => 'fullname', "error" => "Please enter Name"));
		exit;
	} elseif (empty($_POST["email"])) {

		echo json_encode(array("class_name" => 'email', "error" => "Please enter Email Id"));
		exit;	
	} elseif (!preg_match($emailformat, $txtEmail) && !empty($txtEmail)) {

		echo json_encode(array("class_name" => 'email', "error" => "Please enter valid email id"));
		exit;
	} elseif (empty($_POST["phoneno"])) {

		echo json_encode(array("class_name" => 'phoneno', "error" => "Please enter Phone No."));
		exit;	
	} elseif ((strlen($_POST["phoneno"]) < 10 || strlen($_POST["phoneno"]) > 10) && !empty($_POST["phoneno"])) {

		echo json_encode(array("class_name" => 'phoneno', "error" => "Phone number must be equal to 10 digit"));
		exit;
	} elseif (empty($_POST["address"])) {

		echo json_encode(array("class_name" => 'address', "error" => "Please enter address"));
		exit;
	} elseif (empty($_POST["weight_kg"])) {

		echo json_encode(array("class_name" => 'weight_kg', "error" => "Please enter weight (approx in Kgs)"));
		exit;
	} else {

		$type_waste = @implode('<br/>', $_POST['type_waste']);
		

		$content = file_get_contents(dirname(__FILE__) . '/message_donate.html');
		$content = str_replace('%fullname%', $_POST["fullname"], $content);
		$content = str_replace('%email%', $_POST["email"], $content);
		$content = str_replace('%phoneno%', $_POST["phoneno"], $content);
		$content = str_replace('%address%', $_POST["address"], $content);
		$content = str_replace('%type_waste%', $type_waste, $content);
		$content = str_replace('%weight_kg%', $_POST["weight_kg"], $content);
		$content = str_replace('%donat_message%', $_POST["donat_message"], $content);

		$mail->Subject = 'Donate E-Waste from Envirocare';
		$mail->msgHTML($content, __DIR__);

		if (!$mail->Send()) {
			echo json_encode(array("class_name" => 'success-message', "error" => 'Error while sending Email.: ' . $mail->ErrorInfo));
		} else {
			echo json_encode(array("class_name" => 'success-message', "msg" => 'Awesome start! Your green commitment is noted. Expect a response from us soon.!'));
		}
		$mail->clearAddresses();
		$mail->smtpClose();

		exit;
	}
}
