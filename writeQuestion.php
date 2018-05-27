<!Doctype html>
<html>
<head>
<title>Write question</title>
<style>#navbar {background-color: #bf80ff; color: white;}</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body bgcolor="#959CCE">
  <nav class="navbar navbar-light" id="navbar">
    <div class="container-fluid">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="loginReg.php">Login/Register</a></li>
        <li><a href="forumMain.php">Main page (login required)</a></li>
        <li class="active"><a href="writeQuestion.php">Write question</a></li>
        <li><a href="imageMain.php">Image page (login required)</a></li>
      </ul>
    </div>
  </nav>
  <form style="float:right;padding:15px" action="makeQuestion.php" method="post">
    <p>Type question title here:</p>
    <input style="width:600px;height:50px;padding:10px;" type="text" name="qTitle">
    <br><p>Type the body of your question here</p>
    <input style="width:600px;height:200px;padding:10px;" type="text" name="questionBody">
    <br><p>(Optional) Add a url here</p>
      <input style="width:600px;height:50px;padding:10px;" type="text" name="url">
      <input type="submit" value="submit">
  </form>
  <footer>
   <p>Made by Skyler Gunn</p>
  </footer>
</body>
</html>
