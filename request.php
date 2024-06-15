<?php

include "config.php";
$query = "select * from book_request";
$result = mysqli_query($conn,$query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Book Request</title>
   <link rel="stylesheet" href="css/styles.css"> 
   <link rel="stylesheet" href="style.css">
   <!--Bootstrap links for responsive project-->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

   <style>
     header{
            background-color: black;
            padding: 0px;
            width: 100%;
            margin: auto;
        }
        header a{
            text-decoration: none;
            color: white;
        }
        header li{
            display: inline;
            padding: 0 10px 0 10px;
			
			
        }
        header nav{
            float: right;
        }
     header a:hover{
            color: white;
        }
        #branding{
            float: left;
            color:white;
        }
       
       
		.containers{
            overflow: hidden;
            margin: auto;
           width: 90%;
           
        }
   </style>

</head>
<body class="bg-dark">
   <header style="height: 80px;">
   
        <div class="containers">
        <div id="branding" class="logo">
		<img src="images/9.png"><div>
			<span class="sp1">IUT</span>  E-Library  System</div>
		</div>
        <nav class="navi">
            <ul>
			<li><a href="admin_login.php">ADMIN-LOGIN</a></li>
								<li><a href="admin.php">BACK</a></li>
								<li><a href="#">FEEDBACK</a></li>
                                <li><a href="home_page.php">HOME PAGE</a></li>
            </ul>
        </nav>
        </div>
    
   </header>
   
<section>
   <div class="card-header">
    <h2 style="text-align: center;">USER BOOKS REQUEST</h2>
   </div>
   <DIV class="card-body">
    <table class="table table-bordered text-center" border="2">
        <tr style="background-color: black; color:aliceblue;">
            <th>User Name</th>
            <th>Book's ID</th>
            <th>Date</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>action</th>
        </tr>

        <tr>
        <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['bid'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "<td><span class='btn btn-danger'><a href='delete.php?name=" . $row['name'] . "'>Delete</a> </span></td>";
        
        echo "</tr>";
    }
    ?>
        </tr>
    </table>
   </DIV>
   </section>


   <section style="height: 15; width: 15;">
      <div class="reg_img">
         <div class="box2">
            <br><br><br>
            <h1 style="text-align: center; font-size: 35px; font-family: Lucida Console;">&nbsp APPROVE USER'S REQUEST</h1>
           
         <form name="approve" action="" method="post">
            <br>
            <div class="login">
               <input class="form-control" type="text" name="username" placeholder="user's name" required="">
               <br>
               <input class="form-control" type="number" name="bid" placeholder="book's ID" required="">
               <br>
               
               <input class="form-control" type="text" name="return_date" placeholder="return date" required="">
               <br>
               <input class="form-control" type="email" name="email" placeholder="Email" required="">
               <br>
               <input class="btn btn-default" type="submit" name="submit1" value="Approve" style="color: black; width: 70px; height: 30px;">             
           
            </div>
         </form>
      </div>
   </div>


   <?php
if(isset($_POST['submit1'])){
   $name = mysqli_real_escape_string($conn, $_POST['username']);
   $bid = mysqli_real_escape_string($conn, $_POST['bid']);
   $issuedate=date("Y-m-d");
   $returndate=mysqli_real_escape_string($conn, $_POST['return_date']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   
      
      $insert = "INSERT INTO issued_books(username,bid,issued_date,return_date, email) VALUES('$name','$bid','$issuedate','$returndate','$email')";
      mysqli_query($conn, $insert);
      
  
      
   }
?>



   <section style="height: 15; width: 15;">
      <div class="reg_img">
         <div class="box2">
            <br><br><br>
            <h1 style="text-align: center; font-size: 35px; font-family: Lucida Console;">&nbsp REPLY TO THE USER</h1>
           
         <form name="reply" action="" method="post">
            <br>
            <div class="login">
               <input class="form-control" type="text" name="message" placeholder="Enter reply" required="">
               <br>
               <input class="form-control" type="email" name="email" placeholder="Email" required="">
               <br>
               
               
            <input class="btn btn-default" type="submit" name="submit" value="reply" style="color: black; width: 70px; height: 30px;">
            </div>
         </form>
      </div>
   </div>

      </section>  
<?php
if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
   $msg = mysqli_real_escape_string($conn, $_POST['message']);
   
   $select = " SELECT * FROM user WHERE email = '$email' ";
   $result = mysqli_query($conn, $select);
   
      $insert = "INSERT INTO reply(email,message) VALUES('$email','$msg')";
      mysqli_query($conn, $insert);
 
      $msge=$_POST['message']." .";
   $from="from: abdellaabasse@iut-dhaka.edu";
      if(mail($_POST['email'],"Reply to Request",$msge,$from))
      {
        echo "The message has been succesfully sent";
        // header("location:request.php");
         exit;
      }
      else{
        
         $error[] = 'email not sent';
      }
   }
   
?>
<br><br><br><br><br>
<footer>
        <?php include "footer.php"; ?>
    </footer>
   </body>
   </html>
