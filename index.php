<!DOCTYPE html>
<?php
include("config.php");
if(!empty($_SESSION['uid']))
{
header("Location:QRprovjera.php");
}

include('class/userClass.php');
$userClass = new userClass();

require_once 'googleLib/GoogleAuthenticator.php';
$ga = new GoogleAuthenticator();
$secret = $ga->createSecret();

if (!empty($_POST['loginSubmit'])) 
{
$korimemaiil=$_POST['usernameEmail'];
$password=$_POST['password'];
 if(strlen(trim($korimemaiil))>1 && strlen(trim($password))>1 )
   {
    $uid=$userClass->userLogin($korimemaiil,$password,$secret);
    if($uid)
    {
        $url=BASE_URL.'unosKoda.php';
        header("Location: $url");
    }
    else
    {
        $errorMsgLogin="Provjerite podatke koje ste unijeli!";
    }
   }
}
if (!empty($_POST['signupSubmit'])) 
{

	$korime=$_POST['usernameReg'];
	$email=$_POST['emailReg'];
	$password=$_POST['passwordReg'];
        $ime=$_POST['nameReg'];


            
    $uid=$userClass->userRegistration($korime,$password,$email,$ime,$secret);
    if($uid)
    {
    	$url=BASE_URL.'QRprovjera.php';
    	header("Location: $url");
    }
    else
    {
      $errorMsgReg="Korisničko ime ili email već postoje.";
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

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>


        <div id="signup">
            <h3>Registracija</h3>
                <form method="post" action="" name="signup">
                    <label>Ime</label>
                    <input type="text" name="nameReg" autocomplete="off" />
                    <label>Email</label>
                    <input type="text" name="emailReg" autocomplete="off" />
                    <label>Korisničko ime</label>
                    <input type="text" name="usernameReg" autocomplete="off" />
                    <label>Lozinka</label>
                    <input type="password" name="passwordReg" autocomplete="off"/>
     <!--   <div class="errorMsg"><?php echo $errorMsgReg; ?></div>  -->
                    <input type="submit" class="button" name="signupSubmit" value="Signup">
                </form>
        </div>
<div id="id01" class="modal">
  
  <form class="modal-content animate" action="" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="profile_picture.png" alt="Avatar"  height="200" width="50" class="avatar">
    </div>

    <div class="container">
      <label><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="usernameEmail" required>

      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
       <input type="submit" class="button" name="loginSubmit" value="Prijavi se"> 
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>
<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>