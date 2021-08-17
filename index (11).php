<?php
require_once("models/db-settings.php"); //Require DB connection

//Retrieve settings
$stmt = $mysqli->prepare("SELECT id, name, value
	FROM ".$db_table_prefix."configuration");	
$stmt->execute();
$stmt->bind_result($id, $name, $value);

while ($stmt->fetch()){
	$settings[$name] = array('id' => $id, 'name' => $name, 'value' => $value);
}
$stmt->close();

//Set Settings
/*
$emailActivation = $settings['activation']['value'];
$mail_templates_dir = "models/mail-templates/";
$websiteName = $settings['website_name']['value'];
*/
$websiteUrl = $settings['website_url']['value'];

/*
$uri = $_SERVER['REQUEST_URI'];
 
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
 
$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
*/

/*
$websiteLive = 'https://iqonnect.co.za/';
$emailAddress = $settings['email']['value'];
$resend_activation_threshold = $settings['resend_activation_threshold']['value'];
$emailDate = date('dmy');
$language = $settings['language']['value'];
$template = $settings['template']['value'];
*/

/*
if($websiteUrl != $url)
{
	header('Location: '.$websiteUrl);
}
*/

include_once("models/header.php");
?>
<style>
html, body {
  height: 100%;
  width: 100%;
  overflow:hidden;
 
  background-image: url("pexels-artem-beliaikin-2433160.jpg");
  height: 100%;

  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

.blok1 {
  height: 100%;
  background-position: center 5%;
  background-repeat: no-repeat;
  background-size: cover; 	//SMART-31: BC
}

.innerDiv {
    position: absolute;
    left: 50%;
    top: 42.5%;
    text-align: center;
    width:50%;
    height:50%;
    margin-left: -25%; /*half width*/
    margin-top: 5%; /*half height*/
}
a {
  text-decoration: none;
  border: 3px solid #deb887;
  color: transparent;
  padding: 40px 80px;
  font-size: 28px;
  font-family: sans-serif;
  letter-spacing: 5px;
  transition: all 0.5s;
  position: relative;
}
a:before {
  content: "Login";
  display: flex;
  justify-content: center;
  align-items: center;
  color: #deb887;
  background: rgb(34, 34, 34);
  font-size: 28px;
  top: 0;
  left: 100%;
  font-family: sans-serif;
  letter-spacing: 5px;
  transition: all 1s;
  height: 100%;
  width: 100%;
  position: absolute;
  transform: scale(0) rotatey(0);
  opacity: 0;
}
a:hover:before {
  transform: scale(1) rotatey(360deg);
  left: 0;
  opacity: 1;
}
a:after {
  content: "Login";
  display: flex;
  justify-content: center;
  align-items: center;
  color: #deb887;
  background: rgb(34, 34, 34);
  font-size: 28px;
  top: 0;
  left: 0;
  font-family: sans-serif;
  letter-spacing: 5px;
  transition: all 1s;
  height: 100%;
  width: 100%;
  position: absolute;
  transform: scale(1) rotatey(0);
  opacity: 1;
}
a:hover:after {
  transform: scale(0) rotatey(360deg);
  left: -100%;
  opacity: 0;
}

</style>
	<div class="container-fluid blok1">
		<div class="innerDiv">
			<div class="hidden-xs">
				<a href="login.php"  role="button" value='Login'><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
				<!---<a href="forgot-password.php" class="btn-lg btn-light-red" role="button" value='Forgot'><i class="fa fa-envelope-open-o"></i> Forgot Password</a>--->
			</div>
			</div>
		</div>
    </div> <!-- /container -->