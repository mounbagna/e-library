<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['id']) &&
    isset($_SESSION['email'])) {

	# Database Connection File
	include "../.php";

    # Validation helper function
    include "func-validation.php";

  


    /** 
	  If all Input field
	  are filled
	**/
	if (isset($_POST['id'])          &&
        isset($_POST['name'])       &&
        isset($_POST['email']) &&
        isset($_POST['phone'])      &&
        isset($_POST['password']) 
      ) {

		/** 
		Get data from POST request 
		and store them in var
		**/
		$id          = $_POST['id'];
		$name       = $_POST['name'];
		$email = $_POST['email'];
		$phone    = $_POST['phone'];
		$pass    = $_POST['password'];
        
       

        #simple form Validation
		$text = "id";
        $location = "../edit-user.php";
        $ms = "id=$id&error";
		is_empty($id, $text, $location, $ms, "");

        $text = "name";
        $location = "../edit-user.php";
        $ms = "id=$id&error";
		is_empty($title, $text, $location, $ms, "");

		$text = "email";
        $location = "../edit-user.php";
        $ms = "id=$id&error";
		is_empty($description, $text, $location, $ms, "");

		$text = "phone";
        $location = "../edit-user.php";
        $ms = "id=$id&error";
		is_empty($author, $text, $location, $ms, "");

		$text = "password";
        $location = "../edit-user.php";
        $ms = "id=$id&error";
		is_empty($category, $text, $location, $ms, "");

          	# update just the data
          	$sql = "UPDATE user
          	        SET name=?,
          	            email=?,
          	            phone=?,
          	            password=?
          	        WHERE id=?";
          	$stmt = $conn->prepare($sql);
			$res  = $stmt->execute([$name, $email, $phone, $pass, $id]);

		    /**
		      If there is no error while 
		      updating the data
		    **/
		     if ($res) {
		     	# success message
		     	$sm = "Successfully updated!";
				header("Location: ../edit-user.php?success=$sm&id=$id");
	            exit;
		     }else{
		     	# Error message
		     	$em = "Unknown Error Occurred!";
				header("Location: ../edit-user.php?error=$em&id=$id");
	            exit;
		     }
            }
     

else{
  header("Location: ../user_store.php");
  exit;
}
}
else
{
    header("Location: ../user_store.php");
    exit;
  }