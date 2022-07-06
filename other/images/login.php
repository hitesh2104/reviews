<?php
session_start();
require_once 'includes/login.php';
$login = new Login();

// If the user clicks the "Log Out" link on the index page.
if(isset($_GET['status']) && $_GET['status'] == 'loggedout') {
	$login->log_User_Out();
}

// Did the user enter a password/username and click submit?
if($_POST && !empty($_POST['username']) && !empty($_POST['pwd'])) {
	$response = $login->validate_User($_POST['username'], $_POST['pwd']);
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login - Assessment House</title>
<link href="styles2.css" rel="stylesheet" type="text/css" />
</head>

<body class="login_body">
<div class="login_logo text-center"><img src="images/logo.png" /></div>
<form action="login.php" class="login_form" method="post">
	<?php if(isset($response)) echo '<div class="login_error">' . $response . "</div>"; ?>
	</div>
	<label>Email Address</label>
	<input type="text" class="field" id="username" name="username" value="<?php if(isset($_POST['username'])){ echo $_POST['username'];} ?>" />
	<label>Password</label>
	<input type="password" class="field" name="pwd" />
	<input type="submit" class="btn_color login_btn" value="Login" />
</form>
<div class="login_bottom_text"> <a href="forgot_password.php">Forgot your password?</a> </div>
</body>
</html>