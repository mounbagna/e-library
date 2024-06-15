<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    include "../db_conn.php";
    include "func-validation.php";
    include "func-file-upload.php";

    if (
        isset($_POST['id']) &&
        isset($_POST['book_title']) &&
        isset($_POST['book_description']) &&
        isset($_POST['book_author']) &&
        isset($_POST['book_category']) &&
        isset($_FILES['book_cover']) &&
        isset($_FILES['file']) &&
        isset($_FILES['file2'])
    ) {
        $id = $_POST['id'];
        $title = $_POST['book_title'];
        $description = $_POST['book_description'];
        $author = $_POST['book_author'];
        $category = $_POST['book_category'];

        $user_input = "&id=$id&title=$title&category_id=$category&desc=$description&author_id=$author";

        $text = "book id";
        $location = "../add-book.php";
        $ms = "error";
        is_empty($id, $text, $location, $ms, $user_input);

        $text = "Book title";
        is_empty($title, $text, $location, $ms, $user_input);

        $text = "Book description";
        is_empty($description, $text, $location, $ms, $user_input);

        $text = "Book author";
        is_empty($author, $text, $location, $ms, $user_input);

        $text = "Book category";
        is_empty($category, $text, $location, $ms, $user_input);

        // Check if the book ID already exists in the database
        $check_id_query = "SELECT * FROM books WHERE id = :id";
        $check_id_stmt = $conn->prepare($check_id_query);
        $check_id_stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $check_id_stmt->execute();
        $check_id_result = $check_id_stmt->fetch();

        // Check if the cover picture name already exists in the database
        $cover_name = $_FILES['book_cover']['name'];
        $check_cover_query = "SELECT * FROM books WHERE cover = :cover";
        $check_cover_stmt = $conn->prepare($check_cover_query);
        $check_cover_stmt->bindParam(':cover', $cover_name, PDO::PARAM_STR);
        $check_cover_stmt->execute();
        $check_cover_result = $check_cover_stmt->fetch();

        // Check if the file name already exists in the database
        $file_name = $_FILES['file']['name'];
        $check_file_query = "SELECT * FROM books WHERE file = :file";
        $check_file_stmt = $conn->prepare($check_file_query);
        $check_file_stmt->bindParam(':file', $file_name, PDO::PARAM_STR);
        $check_file_stmt->execute();
        $check_file_result = $check_file_stmt->fetch();

        if ($check_id_result) {
            header("Location: ../add-book.php?error=Book ID already exists&$user_input");
            exit;
        }

        if ($check_cover_result) {
            header("Location: ../add-book.php?error=Cover picture already exists in the database&$user_input");
            exit;
        }

        if ($check_file_result) {
            header("Location: ../add-book.php?error=File already exists in the database&$user_input");
            exit;
        }

        $allowed_image_exs = array("jpg", "jpeg", "png");
        $path = "cover";
        $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs, $path);

        if ($book_cover['status'] == "error") {
            $em = $book_cover['data'];
            header("Location: ../add-book.php?error=$em&$user_input");
            exit;
        } else {
            $allowed_file_exs = array("pdf", "docx", "pptx");
            $path = "files";
            $file = upload_file($_FILES['file'], $allowed_file_exs, $path);
            $file2 = upload_file($_FILES['file2'], $allowed_file_exs, $path);

            if ($file['status'] == "error" || $file2['status'] == "error") {
                $em = $file['data'];
                header("Location: ../add-book.php?error=$em&$user_input");
                exit;
            } else {
                $file_URL = $file['data'];
                $file2_URL = $file2['data'];
                $book_cover_URL = $book_cover['data'];

                // Check for duplicate cover picture and file in the database again
                $check_cover_query = "SELECT * FROM books WHERE cover = :cover";
                $check_file_query = "SELECT * FROM books WHERE file = :file";

                $check_cover_stmt = $conn->prepare($check_cover_query);
                $check_file_stmt = $conn->prepare($check_file_query);

                $check_cover_stmt->bindParam(':cover', $book_cover_URL, PDO::PARAM_STR);
                $check_file_stmt->bindParam(':file', $file_URL, PDO::PARAM_STR);

                $check_cover_stmt->execute();
                $check_file_stmt->execute();

                $check_cover_result = $check_cover_stmt->fetch();
                $check_file_result = $check_file_stmt->fetch();

                if ($check_cover_result) {
                    header("Location: ../add-book.php?error=Cover picture already exists in the database&$user_input");
                    exit;
                }

                if ($check_file_result) {
                    header("Location: ../add-book.php?error=File already exists in the database&$user_input");
                    exit;
                }

                $sql = "INSERT INTO books (id, title, author_id, description, category_id, cover, file, file2) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $res = $stmt->execute([$id, $title, $author, $description, $category, $book_cover_URL, $file_URL, $file2_URL]);

                if ($res) {
                    $sm = "The book was successfully created!";
                    header("Location: ../add-book.php?success=$sm");
                    exit;
                } else {
                    $em = "Unknown Error Occurred!";
                    header("Location: ../add-book.php?error=$em");
                    exit;
                }
            }
        }
    } else {
        $em = "Unknown Error Occurred!";
        header("Location: ../add-book.php?error=$em");
        exit;
    }
}
?>
