<?php
include 'config.php';

$name = mysqli_real_escape_string($conn, $_GET['username']);

$deletequery = "DELETE FROM returned_books WHERE name='$name'";
$query = mysqli_query($conn, $deletequery);

if ($query) {
    
        echo "Record deleted and inserted successfully";
        header("location:return_book.php");
    
        echo "Deletion failed";
    
} else {
    echo "Insertion failed";
}
?>
