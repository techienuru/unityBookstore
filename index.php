<?php
include_once "include/connect.php";
include_once "modules/classes.php";

// Creating an instance of Index Class
$index = new index($connect);

// Creating an instance of Cart Class
$cart = new cart($connect);

// Add To Cart Section
$cart->createUserID();
$cart->noInCart();

// If a user add book to cart
if (isset($_GET["add_to_cart"])) {
    $user_id = $cart->user_id;
    $books_id = $_GET["add_to_cart"];

    // Checking if book is already in cart
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
    <title>Unity Bookshop - Best collections of Books</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="./img/logo-yellow.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">

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
                <a href="" class="text-decoration-none">
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
                        $sql = $index->selectCategories();
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
                            <a href="#categories" class="nav-item nav-link">Categories</a>
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


    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#header-carousel" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#header-carousel" data-bs-slide-to="1"></li>
                <li data-bs-target="#header-carousel" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item position-relative active" style="height: 430px;">
                    <img class="position-absolute w-100 h-100" src="img/carousel-1.jpg" style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 700px;">
                            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Welcome</h1>
                            <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Enjoy thousands of books from the comfort of your home</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#Featured-books">Explore Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item position-relative" style="height: 430px;">
                    <img class="position-absolute w-100 h-100" src="img/carousel-2.jpg" style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 700px;">
                            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Did you know?</h1>
                            <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Every reader has a story to tell. Let us help you find the books that will make you laugh, cry and dream big.</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#Featured-books">Explore Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item position-relative" style="height: 430px;">
                    <img class="position-absolute w-100 h-100" src="img/carousel-3.jpg" style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 700px;">
                            <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">A Reader's Wisdom</h1>
                            <p class="mx-md-5 px-5 animate__animated animate__bounceIn">If you don't like to read, you haven't found the right book</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#Featured-books">Explore Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Categories Start -->
    <div class="container-fluid pt-5" id="categories">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Categories</span></h2>
        <div class="row px-xl-5 pb-3">
            <?php
            $sql = $index->selectCategories();
            while ($result = $sql->fetch_assoc()) {
                $category_id = $result['category_id'];
                $category_name = $result['category_name'];
                $category_description = $result['category_description'];

                $fetchNoOfBooks = $index->countCategoryBooks($category_id);
                $result = $fetchNoOfBooks->fetch_assoc();
                $noOfBooks = $result["noOfcategoryBook"];

                echo '
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none">
                    <div class="cat-item d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 100px; height: 100px;">
                            <img class="img-fluid" src="img/Category_2.jpg" alt="">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6>' . $category_name . '</h6>
                            <small class="text-body">' . $noOfBooks . ' Books</small>
                        </div>
                    </div>
                </a>
                </div>
                          ';
            }
            ?>
        </div>
    </div>
    <!-- Categories End -->

    <!-- Newly Added Start -->
    <!-- <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">NEWLY ADDED</span></h2>
        <div class="row px-xl-5">
            <?php
            // $sql = $index->selectNewlyAdded();
            // while ($result = $sql->fetch_assoc()) {
            //     $books_id = $result['books_id'];
            //     $title = $result['title'];
            //     $author = $result['author'];
            //     $description = $result['description'];
            //     $price = $result['price'];
            //     $discounted_price = $price - 350;
            //     $image = $result['image'];
            //     $category_id = $result['category_id'];
            //     echo '
            //         <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            //             <div class="product-item bg-light mb-4">
            //                 <div class="product-img position-relative overflow-hidden" style="height: 300px;">
            //                     <img class="w-100 h-100 img-fluid" src="admin/pages/' . $image . '" alt="" style="object-fit: cover;">
            //                     <div class="product-action">
            //                         <button class="btn btn-outline-dark btn-square"  title="Add to wishlist">
            //                             <i class="far fa-heart"></i>
            //                         </button>
            //                         <a class="btn btn-outline-dark btn-square" href="./?add_to_cart=' . $books_id . '">
            //                             <i class="fa fa-shopping-cart" title="Add to cart"></i>
            //                         </a>
            //                     </div>
            //                 </div>
            //                 <div class="text-center py-4" style="height: 150px;">
            //                     <a class="h6 text-decoration-none text-wrap" href="./books?books_id=' . $books_id . '">' . $title . '</a>
            //                     <br>
            //                     <small class="badge badge-primary">By ' . $author . '</small>
            //                     <div class="d-flex align-items-center justify-content-center mt-2">
            //                         <h5>$' . $discounted_price . '</h5>
            //                         <h6 class="text-muted ml-2"><del>$' . $price . '</del></h6>
            //                     </div>
            //                 </div>
            //             </div>
            //         </div>
            //         ';
            // }
            // 
            ?>
        </div>
    </div> -->
    <!-- Newly Added End -->


    <!-- FOR YOU Start -->
    <div class="container-fluid pt-5 pb-3 position-relative">
        <!-- Success Message For wishlist and Cart -->
        <div class="position-absolute js-success-message" style="top: 50%; right:50%;z-index:1;"></div>
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
            <span class="bg-secondary pr-3">For You</span>
        </h2>
        <div class="row px-xl-5">
            <?php
            $sql = $index->selectBooks();
            while ($result = $sql->fetch_assoc()) {
                $books_id = $result['books_id'];
                $title = $result['title'];
                $author = $result['author'];
                $description = $result['description'];
                $price = $result['price'];
                $discounted_price = $price - 350;
                $image = $result['image'];
                $category_id = $result['category_id'];
                echo '
                    <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden" style="height: 300px;">
                                <img class="w-100 h-100 img-fluid" src="admin/pages/' . $image . '" alt="" style="object-fit: cover;">
                                <div class="product-action">
                                    <button class="btn btn-outline-dark btn-square js-add-to-wishlist"  title="Add to wishlist" data-add-to-wishlist-id="' . $books_id . '" data-add-to-wishlist-title="' . $title . '" data-add-to-wishlist-author="' . $author . '" data-add-to-wishlist-image="' . $image . '" data-add-to-wishlist-price="' . $price . '">
                                        <i class="far fa-heart js-icon-' . $books_id . '"></i>
                                    </button>
                                    <a class="btn btn-outline-dark btn-square" href="./?add_to_cart=' . $books_id . '">
                                        <i class="fa fa-shopping-cart" title="Add to cart"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="text-center py-4" style="height: 150px;">
                                <a class="h6 text-decoration-none text-wrap" href="./books?books_id=' . $books_id . '">' . $title . '</a>
                                <br>
                                <small class="badge badge-primary">By ' . $author . '</small>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>$' . $discounted_price . '</h5>
                                    <h6 class="text-muted ml-2"><del>$' . $price . '</del></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
            }
            ?>
        </div>
    </div>
    <!-- For You End -->



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

    <!-- JavaScript Libraries -->
    <script src="./Bootstrap/bootstrap.bundle.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script type="module" src="./js/custom.js"></script>
</body>

</html>