<?php
include_once "include/connect.php";
include_once "modules/classes.php";

$books = new books($connect);

// Creating an instance of Cart Class
$cart = new cart($connect);

// Add To Cart Section
$cart->createUserID();
$cart->noInCart();


if (isset($_GET["add_to_cart"])) {
    $user_id = $cart->user_id;
    $books_id = $_GET["add_to_cart"];

    $isBookInCart = $connect->query("SELECT * FROM `cart` WHERE user_id = '$user_id' AND books_id = $books_id AND `status` IS NULL");

    if ($isBookInCart->num_rows > 0) {
        echo '
            <section class="container-fluid position-absolute js-success-message h-100" style="z-index: 99;background-color:#f3f4f5b0;">
                <div class="d-flex justify-content-center align-items-center w-100 h-100">
                    <div class="alert alert-danger">Book already in Cart</div>
                </div>
            </section>
    ';
        echo '
            <script>
                setTimeout(() => {
                    document.querySelector(".js-success-message").style.display = "none";
                },1500);
            </script>
    ';
    } else {
        $cart->insertCart($books_id);
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="./fontawesome/css/all.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="./index" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Unity</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">BookShop</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search Book">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Customer Service</p>
                <h5 class="m-0">+012 345 6789</h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid mb-30" style="background-image: url(./img/footer_pattern.png)">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-bs-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        <?php
                        $sql = $books->selectCategories();
                        while ($result = $sql->fetch_assoc()) {
                            $category_id = $result['category_id'];
                            $category_name = $result['category_name'];
                            $category_description = $result['category_description'];
                            echo '
                            <a class="nav-item nav-link">' . $category_name . '</a>
                          ';
                        }
                        ?>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg  navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Unity</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">BookShop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="./" class="nav-item nav-link active">Home</a>
                            <a href="./admin/admin-login" class="nav-item nav-link">Admin Login</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-lg-block">
                            <a href="./wishlist" class="btn px-0" title="Wishlist">
                                <i class="fas fa-heart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle js-wishlist-content" style="padding-bottom: 2px;">0</span>
                            </a>
                            <a href="./cart" class="btn px-0 ml-3" title="Cart">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;"><?php echo $cart->noInCart; ?></span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="./index">Home</a>
                    <span class="breadcrumb-item active">Book Details</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <?php
        $books->getPassedBookID();
        $sql = $books->selectPassedBook();
        while ($result = $sql->fetch_assoc()) {
            $books_id = $result['books_id'];
            $title = $result['title'];
            $author = $result['author'];
            $description = $result['description'];
            $price = $result['price'];
            $discounted_price = $price - 350;
            $image = $result['image'];
            $category_id = $result['category_id'];
            $category_name = $result['category_name'];
            echo '
                        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <img class="w-100 h-100" src="admin/pages/' . $image . '" alt="Image">
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>' . $title . '</h3>
                    <small class="pt-1">' . $category_name . '</small>
                    <div class="d-flex">
                        <h3 class="font-weight-semi-bold mt-2">$' . $discounted_price . '</h3>
                        <small class="mb-4 mt-2"><del>$' . $price . '</del></small>
                    </div>
                    <p class="mb-4">' . $description . '</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <a class="btn btn-primary px-3" href="./books?books_id=' . $books_id . '&add_to_cart=' . $books_id . '">
                            <i class="fa fa-shopping-cart mr-1"></i>
                            Add To Cart
                        </a>
                    </div>
                </div>
            </div>
        </div>
                          ';
        }
        ?>
    </div>
    <!-- Shop Detail End -->

    <!-- Footer Start -->
    <div class="container-fluid text-secondary mt-5 pt-5" style="background-image: url(./img/footer_pattern.png)">
        <div class="row mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; 2024. All Rights Reserved.
                    <br>Designed By: <a href="#" target="_blank">Ibrahim Nurudeen Shehu</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>

    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="./Bootstrap/bootstrap.bundle.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script type="module" src="./js/custom.js"></script>
</body>

</html>