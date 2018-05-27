<html>
<title>Uploading...</title>
<?php
session_start();
$servername = "sql303.epizy.com";
$username = "epiz_20659217";
$password = "ImNiN9fEgf";
$db = "epiz_20659217_demo2";
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully \n";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$urlTest = explode("https://i.imgur.com/", $_POST["qURL"]);
if ($urlTest[0] == $_POST["qURL"]) {//if url doesn't contain imgur prefix string
  $_SESSION["validURL"] = false;
  session_write_close();
  header("Location: http://ourheaven.epizy.com/imageMain.php");
}
$imageText = mysqli_real_escape_string($conn, $_POST['qTitle']);
$sql = "INSERT INTO image_table (image_user, image_title, image)
VALUES ('". $_SESSION["user"] ."', '" . $imageText . "', '" . $_POST["qURL"] . "')";
echo $sql;
$conn->query($sql);
session_write_close();
header("Location: http://ourheaven.epizy.com/imageMain.php");
 ?>
</html>
