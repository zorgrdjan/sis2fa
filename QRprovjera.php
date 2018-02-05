<?php
include('config.php');
if(empty($_SESSION['uid']))
{
	header("Location: index.php");
}

include('class/userClass.php');
$userClass = new userClass();
$userDetails=$userClass->userDetails($_SESSION['uid']);
$secret=$userDetails->google_auth_code;
$email=$userDetails->email;

require_once 'googleLib/GoogleAuthenticator.php';

$ga = new GoogleAuthenticator();

$qrCodeUrl = $ga->getQRCodeGoogleUrl($email, $secret,'Sis projekt');

?>
<!DOCTYPE html>
<html>
<head>
    <title>Dvo faktorska autentifikacija</title>
    <link rel="stylesheet" type="text/css" href="" charset="utf-8" />
</head>
<body>
	<div id="container">
		<h1>Dvo faktorska autentifikacija</h1>
		<div id='device'>

<p>Generirani qr kod.</p>
<div id="img">
<img src='<?php echo $qrCodeUrl; ?>' />
</div>

<form method="post" action="home.php">
<label>Unesite kod:</label>
<input type="text" name="code" />
<input type="submit" class="button"/>
</form>

</body>
</html>