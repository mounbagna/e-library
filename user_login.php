<?php
include "config.php";
session_start();
$sql = "SELECT * FROM user";
            $res = mysqli_query($conn, $sql);

           
                $row = mysqli_fetch_assoc($res);
if(isset($_POST['submit']))
   {
      $_SESSION['user_login']=$_POST['name'];
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   /* $pass = md5($_POST['password']); */
   $pass = $row['password'];
   $select = " SELECT * FROM user WHERE name = '$name' && email = '$email' && password = '$pass'";
   $res=mysqli_query($conn,$select);
      if(mysqli_num_rows($res)>0)
      {
        
         $row = mysqli_fetch_array($res);
         if($row['status']==1)
         {
            
            $_SESSION['user_login'] = $_POST['name']; 
            header('location:user_store.php');
         }
         else{
            
               if (isset($_SESSION['user_login'])) {
                  
               }
               
            $_SESSION['user_login'] = $_POST['name']; 
            header('location:user_store.php');
            
         }
      }
      else
      { 
         
        ?>
        <div class="alert alert-danger" style="text-align:center; color:white;background-color: red; width: 700px; margin-left: 300px;">
         <strong>Incorrect entries</strong>
        </div>
        <?php
      }
   };
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user login</title>
   <link rel="stylesheet" href="css/style.css"> 
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

</head>
<body>
   <header style="height: 80px;">
   <nav class="navbar navbar-inverse">
      <div class="container-fluid">
          
          <ul class="nav navbar-nav">
            <li><a href="home_page.php">HOME</a></li>   
      </div>
    </nav>
   </header>
   <section>
      <div class="log_img">
         <br><br><br>
         <div class="box1">
            <h1 style="text-align: center; font-size: 35px; font-family: Lucida Console;"></h1><br>
            <h1 style="text-align: center;font-size: 25px;"><strong>USER LOGIN FORM</strong></h1>
         <form name="login" action="" method="post">
            <br><br>
            <div class="login">
            <input class="form-control" type="text" name="name" required="" placeholder="enter your name"><br>
            <input class="form-control" type="email" name="email" required="" placeholder="enter your email"><br>
            <input class="form-control" type="password" name="password" required="" placeholder="enter your password"><br>
            <input class="btn btn-default" type="submit" name="submit" value="Login" style="color: black; width: 70px; height: 30px;">
            
            </div>
         
         <p style="color: white;padding-left:15px ; font-size:30px">
            <br><br>
             &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
            New to this website ? <a style="color: white;" href="user_registration.php">Sign Up</a>
         </p>
      </form>
      </div>
      </div>
   </section>
   
   </body>
</html>