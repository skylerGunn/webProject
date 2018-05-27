<!DOCTYPE html>
<html>
<head>
  <title>Checking stuff...</title>
</head>
<body>
<?php
session_start();
if ($_POST["logout"] == "logout") {
  $_SESSION["loggedIn"] = FALSE;
  echo '<a href="loginReg.php">login here!</a>';
}
if ($_POST["login"] == "login") {
//login
$_SESSION["user"] = $_POST["user"];
$_SESSION["pwd"] = $_POST["pwd"];
session_write_close();
header('Location: http://ourheaven.epizy.com/loginValid.php');
exit;
} else if ($_POST["register"] == "reg") {
//register
$_SESSION["user"] = $_POST["user"];
$_SESSION["pwd"] = $_POST["pwd"];
session_write_close();
header('Location: http://ourheaven.epizy.com/registerValid.php');
exit;
} else {
session_write_close();
header('Location: http://ourheaven.epizy.com');
exit;
}
?>
</body>
</html>
