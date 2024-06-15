<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user edit info</title>

    <style>
      
.container {
	background: url('images/white.jpg');
    padding: 80px;
    width: 80%;
    margin-top: 8%;
}
body
{
    background: url('images/blue.jpg');
		font: 15px/1.5 cursive;
}
    </style>
</head>
<body>
    <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <div class="container-fluid">
		    <a class="navbar-brand" href="user_store.php">Online Book Store</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" 
		         id="navbarSupportedContent">
		      <ul class="navbar-nav me-auto mb-2 mb-lg-0">  
		          
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
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Password</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

            <?php
include 'config.php';

    $sql = "SELECT * FROM user where id=13";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
            $name = $row['name'];
            $email = $row['email'];
            $phone = $row['Phone'];
            $pass = $row['password'];
            echo  ' <tr>
                    <th scope="row">' . $id . '</th>
                    <td>' . $name . '</td>
                    <td>' . $email . '</td>
                    <td>' . $phone . '</td>
                    <td>' . $pass . '</td>
                    <td>
                    <button class="btn btn-primary"><a href="editinfo.php?updateid=' . $id . '" class="text-light">Update</button>
                    </td>
                    </tr>';
        }
    } else {
        echo '<tr><td colspan="6">No records found</td></tr>';
    }
?>


            </tbody>
        </table>
    </div>
</body>
</html>
