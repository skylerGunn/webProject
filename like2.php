<?php
//echo json_encode( array( "name"=>"John","time"=>"2pm"
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//$user = $_SESSION["user"];
$likeID = $_GET["likeID"];
//$likeID = 31;
$idPost = "liked" . $likeID;
$servername = "sql303.epizy.com";
$username = "epiz_20659217";
$password = "ImNiN9fEgf";
$db = "epiz_20659217_demo2";
$conn = new mysqli($servername, $username, $password, $db);
$sql = "SELECT " . $idPost . " from users_table where username = '". $_SESSION["user"] ."'";
//echo $sql;
$result = $conn->query($sql);
$row = $result->fetch_array(MYSQLI_NUM);
//print_r($row);
if ($row[0] != 0) {
  echo "there was a problem";
  session_write_close();
} else {
  $sql = "UPDATE users_table SET " . $idPost ."= '1' where username = '" . $_SESSION["user"] . "'";
  //echo '<br>';
  //echo $sql;
  $conn->query($sql);
  $query = $conn->prepare("SELECT question_score FROM question_table where question_id=?");
  $query->bind_param("s", $likeID);
  $query->execute();
  $query->store_result();
  $query->bind_result($score);
   $query->fetch();
   $score++;
   $query->close();
   $query = $conn->prepare("UPDATE question_table SET question_score = ? where question_id = ?");
   $query->bind_param("ss", $score, $likeID);
   $query->execute();
   $query->close();
   echo "liked//" . $score;
   session_write_close();

}

 ?>
