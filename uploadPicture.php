<!Doctype html>
<html>
<head>
<title>Write question</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>#navbar {background-color: #bf80ff; color: white;}</style>

</head>
<body bgcolor="#959CCE">
  <nav class="navbar navbar-light" id="navbar">
    <div class="container-fluid">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="loginReg.php">Login/Register</a></li>
        <li class="active"><a href="forumMain.php">Main page (login required)</a></li>
        <li><a href="uploadPicture.php">Upload a picture!</a></li>
        <li><a href="imageMain.php">Image page (login required)</a></li>
      </ul>
    </div>
  </nav>
  <form style="float:right;padding:15px" action="doImage.php" method="post" enctype="multipart/form-data">
    <p>Type image title here:</p>
    <input style="width:600px;height:50px;padding:10px;" type="text" name="qTitle">
    <p>Select an imgur url of an image to be displayed here:</p>
    <input style="width:600px;height:50px;padding:10px;" type="text" name="qURL"><br>
      <input type="submit" value="submit">

  </form>
  <footer>
   <p>Made by Skyler Gunn</p>
  </footer>
</body>
</html>
