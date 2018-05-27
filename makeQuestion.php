<html>
<title>Writing question...</title>
<?php
session_start();
if ($_POST["qTitle"] != "" && $_POST["questionBody"] != "") {
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
$qTitle = $_POST["qTitle"];
$qBody = $_POST["questionBody"];
$url = $_POST["url"];
//error_reporting(E_ALL);
$sql = "INSERT INTO question_table (question_username, question_title, question_body, question_date, url)
VALUES ('". $_SESSION["user"] ."', '" . $qTitle . "', '" . $qBody ."', CURRENT_TIMESTAMP, '" . $url ."')";
$conn->query($sql);
$sql = "SELECT question_id from question_table where question_username = '". $_SESSION["user"] ."' AND question_title = '". $qTitle ."'";
//echo $sql;
$id = $conn->query($sql);
$row = $id->fetch_array(MYSQLI_NUM);
//echo $row[0];
$toAdd = 'liked'.$row[0];
//echo $toAdd;
//echo "ALTER TABLE users_table ADD ".$toAdd." tinyint( 1 ) default 0";
$sql = "ALTER TABLE users_table ADD ".$toAdd." tinyint( 1 ) default 0";
$conn->query($sql);

$_SESSION["wroteQuestion"] = "yes";
session_write_close();
header("Location: forumMain.php");
exit;
} else {
  $_SESSION["wroteQuestion"] = "no";
  session_write_close();
  header("Location: forumMain.php");
  exit;
}
 ?>
</html>
