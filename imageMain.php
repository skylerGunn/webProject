<!Doctype html>
<html>
<head>
  <title>Image page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="jquery.min.js"></script>
  <style> div.userLog {
    position: relative;
    left: 1000px;
    top: 0px;
    border: 3px solid blue;
    height:50px;
    width:400px;
  }
  #navbar {background-color: #bf80ff; color: white;}
  </style>
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
  <div class="userLog">
  <?php
  session_start();
  if ($_SESSION["loggedIn"] == FALSE) {
    session_write_close();
    header("Location: http://ourheaven.epizy.com/index.php");
    exit;
  }
    if (!isset($_SESSION["wroteQuestion"])) {
      $_SESSION["wroteQuestion"] = "notYet";
    }
    if (!isset($_SESSION["validURL"])) {
      $_SESSION["validURL"] = true;
    } else if ($_SESSION["validURL"] == false) {
    }
    if ($_SESSION["wroteQuestion"] == "no") {
      echo '<script>alert("Failed to write new question!");</script>';
      $_SESSION["wroteQuestion"] = "notYet";
    }
     echo '<p style="white-space:nowrap;">Logged in as ' . $_SESSION["user"] . '</p>';//Will later need to change the <p> tag to be a link where they can edit their password perhaps
     if (!isset($_SESSION["validURL"])) {
       $_SESSION["validURL"] = true;
     } else if ($_SESSION["validURL"] == false) {
       echo "<br>";
       echo '<p style="white-space:nowrap;">Invalid image URL</p>';
       $_SESSION["validURL"] = true;
     }
   session_write_close();//Work in progress, will put out the username if the session is started
  ?>
  </div>
<a href="loginReg.php">Logout</a>
<a href="uploadPicture.php">Click here to upload an image</a>
  <?php
  session_start();
  $servername = "sql303.epizy.com";
  $username = "epiz_20659217";
  $password = "ImNiN9fEgf";
  $db = "epiz_20659217_demo2";
  class question { //class for storing sql data from the questions table
    public $id;
    public $usrName;
    public $title;
    public $image;
    //may include score, date and other stuff at a later date
  }
  $conn = new mysqli($servername, $username, $password, $db);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  $query = $conn->prepare("SELECT count(image_id) from image_table");
  $query->execute();
  $query->store_result();
  $query->bind_result($count);
  $query->fetch();
  $query->close();
  if ($count <= 0) {
    echo "something went wrong somewhere";
  } else {
    $questions = new question();
    $query = $conn->prepare("SELECT image_id, image_user, image_title, image FROM image_table");
    $query->execute();
    $query->store_result();
    $query->bind_result($questions->id, $questions->usrName, $questions->title, $questions->image);
  for ($i = 0; $i < $count; $i++) { //Load in questions object and make question html
    $query->fetch();
    echo '<div style="position: relative; height:500px; width:800px; top: ' . ($i * 100) . 'px;border: 3px solid red; ">';
    echo '<p style="white-space:nowrap;">Question ID: ' . $questions->id . '    Username: ' . $questions->usrName . '</p>';
//echo '<button onclick="like('.$questions->id .')">Like</button>'; //calls like script with qID
    echo '<p style="white-space:nowrap;">Title: ' . $questions->title . '</p>';
    echo '<image style="height:400px;width:400px;white-space:nowrap;" src = "'.$questions->image . '" alt="whoops"></div>';



  }
  //may need $conn->close here

}
  session_write_close();
  ?>
</body>
</html>
