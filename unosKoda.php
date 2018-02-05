<?php
if(isset($_POST['code']))
{
include('config.php');
include('class/userClass.php');
$userClass = new userClass();
$userDetails=$userClass->userDetails($_SESSION['uid']);    

$code=$_POST['code'];
$secret=$userDetails->google_auth_code;
require_once 'googleLib/GoogleAuthenticator.php';
$ga = new GoogleAuthenticator();
$checkResult = $ga->verifyCode($secret, $code, 2);
if ($checkResult) 
{
    $_SESSION['googleCode']=$code;
    header("Location:home.php");

} 
else
{
    echo "Pogrešan unos";
}
}
?>


<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>

<h2>Dvo faktorska autentifikacija</h2>
<form method="post" action="">
<label>Unesite kod</label>
<input type="text" name="code" />
<input type="submit" class="button"/>
</form>


   



</body>
</html>