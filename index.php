<!DOCTYPE html>
<html lang="en">
<head>
  <style>
  #navbar {background-color: #bf80ff; color: white;}
  </style>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body bgcolor="#959CCE">

  <nav class="navbar navbar-light" id="navbar">
    <div class="container-fluid">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="loginReg.php">Login/Register</a></li>
        <li><a href="forumMain.php">Main page (login required)</a></li>
        <li><a href="imageMain.php">Image page (login required)</a></li>
      </ul>
    </div>
  </nav>

<div class="container">
<h1>Home page</h1>
<br>
<?php
session_start();
//unset($_SESSION["loggedIn"]);
if (isset($_SESSION["loggedIn"]) != TRUE) {
    $_SESSION["loggedIn"] = FALSE;
}
if ($_SESSION["loggedIn"] == FALSE) {
echo '<a href="loginReg.php">Login here!</a>';
if (isset($_SESSION["message"])){
  echo '<p>'. $_SESSION["message"] .'</p>';
}
}
if ($_SESSION["loggedIn"] == TRUE) {
    echo "logged in as " . $_SESSION["user"];
    echo $_SESSION["message"];
    echo '<a href="forumMain.php"><br />Continue to site</a>';
}
session_write_close();
?>
</div>
<iframe width="854" height="480" src="https://www.youtube.com/embed/JcjYTpv9gqM" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
<footer>
 <p>Made by Skyler Gunn</p>
</footer>
</body>
</html>
