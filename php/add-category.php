<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

	# Database Connection File
	include "../db_conn.php";


    /** 
	  check if category 
	  name is submitted
	**/
	if (isset($_POST['category_name'])) {
		/** 
		Get data from POST request 
		and store it in var
		**/
		$name = $_POST['category_name'];

		#simple form Validation
		if (empty($name)) {
			$em = "The category name is required";
			header("Location: ../add-category.php?error=$em");
            exit;
		}else {

			// Check if the author already exists in the database
            $check_query = "SELECT * FROM categories WHERE name = :categoryName";
            $check_stmt = $conn->prepare($check_query);
            $check_stmt->bindParam(':categoryName', $name, PDO::PARAM_STR);
            $check_stmt->execute();
            $check_result = $check_stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($check_result) > 0) {
                # Author with the same name already exists
                $em = "category already exists";
                header("Location: ../add-category.php?error=$em");
                exit;
            }

			# Insert Into Database
			$sql  = "INSERT INTO categories (name)
			         VALUES (?)";
			$stmt = $conn->prepare($sql);
			$res  = $stmt->execute([$name]);

			/**
		      If there is no error while 
		      inserting the data
		    **/
		     if ($res) {
		     	# success message
		     	$sm = "Successfully created!";
				header("Location: ../add-category.php?success=$sm");
	            exit;
		     }else{
		     	# Error message
		     	$em = "Unknown Error Occurred!";
				header("Location: ../add-category.php?error=$em");
	            exit;
		     }
		}
	}else {
      header("Location: ../admin.php");
      exit;
	}

}else{
  header("Location: ../login.php");
  exit;
}