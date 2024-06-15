<?php 
session_start();

# Database Connection File
include "db_conn.php";

# Book helper function
include "php/func-book.php";
$books = get_all_books($conn);

# Author helper function
include "php/func-author.php";
$authors = get_all_author($conn);

# Category helper function
include "php/func-category.php";
$categories = get_all_categories($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>E-Library System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- Bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <style>
        body {
            background: url('images/blue.jpg');
        }

        header {
            background-color: black;
            padding: 0px;
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

        .sp1 {
            color: orangered;
        }

        header a:hover {
            color: white;
        }

        #branding {
            float: left;
            color: white;
        }

        #showcase {
            min-height: 900px;
            background: url(images/register\ pic.jpeg);
            color: red;
            text-align: center;
            font-size: 90px;
            opacity: 0.9;
        }

        .Bodycontainer {
            overflow: hidden;
            margin: auto;
            width: 10%;
            background-color: red;
        }

        .containers {
            overflow: hidden;
            margin: auto;
            width: 90%;
        }

        #newsletter {
            background-color: gre;
        }

        .box {
            float: left;
            width: 10%;
            text-align: center;
            padding: 10px;
        }

        .box img {
            width: 55px;
        }

        .footer {
            margin: 20px;
            padding: 20px;
            background-color: orangered;
        }
    </style>
</head>

<body>
    <header>
        <div class="containers">
            <div id="branding" class="logo">
                <img src="images/9.png">
                <div>
                    <span class="sp1">IUT</span> E-Library System
                </div>
            </div>
            <nav class="navi">
                <ul>
                    <li><a href="admin_login.php">ADMIN-LOGIN</a></li>
                    <li><a href="user_login.php">USER-LOGIN</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="showcase">
        <div class="containers"></div>
    </section>

    <section id="newsletter">
        <div class="container">
            <h1 class="h"> 
                <form action="search_home.php" method="get" style="width: 100%; max-width: 30rem">
                    <div class="input-group my-5">
                        <input type="text" class="form-control" name="key" placeholder="Search Book..." aria-label="Search Book..." aria-describedby="basic-addon2">
                        <button class="input-group-text btn btn-primary"  id="basic-addon2">
                            <img src="img/search.png" width="20" style="background-color: black;">
                        </button>
                    </div>
                </form>
            </h1>
        </div>
    </section>

    <section id="boxes">
        <div class="container">
            <div class="row">
                <!-- Move the book list to the far left -->
                <div class="col-lg-8">
                    <div class="d-flex pt-3">
                        <?php if ($books == 0) { ?>
                            <div class="alert alert-warning text-center p-5" role="alert">
                                <img src="img/empty.png" width="100">
                                <br>
                                There is no book in the database
                            </div>
                        <?php } else { ?>
                            <div class="pdf-list d-flex flex-wrap">
                                <?php foreach ($books as $book) { ?>
                                    <div class="card m-1">
                                        <img height="200px"  src="uploads/cover/<?=$book['cover']?>" class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <?=$book['title']?>
                                            </h5>
                                            <p class="card-text">
                                                <i><b>By:
                                                    <?php foreach ($authors as $author) { 
                                                        if ($author['id'] == $book['author_id']) {
                                                            echo $author['name'];
                                                            break;
                                                        }
                                                    } ?>
                                                <br></b></i>

                                                <i><b>ISBN:
                                                    <?php foreach ($authors as $author) { 
                                                        if ($author['id'] == $book['author_id']) {
                                                            echo $book['id'];
                                                            break;
                                                        }
                                                    } ?>
                                                <br></b></i>

                                                <?=$book['description']?>
                                                <br><i><b>Category:
                                                    <?php foreach ($categories as $category) { 
                                                        if ($category['id'] == $book['category_id']) {
                                                            echo $category['name'];
                                                            break;
                                                        }
                                                    } ?>
                                                <br></b></i>
                                            </p>
                                            <a href="uploads/files/<?=$book['file2']?>" class="btn btn-success">View</a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <!-- Move the category and authors search lists to the far right -->
                <div class="col-lg-4">
                    <div class="category">
                        <!-- List of categories -->
                        <div class="list-group">
                            <?php if ($categories == 0) { /* do nothing */ } else { ?>
                                <a href="#" class="list-group-item list-group-item-action active">Category</a>
                                <?php foreach ($categories as $category) { ?>
                                    <a href="category_home.php?id=<?=$category['id']?>" class="list-group-item list-group-item-action">
                                        <?=$category['name']?>
                                    </a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <!-- List of authors -->
                        <div class="list-group mt-5">
                            <?php if ($authors == 0) { /* do nothing */ } else { ?>
                                <a href="#" class="list-group-item list-group-item-action active">Author</a>
                                <?php foreach ($authors as $author) { ?>
                                    <a href="author_home.php?id=<?=$author['id']?>" class="list-group-item list-group-item-action">
                                        <?=$author['name']?>
                                    </a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="newsletter">
        <div class="container">
			<br><br><br><br><br>
            <h1 class="h"> <a href="user_registration.php" style="color: green;"> Subscribe</a> for more details</h1>
       <br><br><br><br>
		</div>
    </section>

    <footer>
        <?php include "footer.php"; ?>
    </footer>
</body>
</html>
