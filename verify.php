<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verify email address</title>
    <style type="text/css">
    .box1
    {
height: 500px;
width: 350px;
margin: 0px auto;
opacity: .8;
color: white;
padding-top: 200px;
    }
    </style>
</head>
<body style="background-color: #00695c;">
<div class="box1">
    <h2>Enter the OTP</h2>
    <form method="post">
        <input style="width:300px;height:50;"type="text" name="otp" class="form-control" required placeholder="Enter the OTP here...">
    <br>
    <button class="btn btn-default" type="submit" name="submit_v" style="font-weight: 700;">verify</button>
    </form>
</div>
 <?php
 $var1=0;
 if(isset($_POST['submit_v']))
 {
    $ver2=mysqli_query($conn,"select * from verify;");
    while($row=mysqli_fetch_assoc($ver2))
    {
        if($_POST['otp']==$row['otp'])
        {
            mysqli_query($conn,"UPDATE user set status='1' where name='$row[name]';");
            $ver1=$ver1+1;
        }
    }
    if($ver1==1)
    {
        header("location:user_store.php");
    }
    else{
        echo "wrong OTP given. Try again.";
        ?>
        <script type="text/javascript">
            alert("wrong OTP given. Try again.");
            </script>
        <?php
    }
 }
 ?>
</body>
</html>