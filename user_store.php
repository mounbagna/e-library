<?php 
session_start();

# Database Connection File
include "db_conn.php";

# Book helper function
include "php/func-book.php";
$books = get_all_books($conn);

# author helper function
include "php/func-author.php";
$authors = get_all_author($conn);

# Category helper function
include "php/func-category.php";
$categories = get_all_categories($conn);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Store</title>

    <!-- bootstrap 5 CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    
    <style>
        body {
            background: url('images/black.jpg');
        }

        .pdf-list {
            max-width: 80%;
        }

        .pdf-list .card {
            max-width: 180px;
            margin: 10px;
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
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="user_edit_info.php">EDIT-INFORMATION</a>
                        </li>
                        <li><a href="feedback.php" class="nav-link">FEEDBACK</a></li>
                        <li><a href="request_book.php" class="nav-link">REQUEST BOOK</a></li>
                        <li><a href="chat_room.php" class="nav-link">CHAT-ROOM</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">LOGOUT</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <section style="font-size: 50px; color:white">
            <?php
            if (isset($_SESSION['user_login'])) {
                echo "Welcome " . $_SESSION['user_login'];
            }
            ?>
        </section>

        <form action="user_search.php" method="get" style="width: 100%; max-width: 30rem">
            <div class="input-group my-5">
                <input type="text" class="form-control" name="key" placeholder="Search Book..." aria-label="Search Book..." aria-describedby="basic-addon2">
                <button class="input-group-text btn btn-primary" id="basic-addon2">
                    <img src="img/search.png" width="20">
                </button>
            </div>
        </form>

        <section id="boxes">
            <div class="container">
                <div class="row">
                    <!-- Move the book list to the far left -->
                    <div class="col-lg-8">
                        <div class="d-flex pt-3">
                            <?php if ($books == 0) { ?>
                                <div class="alert alert-warning text-center p-5" role="alert">
                                    <img src="img/empty.png" width="100">
                                    <br>There is no book in the database
                                </div>
                            <?php } else { ?>
                                <div class="pdf-list d-flex flex-wrap">
                                    <?php foreach ($books as $book) { ?>
                                        <div class="card m-1">
                                            <img src="uploads/cover/<?=$book['cover']?>" class="card-img-top" height="200px">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <?=$book['title']?>
                                                </h5>
                                                <p class="card-text">
                                                    <i><b>By:
                                                        <?php foreach($authors as $author){ 
                                                            if ($author['id'] == $book['author_id']) {
                                                                echo $author['name'];
                                                                break;
                                                            }
                                                        ?>
                                                        <?php } ?>
                                                        <br></b></i>

                                                    <i><b>ISBN:
                                                        <?php echo $book['id']; ?>
                                                    <br></b></i>
                                                    <?=$book['description']?>
                                                    <br><i><b>Category:
                                                        <?php foreach($categories as $category){ 
                                                            if ($category['id'] == $book['category_id']) {
                                                                echo $category['name'];
                                                                break;
                                                            }
                                                        ?>
                                                        <?php } ?>
                                                    <br></b></i>
                                                </p>
                                                <a href="uploads/files/<?=$book['file']?>"
                                                    class="btn btn-success">Open</a>

                                                <a href="uploads/files/<?=$book['file']?>"
                                                    class="btn btn-primary"
                                                    download="<?=$book['title']?>">Download</a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <!-- Move the category and author lists to the far right -->
                    <div  class="col-lg-4">
                        <div class="category">
                            <!-- List of categories -->
                            <div  style="width:auto; height:auto;" class="list-group"> 
                                <?php if ($categories == 0) {
                                    // do nothing
                                } else { ?> &nbsp;&nbsp;
                                    &nbsp;&nbsp<a href="#" class="list-group-item list-group-item-action active">Category</a>
                                    <?php foreach ($categories as $category ) { ?>
                                        <a href="user_category.php?id=<?=$category['id']?>" class="list-group-item list-group-item-action"><?=$category['name']?></a>
                                    <?php } ?>
                                <?php } ?>
                            </div>

                            <!-- List of authors -->
                            <div style="height: fit-content;" class="list-group mt-5">
                                <?php if ($authors == 0) {
                                    // do nothing
                                } else { ?>
                                    <a href="#" class="list-group-item list-group-item-action active">Author</a>
                                    <?php foreach ($authors as $author ) { ?>
                                        <a href="user_author.php?id=<?=$author['id']?>" class="list-group-item list-group-item-action"><?=$author['name']?></a>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
	<br><br><br><br><br><br><br>
	<footer>
        <?php include "footer.php"; ?>
    </footer>
</body>
</html>
