<?php
include_once "include/connect.php";
include_once "modules/classes.php";


// Creating an instance (Object) of Checkout Class that inherits index class
$checkout = new checkout($connect);

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
    <title>Unity Bookshop - Proceed with Payment</title>
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
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Bookshop</span>
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
                        $sql = $checkout->selectCategories();
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
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Checkout Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Payment Details</span>
                </h5>
                <div class="bg-light p-30 mb-5">
                    <form id="paymentForm">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>First Name</label>
                                <input class="form-control" type="text" placeholder="John">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Last Name</label>
                                <input class="form-control" type="text" placeholder="Doe">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input class="form-control" type="text" placeholder="example@email.com" id="email-address" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mobile No</label>
                                <input class="form-control" type="text" placeholder="+123 456 789" id="number" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Country</label>
                                <input class="form-control" type="text" placeholder="United State">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>City</label>
                                <input class="form-control" type="text" placeholder="New York">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>State</label>
                                <input class="form-control" type="text" placeholder="New York">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>ZIP Code</label>
                                <input class="form-control" type="text" placeholder="123">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary font-weight-bold py-3" onclick="payWithPaystack()">Make Payment</button>
                    </form>
                </div>

            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Books</h6>
                        <?php
                        $sql = $cart->selectCartItems();
                        while ($result = $sql->fetch_assoc()) {

                            $cart_id = $result['cart_id'];
                            $user_id = $result['user_id'];
                            $books_id = $result['books_id'];
                            $title = $result['title'];
                            $price = $result['price'] - 350;
                            $quantity = $result['quantity'];
                            $price *=  $quantity;
                            $total = $result['total'];
                            echo '
                              <div class="d-flex justify-content-between">
                                <p>' . $title . '</p>
                                <p>$' . $price . '</p>
                              </div>     
                                    ';
                        }
                        ?>
                    </div>
                    <div class="border-bottom pt-3 pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>
                                $
                                <?php
                                $cart->calcSubTotal();
                                echo $cart->subTotal;
                                ?>
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
                                $
                                <?php
                                $cart->calcOverallTotal();
                                echo $cart->overall_total;
                                ?>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->


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


    <!-- Paystack Payment Javascript -->
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script type="text/javascript">
        const paymentForm = document.getElementById('paymentForm');
        paymentForm.addEventListener("submit", payWithPaystack, false);

        function payWithPaystack(e) {
            e.preventDefault();

            let handler = PaystackPop.setup({
                key: 'pk_live_5aefd76fe6e2b8e35a2deaedbb21e3a327f83104', // Replace with your public key
                // The test version for the public key => pk_test_0ef3736ce22ed6482bcd914a119c8a06e349f46a
                // The real Public key => pk_live_5aefd76fe6e2b8e35a2deaedbb21e3a327f83104
                email: document.getElementById("email-address").value,
                amount: <?php echo $cart->overall_total; ?> * 100,
                // ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                // label: "Optional string that replaces customer email"

                onClose: function() {
                    alert('Window closed.');
                },

                callback: function(response) {
                    //this happens after the payment is completed successfully
                    let reference = response.reference;
                    alert('Payment complete! Transaction Reference: ' + reference);
                    window.location.href = `verify_payment.php?reference=${reference}&email=${document.getElementById("email-address").value}&number=${document.getElementById("number").value}&user_id=<?php echo $cart->user_id; ?>`;
                    // The above redirects to the server with the reference to verify the transaction
                }
            });

            handler.openIframe();
        }
    </script>

    <!-- JavaScript Libraries -->
    <script src="./Bootstrap/bootstrap.bundle.min.js"></script>

    <!-- JavaScript Libraries -->
    <script src="./Bootstrap/bootstrap.bundle.min.js"></script>

    <!-- Custom Javascript -->
    <script type="module" src="./js/custom.js"></script>
</body>

</html>