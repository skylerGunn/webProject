<!Doctype html>
<html>
<head>
  <title>Main Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
  function like(likeID) {
    $.get("like2.php", { likeID: likeID}).done(function(data){
        //data.likeNum for number of likes and data.Message to output Message
        //var temp = $.parseJSON(data);
        //alert(JSON.stringify(data));
        var grand = data.split("//");
        if (grand[0] == "liked") {
        $("#" + likeID).html("Likes: " + grand[1]);//print out message using jquery UI later
        alert(grand[0]);
      } else {
          alert("you've already liked this question");
        }
    }).fail(function() {
    alert( "error" );
  });
    $( document ).ajaxError(function() {
  $( ".log" ).text( "Triggered ajaxError handler" );
});
  }
  </script>
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
        <li><a href="writeQuestion.php">Write question</a></li>
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
    if ($_SESSION["wroteQuestion"] == "no") {
      echo '<script>alert("Failed to write new question!");</script>';
      $_SESSION["wroteQuestion"] = "notYet";
    }
     echo '<p style="white-space:nowrap;">Logged in as ' . $_SESSION["user"] . '</p>';//Will later need to change the <p> tag to be a link where they can edit their password perhaps
   session_write_close();//Work in progress, will put out the username if the session is started
  ?>
  </div>
<form style="float:right;padding:10px" action="viewQuestion.php" method="post">
  <p>Input the question id of the question you want to view</p>
  <input type="text" name="qID">
  <br>
  <input type="submit" value="submit">
</form>
<a href="loginReg.php">Logout</a>
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
    public $likes;
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
  $query = $conn->prepare("SELECT count(question_id) from question_table");
  $query->execute();
  $query->store_result();
  $query->bind_result($count);
  $query->fetch();
  $query->close();
  if ($count <= 0) {
    echo "something went wrong somewhere";
  } else {
    $questions = new question();
    $query = $conn->prepare("SELECT question_id, question_username, question_title, question_score from question_table");
    $query->execute();
    $query->store_result();
    $query->bind_result($questions->id, $questions->usrName, $questions->title, $questions->likes);
  for ($i = 0; $i < $count; $i++) { //Load in questions object and make question html
    $query->fetch();
    echo '<div style="position: relative; height:200px; width:800px; top: ' . ($i * 100) . 'px;border: 3px solid blue; ">';
    echo '<p style="white-space:nowrap;">Question ID: ' . $questions->id . '    Username: ' . $questions->usrName . '</p><p style="white-space:nowrap;"id= "' . $questions->id . '"> Likes: ' . $questions->likes . '</p>';
echo '<button onclick="like('.$questions->id .')">Like</button>'; //calls like script with qID
    echo '<p style="white-space:nowrap;">Title: ' . $questions->title . '</p></div>';


  }
  //may need $conn->close here
}
  session_write_close();
  ?>
</body>
</html>
