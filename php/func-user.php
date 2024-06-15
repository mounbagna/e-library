<?php  

# Get All books function
function get_all_user($con){
   $sql  = "SELECT * FROM user ORDER bY id DESC";
   $stmt = $con->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() > 0) {
   	  $users = $stmt->fetchAll();
   }else {
      $users = 0;
   }

   return $users;
}



# Get  book by ID function
function get_user($conn, $id){
   $sql  = "SELECT * FROM user WHERE id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   if ($stmt->rowCount() > 0) {
   	  $user = $stmt->fetch();
   }else {
      $user = 0;
   }

   return $user;
}


# Search books function
function search_users($conn, $key){
   # creating simple search algorithm :) 
   $key = "%{$key}%";

   $sql  = "SELECT * FROM user 
            WHERE name LIKE ?
            OR email LIKE ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$key, $key]);

   if ($stmt->rowCount() > 0) {
        $books = $stmt->fetchAll();
   }else {
      $users = 0;
   }

   return $users;
}

# get books by category
function get_users_by_name($conn, $id){
   $sql  = "SELECT * FROM users WHERE id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   if ($stmt->rowCount() > 0) {
        $users = $stmt->fetchAll();
   }else {
      $users = 0;
   }

   return $users;
}