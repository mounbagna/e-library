<?php

include "config.php";
$query = "select * from issued_books";
$result = mysqli_query($conn,$query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Issued Books</title>
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="style.css">
   <!-- Bootstrap links for responsive project -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

   <style>
     header {
            background-color: black;
            padding: 0px;
            width: 100%;
            margin: auto;
        }

        header a {
            text-decoration: none;
            color: white;
        }

        header li {
            display: inline;
            padding: 0 10px 0 10px;
        }

        header nav {
            float: right;
        }

        header a:hover {
            color: white;
        }

        #branding {
            float: left;
            color: white;
        }

        .containers {
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
            <img src="images/9.png">
            <div>
                <span class="sp1">IUT</span> E-Library System
            </div>
        </div>
        <nav class="navi">
            <ul>
                <li><a href="admin.php">BACK</a></li>
                <li><a href="admin_store.php">STORE</a></li>
                <li><a href="home_page.php">HOME PAGE</a></li>
            </ul>
        </nav>
        </div>
   </header>

   <section>
   <br><br><br><br><br>
       <div class="card-header">
        <h2 style="text-align: center;"><strong>ISSUED BOOKS</strong></h2>
       </div>
       <br><br><br>
       <div class="card-body">
        <table class="table table-bordered text-center" border="2">
            <tr style="background-color: black; color: aliceblue;">
                <th>User Name</th>
                <th>Book's ID</th>
                <th>Issued Date</th>
                <th>Return Date</th>
                <th>email</th>
                <th>action</th>               
            </tr>
            <?php
            // Database connection setup
            $servername = "localhost";
            $username = "root";
            $password = ""; // Replace with your actual MySQL password
            $database = "user_db";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Retrieve issued books information
                $sql = "SELECT * FROM issued_books";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $issuedBooks = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($issuedBooks as $book) {
                    echo "<tr>";
                    echo "<td>{$book['username']}</td>";
                    echo "<td>{$book['bid']}</td>";
                    echo "<td>{$book['issued_date']}</td>";                   
                    echo "<td>{$book['return_date']}</td>";
                    echo "<td>{$book['email']}</td>";
                    echo "<td><span class='btn btn-danger'><a href='deleteIssuedBooks.php?username=" . $book['username'] . "&bid=" . $book['bid'] . "&issued_date=" . $book['issued_date'] . "&email=" . $book['email'] . "'>Delete</a></span></td>";


                    echo "</tr>";
                }
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            ?>
        </table>
       </div>
   </section>
   <br><br><br><br><br><br>
   <footer>
        <?php include "footer.php"; ?>
    </footer>
</body>
</html>