<!Doctype html>
<html>
<head>
<title>Edit response</title>
<style>  #navbar {background-color: #bf80ff; color: white;}</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-light" id="navbar">
    <div class="container-fluid">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="loginReg.php">Login/Register</a></li>
        <li class="active"><a href="forumMain.php">Main page (login required)</a></li>
        <li><a href="writeQuestion.php">Write question</a></li>
        <li><a href="imageMain.php">Image page (login required)</a></li>
      </ul>
    </div>
  </nav>
  <?php
  session_start();
  if ($_POST["responseID"] >= 1) {
    $_SESSION["responseID"] = $_POST["responseID"];
  }
  session_write_close();
   ?>
  <form style="float:right;padding:10px" action="makeResponse.php" method="post">
    <br><p>Edit the body of your response here</p>
    <input style="width:600px;height:200px;padding:10px;" type="text" name="newBody">
    <input type="submit" value="submit" name="edit">
    <input type="submit" value="delete" name="delete">
  </form>
  <footer>
   <p>Made by Skyler Gunn</p>
  </footer>
</body>
</html>
