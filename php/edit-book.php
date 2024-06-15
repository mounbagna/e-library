<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

	# Database Connection File
	include "../db_conn.php";

    # Validation helper function
    include "func-validation.php";

    # File Upload helper function
    include "func-file-upload.php";


    /** 
	  If all Input field
	  are filled
	**/
	if (isset($_POST['book_id'])          &&
        isset($_POST['book_title'])       &&
        isset($_POST['book_description']) &&
        isset($_POST['book_author'])      &&
        isset($_POST['book_category'])    &&
        isset($_FILES['book_cover'])      &&
        isset($_FILES['file'])            &&
        isset($_POST['current_cover'])    &&
		isset($_POST['current_file'])     &&
        isset($_POST['current_file2'])) {

		/** 
		Get data from POST request 
		and store them in var
		**/
		$id          = $_POST['book_id'];
		$title       = $_POST['book_title'];
		$description = $_POST['book_description'];
		$author      = $_POST['book_author'];
		$category    = $_POST['book_category'];
        
         /** 
	      Get current cover & current file 
	      from POST request and store them in var
	    **/

        $current_cover = $_POST['current_cover'];
        $current_file  = $_POST['current_file'];
		$current_file2  = $_POST['current_file2'];

        #simple form Validation
		$text = "Book id";
        $location = "../edit-book.php";
        $ms = "id=$id&error";
		is_empty($id, $text, $location, $ms, "");

        $text = "Book title";
        $location = "../edit-book.php";
        $ms = "id=$id&error";
		is_empty($title, $text, $location, $ms, "");

		$text = "Book description";
        $location = "../edit-book.php";
        $ms = "id=$id&error";
		is_empty($description, $text, $location, $ms, "");

		$text = "Book author";
        $location = "../edit-book.php";
        $ms = "id=$id&error";
		is_empty($author, $text, $location, $ms, "");

		$text = "Book category";
        $location = "../edit-book.php";
        $ms = "id=$id&error";
		is_empty($category, $text, $location, $ms, "");

        /**
          if the admin try to 
          update the book cover
        **/
          if (!empty($_FILES['book_cover']['name'])) {
          	  /**
		          if the admin try to 
		          update both 
		      **/
		      if (!empty($_FILES['file']['name'])) {
		      	# update both here

		      	# book cover Uploading
		        $allowed_image_exs = array("jpg", "jpeg", "png");
		        $path = "cover";
		        $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs, $path);

		        # book file Uploading
		        $allowed_file_exs = array("pdf", "docx", "pptx");
		        $path = "files";
		        $file = upload_file($_FILES['file'], $allowed_file_exs, $path);
				$file2 = upload_file($_FILES['file2'], $allowed_file_exs, $path);
                
                /**
				    If error occurred while 
				    uploading
				**/
		        if ($book_cover['status'] == "error" || 
		            $file['status'] == "error" || 
		            $file2['status'] == "error") {

			    	$em = $book_cover['data'];

			    	/**
			    	  Redirect to '../edit-book.php' 
			    	  and passing error message & the id
			    	**/
			    	header("Location: ../edit-book.php?error=$em&id=$id");
			    	exit;
			    }else {
                  # current book cover path
			      $c_p_book_cover = "../uploads/cover/$current_cover";

			      # current file path
			      $c_p_file = "../uploads/files/$current_file";

				  # current file2 path
			      $c_p_file2 = "../uploads/files/$current_file2";

			      # Delete from the server
			      unlink($c_p_book_cover);
			      unlink($c_p_file);
				  unlink($c_p_file2);

			      /**
		              Getting the new file name 
		              and the new book cover name 
		          **/
		           $file_URL = $file['data'];
				   $file2_URL = $file2['data'];
		           $book_cover_URL = $book_cover['data'];

		            # update just the data
		          	$sql = "UPDATE books
		          	        SET title=?,
		          	            author_id=?,
		          	            description=?,
		          	            category_id=?,
		          	            cover=?,
		          	            file=?,
								file2=?
		          	        WHERE id=?";
		          	$stmt = $conn->prepare($sql);
					$res  = $stmt->execute([$title, $author, $description, $category,$book_cover_URL, $file_URL,$file2_URL,$id]);

				    /**
				      If there is no error while 
				      updating the data
				    **/
				     if ($res) {
				     	# success message
				     	$sm = "Successfully updated!";
						header("Location: ../edit-book.php?success=$sm&id=$id");
			            exit;
				     }else{
				     	# Error message
				     	$em = "Unknown Error Occurred!";
						header("Location: ../edit-book.php?error=$em&id=$id");
			            exit;
				     }


			    }
		      }else {
		      	# update just the book cover

		      	# book cover Uploading
		        $allowed_image_exs = array("jpg", "jpeg", "png");
		        $path = "cover";
		        $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs, $path);
                
                /**
				    If error occurred while 
				    uploading
				**/
		        if ($book_cover['status'] == "error") {

			    	$em = $book_cover['data'];

			    	/**
			    	  Redirect to '../edit-book.php' 
			    	  and passing error message & the id
			    	**/
			    	header("Location: ../edit-book.php?error=$em&id=$id");
			    	exit;
			    }else {
                  # current book cover path
			      $c_p_book_cover = "../uploads/cover/$current_cover";

			      # Delete from the server
			      unlink($c_p_book_cover);

			      /**
		              Getting the new file name 
		              and the new book cover name 
		          **/
		           $book_cover_URL = $book_cover['data'];

		            # update just the data
		          	$sql = "UPDATE books
		          	        SET title=?,
		          	            author_id=?,
		          	            description=?,
		          	            category_id=?,
		          	            cover=?
		          	        WHERE id=?";
		          	$stmt = $conn->prepare($sql);
					$res  = $stmt->execute([$title, $author, $description, $category,$book_cover_URL, $id]);

				    /**
				      If there is no error while 
				      updating the data
				    **/
				     if ($res) {
				     	# success message
				     	$sm = "Successfully updated!";
						header("Location: ../edit-book.php?success=$sm&id=$id");
			            exit;
				     }else{
				     	# Error message
				     	$em = "Unknown Error Occurred!";
						header("Location: ../edit-book.php?error=$em&id=$id");
			            exit;
				     }


			    }
		      }
          }
          /**
          if the admin try to 
          update just the files

          **/
          else if(!empty($_FILES['file']['name'])){
          	# update just the file
            
            # book cover Uploading
	        $allowed_file_exs = array("pdf", "docx", "pptx");
	        $path = "files";
	        $file = upload_file($_FILES['file'], $allowed_file_exs, $path);
			$file2 = upload_file($_FILES['file2'], $allowed_file_exs, $path);
            
            /**
			    If error occurred while 
			    uploading
			**/
	        if ($file['status'] == "error" || $file2['status'] == "error") {

		    	$em = $file['data'];
				$em2 = $file2['data'];

		    	/**
		    	  Redirect to '../edit-book.php' 
		    	  and passing error message & the id
		    	**/
		    	header("Location: ../edit-book.php?error=$em&id=$id");
		    	exit;
		    }else {
              # current books cover path
		      $c_p_file = "../uploads/files/$current_file";
			  $c_p_file2 = "../uploads/files/$current_file2";

		      # Delete from the server
		      unlink($c_p_file);
			  unlink($c_p_file2);

		      /**
	              Getting the new file name 
	              and the new file name 
	          **/
	           $file_URL = $file['data'];
			   $file2_URL = $file2['data'];

	            # update just the data
	          	$sql = "UPDATE books
	          	        SET title=?,
	          	            author_id=?,
	          	            description=?,
	          	            category_id=?,
	          	            file=?
	          	        WHERE id=?";
	          	$stmt = $conn->prepare($sql);
				$res  = $stmt->execute([$title, $author, $description, $category, $file_URL, $file2_URL,$id]);

			    /**
			      If there is no error while 
			      updating the data
			    **/
			     if ($res) {
			     	# success message
			     	$sm = "Successfully updated!";
					header("Location: ../edit-book.php?success=$sm&id=$id");
		            exit;
			     }else{
			     	# Error message
			     	$em = "Unknown Error Occurred!";
					header("Location: ../edit-book.php?error=$em&id=$id");
		            exit;
			     }


		    }
	      
          }else {
          	# update just the data
          	$sql = "UPDATE books
          	        SET title=?,
          	            author_id=?,
          	            description=?,
          	            category_id=?
          	        WHERE id=?";
          	$stmt = $conn->prepare($sql);
			$res  = $stmt->execute([$title, $author, $description, $category, $id]);

		    /**
		      If there is no error while 
		      updating the data
		    **/
		     if ($res) {
		     	# success message
		     	$sm = "Successfully updated!";
				header("Location: ../edit-book.php?success=$sm&id=$id");
	            exit;
		     }else{
		     	# Error message
		     	$em = "Unknown Error Occurred!";
				header("Location: ../edit-book.php?error=$em&id=$id");
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