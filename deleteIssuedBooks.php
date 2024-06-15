<?php
include 'config.php';

$name = mysqli_real_escape_string($conn, $_GET['username']);
$bid = mysqli_real_escape_string($conn, $_GET['bid']);
$issued_date = mysqli_real_escape_string($conn, $_GET['issued_date']);
$returned_date = date("Y-m-d");
$email = mysqli_real_escape_string($conn, $_GET['email']);

// Insert into returned_books table before deleting from issued_books
$insertquery = "INSERT INTO returned_books(name, bid, issued_date, return_date, email) VALUES('$name','$bid','$issued_date','$returned_date','$email')";
$iquery = mysqli_query($conn, $insertquery);

// Check if insertion was successful before proceeding with deletion
if ($iquery) {
    $deletequery = "DELETE FROM issued_books WHERE username='$name'";
    $query = mysqli_query($conn, $deletequery);

    if ($query) {
        echo "Record deleted and inserted successfully";
        header("location:issuedbooks.php");
    } else {
        echo "Deletion failed";
    }
} else {
    echo "Insertion failed";
}
?>
