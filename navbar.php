
<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>
	</title>

	  <link rel="stylesheet" type="text/css" href="style.css">
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

</head>
<body>

	    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
          
          <ul class="nav navbar-nav">
            <li><a href="home_page.php">HOME</a></li>
            <li><a href="index.php">BOOKS</a></li>
            <li><a href="feedback.php">FEEDBACK</a></li>
          </ul>
          <?php
            if(isset($_SESSION['user_login']))
            {?>
                <ul class="nav navbar-nav">
                  <li><a href="user.php">
                    STUDENT-INFORMATION
                  </a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                  <li><a href="">
                    <div style="color: white">

                      <?php
                      echo "<img class='img-circle profile_img' src='images/".$_session['pic']."'>";
                        echo $_SESSION['user_login']; 
                        
                      ?>
                    </div>
                  </a></li>
                  <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> LOGOUT</span></a></li>
                  
                </ul>
              <?php
            }
            else
            {   ?>
              <ul class="nav navbar-nav navbar-right">

                <li><a href="login.php"><span class="glyphicon glyphicon-log-in"> ADMIN-LOGIN</span></a></li>
                <li><a href="user_login.php"><span class="glyphicon glyphicon-log-in"> USER-LOGIN</span></a></li>
                <li><a href="user_registration.php"><span class="glyphicon glyphicon-user">USER-REGISTRATION</span></a></li>
              </ul>
                <?php
            }
          ?>

          

      </div>
    </nav>

</body>
</html>