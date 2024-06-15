<?php
include 'config.php';
$id=$_GET['updateid'];
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $pass=$_POST['password'];

    $sql="update user set id=$id,name='$name',
    email='$email',phone='$phone',password='$pass'
    where id=$id";
    $res=mysqli_query($conn,$sql);
    if($res){
        echo "successfully updated";
        header('location:user_edit_info.php');
    }else{
        die(mysqli_error($conn));
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>update user</title>
</head>
<body>
    <div class="container my-5">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <div class="container-fluid">
		    <a class="navbar-brand" href="user_store.php">Online Book Store</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" 
		         id="navbarSupportedContent">
		      <ul class="navbar-nav me-auto mb-2 mb-lg-0">       
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="user_edit_info.php">Edit-Information</a>
		        </li>        
				<li><a href="request_book.php" class="nav-link">REQUEST BOOK</a></li>
				<li><a href="chat_room.php" class="nav-link">CHAT-ROOM</a></li>
				<li class="nav-item">
		          <a class="nav-link" 
		             href="logout.php">logout</a>
		        </li>
		        <li class="nav-item">
		        </li>
		      </ul>
		    </div>
		  </div>
		</nav>
        <form method="post">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control"
                placeholder="Enter name"
                name="name" autocomplete="off">
            </div>
            <div class="form-group">
            <label>Email</label>
                <input type="email" class="form-control"
                placeholder="Enter email"
                name="email" autocomplete="off"> 
            </div>
            <div class="form-group">
            <label>Phone</label>
                <input type="text" class="form-control"
                placeholder="Enter phone number"
                name="phone" autocomplete="off"> 
            </div>
            <div class="form-group">
            <label>password</label>
                <input type="text" class="form-control"
                placeholder="Enter your password"
                name="password" autocomplete="off"> 
            </div>

            <button type="submit" class="btn btn-primary"
            name="submit">Update</button>
        </form>
    </div>
</body>
</html>