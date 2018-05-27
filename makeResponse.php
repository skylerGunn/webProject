<html>
<title>Editing response...</title>
<body>
  <?php
  session_start();
  if (!isset($_SESSION["isMod"])) {
    $_SESSION["isMod"] = false;
  }
  $responseID = $_SESSION["responseID"];
  $newBody = $_POST["newBody"];
  $ourUser = $_SESSION["user"];
  //now we verify that that user is the same as the respnose user or if the user is a mod
  $_SESSION["valid"] = true;
  $servername = "sql303.epizy.com";
  $username = "epiz_20659217";
  $password = "ImNiN9fEgf";
  $db = "epiz_20659217_demo2";
  $conn = new mysqli($servername, $username, $password, $db);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $query = $conn->prepare("SELECT responding_user FROM response_table where response_ID=?");
  $query->bind_param("s", $responseID);
  $query->execute();
  $query->store_result();
 $query->bind_result($user);
   $query->fetch();
   if ($query->num_rows == 1 && ($_SESSION["isMod"] == true || $user == $ourUser)){ //can now edit or delete
  if ($_POST["delete"] == "delete") {
    //begin deleting response
    $query->close();
    $query = $conn->prepare("DELETE FROM response_table WHERE response_ID=?");
    $query->bind_param("s", $responseID);
    $query->execute();
    //is that it? may need testing
    $_SESSION["editResp"] = "yes";
  } else if ($_POST["edit"] == "submit") {
    //edit response
    $query->close();
    $query = $conn->prepare("UPDATE response_table SET response_body = ? WHERE response_ID=?");
    $query->bind_param("ss", $newBody, $responseID);
    $query->execute();
    $_SESSION["editResp"] = "yes";
  }
} else {
  $_SESSION["editResp"] = "no";
}
session_write_close();
header("Location: viewQuestion.php");
exit;
?>
</body>
</html>
