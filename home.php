 <?php
include('config.php');
include('class/userClass.php');
$userClass = new userClass();
$userDetails=$userClass->userDetails($_SESSION['uid']);

if(isset($_POST['code']))
{
$code=$_POST['code'];
$secret=$userDetails->google_auth_code;
require_once 'googleLib/GoogleAuthenticator.php';
$ga = new GoogleAuthenticator();
$checkResult = $ga->verifyCode($secret, $code, 2);    // 2 = 2*30sec clock tolerance

if ($checkResult) 
{
$_SESSION['googleCode']=$code;


} 
else 
{
echo 'FAILED';
}

}


include('sesija.php');
$userDetails=$userClass->userDetails($session_uid);

?>
<!DOCTYPE html>
<html>
<head>
    <title>2 faktorska autentifikacija</title>
    <link rel="stylesheet" type="text/css" href="" charset="utf-8" />
</head>
<body>
	<div id="container">
<h1>Dobrodošli <?php echo $userDetails->name; ?> uspješno ste se prijavili</h1>
<a href="http://security.foi.hr/wiki/index.php/2_factor_authentication" target="_blank">Otvori 2FA na wiki</a> 
<h4><a href="<?php echo BASE_URL; ?>odjava.php">Odjavi se</a></h4>
</div>
</body>
</html>
