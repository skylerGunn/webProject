<html>
<title>Writing response...</title>
</html>
<?php
session_start();
$user = $_SESSION["user"];
$responseBody = $_POST["responseBody"];//I could make a session var with if the posting worked or not
if ($responseBody == "")  {
  session_write_close();
  header("Location: viewQuestion.php");
  exit;
}
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
//$user = $_SESSION["user"];
$qID = $_SESSION["qID"];
$sql = "INSERT INTO response_table (question_id, responding_user, response_date, response_body)
VALUES ('". $qID ."', '" . $user . "', CURRENT_TIMESTAMP, '" . $responseBody ."')";
$conn->query($sql);
$_SESSION["writeResp"] = true;
session_write_close();
header("Location: viewQuestion.php");
exit;
/*if ($conn->query($sql) === TRUE) {
session_write_close();
header("Location: viewQuestion.php");
exit;
}
//it didn't work!

session_write_close();*/
?>