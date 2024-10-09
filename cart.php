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
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Unity Bookshop - Your Cart</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="./img/logo-yellow.png" rel="icon">

    <!-- Font Awesome -->
    <link href="./fontawesome/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center justify-content-between bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="./" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Unity</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">BookShop</span>
                </a>
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
                    <a class="breadcrumb-item text-dark" href="./">Home</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        $sql = $cart->selectCartItems();
                        while ($result = $sql->fetch_assoc()) {
                            $cart_id = $result['cart_id'];
                            $user_id = $result['user_id'];
                            $books_id = $result['books_id'];
                            $title = $result['title'];
                            $price = $result['price'] - 350;
                            $quantity = $result['quantity'];
                            $total = $result['total'];

                            echo '
                                <tr>
                                    <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;">' . $title . '</td>
                                    <td class="align-middle js-price-value-' . $cart_id . '">$' . $price . '</td>
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-minus js-minus-quantity" data-cart-id="' . $cart_id . '">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center js-quantity-value-' . $cart_id . '" value="' . $quantity . '">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-plus js-plus-quantity" data-cart-id="' . $cart_id . '">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle js-total-value-' . $cart_id . '">$' . $total . '</td>
                                    <td class="align-middle">
                                        <a class="btn btn-sm btn-success js-update-quantity" title="Update Quantity" data-cart-id="' . $cart_id . '">
                                            <i class="fa fa-check" ></i>
                                        </a>
                                        <a class="btn btn-sm btn-danger js-remove" title="Remove" data-cart-id="' . $cart_id . '">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                                    ';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>
                                $<?php $cart->calcsubTotal();
                                    echo $cart->subTotal; ?>
                            </h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Commission</h6>
                            <h6 class="font-weight-medium">$100</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>
                                $<?php $cart->calcOverallTotal();
                                    echo $cart->overall_total; ?>
                            </h5>
                        </div>
                        <!-- Book For Pickup Modal Button -->
                        <a href="./checkout" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</a>
                        <button data-bs-target="#book-for-pickup" data-bs-toggle="modal" class="btn btn-block btn-secondary font-weight-bold my-3 py-3">Book For Pickup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

    <!-- Book For Pickup Modal Form Start -->
    <div class="modal fade" id="book-for-pickup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="book-for-pickup" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Confirm Details For Pickup</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="./book-for-pickup" method="post">

                        <input type="hidden" class="form-control" name="user_id" value="<?php echo $cart->user_id ?>" readonly>

                        <div class="form-group mb-3">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="first_name" placeholder="Your First name..." required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="last_name" placeholder="Your Last name..." required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="example@gmail.com" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Mobile Number</label>
                            <input type="text" class="form-control" name="phone_number" placeholder="+123 45 678 9" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" placeholder="Your home address..." required>
                        </div>


                </div>

                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-warning">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Book For Pickup Modal Form End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5" style="background-image: url(./img/footer_pattern.png)">
        <div class="row mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">2024</a>. All Rights Reserved.
                    <br>Distributed By: <a href="#" target="_blank">Ibrahim Nurudeen Shehu</a>
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

    <!-- Custom Javascript -->
    <script type="module" src="./js/custom.js"></script>
    <script src="./modules/cart.js"></script>


</body>

</html>