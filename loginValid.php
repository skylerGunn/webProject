<!Doctype html>
<html>
<body>
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
$username = $_SESSION["user"];
$password = $_SESSION["pwd"];
$query = $conn->prepare("SELECT password_hashed from users_table where username=?");
  $query->bind_param("s", $username);
   $query->execute();
   $query->store_result();
  $query->bind_result($password);
    $query->fetch();
  $num_of_rows = $query->num_rows;
   if(password_verify($_SESSION["pwd"], $password))
   {
      echo "found 1 row"; //login worked, redirect to main
      $_SESSION["loggedIn"] = TRUE;
      session_write_close();
      header("Location: index.php");
      exit;
   }
   else
   {
       echo '<script>alert("incorrect login info");</script>';
       $_SESSION["message"] = "Incorrect login info<br />";
       $_SESSION["loggedIn"] = FALSE;
      session_write_close();
      header("Location: loginReg.php");
      exit;
   }
session_write_close();
?>
</body>
</html>
