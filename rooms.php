<?php

$roomname = $_POST['Roomname'];
$clientname = $_POST['clientname'];
$roompassword = $_POST['Roompassword'];
if (strlen($roomname) == 0 or strlen($clientname) == 0 or strlen($roompassword) == 0) {
  $message = "All fields are required!";
  echo '<script language="javascript">';
  echo 'alert("' . $message . '");';
  echo 'window.location="http://localhost/Chatroom/exroom.php";';
  echo '</script>';
}
include 'db_connect.php';

$sql = "SELECT * FROM `rooms` WHERE Roomname = '$roomname' and rpassword = '$roompassword';";
$result = mysqli_query($conn, $sql);
if ($result) {

  if (mysqli_num_rows($result) == 0) {
    $message = "Room does not exists or incorrect password";
    echo '<script language="javascript">';
    echo 'alert("' . $message . '");';
    echo 'window.location="http://localhost/Chatroom/exroom.php";';
    echo '</script>';
  } else {
  }
} else {
  echo "Error: " . mysqli_errno($conn);
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>iChat.com</title>
  <link rel="icon" type="image/x-icon" href="assets/img/chat.png" />
  <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet" />

  <style>
    body {
      margin: 0 auto;
    }

    * {
      margin: 0;
      padding: 0;
      font-family: 'Josefin Sans', sans-serif;
    }

    .container {
      background-color: #f1f1f1;
      border-radius: 5px;
      margin-top: 20px;
    }

    .darker {
      border-color: #ccc;
      background-color: #ddd;
    }

    .container::after {
      content: "";
      clear: both;
      display: table;
    }

    .container img {
      float: left;
      width: 100%;
      margin-right: 20px;
      border-radius: 50%;
    }

    .container img.right {
      float: right;
      margin-left: 20px;
      margin-right: 0;
    }

    .time-right {
      float: right;
      color: #aaa;
    }

    .time-left {
      float: left;
      color: #999;
    }
  </style>
</head>

<body id="page-top">
  <nav class="navbar navbar-expand-lg navbar-light fixed-top mx-auto" id="mainNav">
    <div class="container bg-transparent">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">iChat.com</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">About</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <header class="masthead" id="home">
    <div class="container bg-transparent">
      <h2 class="text-center text-white mb-5">Chat Messages - <?php echo $roomname ?></h2>
      <div class="container">
        <div class="anyClass" style="height: 350px; overflow-y:scroll">
        </div>
      </div>
    </div>
    <div class="container bg-transparent">
      <div class="form-group">
        <input type="text" name="msg" id="msg" class="form-control" placeholder="Enter message">
      </div>
      <button class="btn btn-dark" name="submitmsg" id="submitmsg">Sends</button>
    </div>
  </header>
  <section class="page-section" id="contact">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="mt-0">Let's Get In Touch!</h2>
          <hr class="divider my-4 mx-auto" />
          <p class="text-muted mb-5">If you have any query related to this website then contact us.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
          <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
          <div>+916265324268</div>
        </div>
        <div class="col-lg-4 mr-auto text-center">
          <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
          <!-- Make sure to change the email address in BOTH the anchor text and the link target below!-->
          <a class="d-block" href="mailto:contact@yourwebsite.com">akshayu383@gmail.com</a>
        </div>
      </div>
    </div>
  </section>
  <!-- Footer-->
  <footer class="bg-light py-5">
    <div class="container">
      <div class="small text-center text-muted">Copyright © iChat.com</div>
    </div>
  </footer>
  <!-- Bootstrap core JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
  <!-- Third party plugin JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

  <script>
    // checking for messages 
    setInterval(checkFunction, 1000);

    function checkFunction() {
      $.post("htcon.php", {
          room: '<?php echo $roomname ?>'
        },
        function(data, status) {
          document.getElementsByClassName('anyClass')[0].innerHTML = data;
        }
      )

    }

    var input = document.getElementById("msg");
    input.addEventListener("keyup", function(event) {
      if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("submitmsg").click();
      }
    });

    $('#submitmsg').click(function() {
      var clientmsg = $('#msg').val();
      $.post("postmsg.php", {
          text: clientmsg,
          room: '<?php echo $roomname ?>',
          ip: '<?php echo $clientname ?>'
        },
        function(data, status) {
          document.getElementsByClassName('anyClass')[0].innerHTML = data;
        });
      $("#msg").val("");
      return false;
    });
  </script>
</body>

</html>