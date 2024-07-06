<?php
include_once "include/connect.php";
include_once "modules/classes.php";

// Creating an instance (object) of checkoot
$checkout = new checkout($connect);

// Declaring null variables 
$user_id;
$bought_books_number;

if (isset($_GET["bought_books_number"])) {
    $user_id = $_GET["user_id"];
    $bought_books_number = $_GET["bought_books_number"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unity Bookshop | Payment Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="./Bootstrap/bootstrap.css">
</head>

<body>
    <!-- 404 Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row vh-100 bg-warning rounded align-items-center justify-content-center mx-0">
            <div class="col-md-6 text-center p-4">
                <i class="bi bi-check-circle display-1 text-primary"></i>
                <h1 class="mb-4">Payment Successful</h1>
                <p class="">Thank you for your purchase! Your payment was successful.</p>
                <p class="">Click on the links below to download your soft copy.</p>
                <div class="mb-4 d-flex justify-content-center">
                    <?php
                    if (isset($_GET["bought_books_number"])) {
                        $sql = $checkout->selectBoughtBooks($user_id, $bought_books_number);

                        while ($result = $sql->fetch_assoc()) {
                            $books_id = $result["books_id"];
                            // FETCHING SOFT COPY LINK
                            $select_link = $checkout->connect->query("SELECT * FROM `soft_copy` INNER JOIN `books` ON `soft_copy`.books_id = `books`.books_id WHERE `soft_copy`.books_id = $books_id");
                            $fetch_link = $select_link->fetch_assoc();
                            $soft_copy_link = $fetch_link["location"];
                            $soft_copy_title = $fetch_link["title"];

                            echo '
                            <a href="./admin/pages/' . $soft_copy_link . '" class="me-3" download="">
                                ' . $soft_copy_title . '
                            </a>
                        ';
                        }
                    }
                    ?>
                </div>
                <a class="btn btn-primary rounded-pill py-3 px-5" href="./">Return to Home</a>
            </div>
        </div>
    </div>
    <!-- 404 End -->

</body>

</html>