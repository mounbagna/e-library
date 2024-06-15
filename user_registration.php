<?php
include "navbar.php";
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>registration</title>
   <link rel="stylesheet" href="style.css"> 

   <!--Bootstrap links for responsive project-->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

</head>
<body>
   <header style="height: 80px;">
   </header>
   <section style="height: 15; width: 15;">
      <div class="reg_img">
         <div class="box2">
            <h1 style="text-align: center; font-size: 35px; font-family: Lucida Console;"></h1>
            <h1 style="text-align: center;font-size: 25px;"><strong>USER'S REGISTRATION FORM</strong></h1>
         <form name="registration" action="" method="post">
            <br>
            <div class="login">
               <input class="form-control" type="text" name="name" placeholder="User Name" required="">
               <br>
               <input class="form-control" type="email" name="email" placeholder="Email" required="">
               <br>
               <input class="form-control" type="text" name="phone" required="" placeholder="phone number">
               <br>
               <input class="form-control" type="password" name="password" placeholder="password" required="">
               <br>
               
            <input class="btn btn-default" type="submit" name="submit" value="Sign Up" style="color: black; width: 70px; height: 30px;">
            </div>
         </form>
      </div>
   </div>

      </section>  
<?php
$sql = "SELECT * FROM user";
$res = mysqli_query($conn, $sql);


    $row = mysqli_fetch_assoc($res);
if(isset($_POST['submit'])){
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   /*$pass = md5($_POST['password']);*/
   $pass = $row['password'];
   $phone =  mysqli_real_escape_string($conn,$_POST['phone']);
   $select = " SELECT * FROM user WHERE email = '$email' && password = '$pass' ";
   $result = mysqli_query($conn, $select);
   
   if(mysqli_num_rows($result) > 0){
      $error[] = 'user already exist!';
   }else if(mysqli_num_rows($result)==0)
   {
      
      $insert = "INSERT INTO user(id,name, email,status,phone, password) VALUES('','$name','$email','0','$phone','$pass')";
      mysqli_query($conn, $insert);
      $otp=rand(10000,99999);
      $date=date("Y-m-d");
      mysqli_query($conn,"INSERT INTO verify VALUES('$_POST[name]','$otp','$date');");
      $msg="Hello your OTP code: ".$otp." .";
   $from="from: abdellaabasse@iut-dhaka.edu";
      if(mail($_POST['email'],"OTP",$msg,$from))
      {
         header('location:verify.php');
      }
      else{
        
         $error[] = 'email not sent';
      }
   }
   else if($pass != $cpass){
         $error[] = 'password not matched!';
      }
}?>
   </body>
   </html>
