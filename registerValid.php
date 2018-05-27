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
$hashed_pass = password_hash($password, PASSWORD_DEFAULT);
$query = $conn->prepare("SELECT password_hashed from users_table where username=?");
  $query->bind_param("s", $username);
   $query->execute();
   $query->store_result();
  $query->bind_result($password);
    $query->fetch();
  $num_of_rows = $query->num_rows;
   if($num_of_rows ==1)
   {
      $_SESSION["message"] = "Username is already taken!";
      $_SESSION["loggedIn"] = FALSE;
      session_write_close();
      header("Location: loginReg.php");
      exit;
   }
   else
   {
       $sql = "INSERT INTO users_table (username, password_hashed, isMod)
       VALUES ('".$_SESSION["user"]."', '".$hashed_pass."', '0')";
       if ($conn->query($sql) === TRUE) {
             $_SESSION["loggedIn"] = TRUE;
      session_write_close();
      header("Location: index.php");
      exit;
        } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
        }

   }
?>
</body>
</html>