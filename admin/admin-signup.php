<?php
session_start();
include_once "../include/connect.php";

class signup
{
    public $connect;
    public $firstname;
    public $lastname;
    public $username;
    public $email;
    public $password;


    public $username_err;
    public $email_err;

    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    public function __destruct()
    {
        $this->connect->close();
    }


    public function collectInputs()
    {
        $this->firstname = htmlspecialchars($_POST['firstname']);
        $this->lastname = htmlspecialchars($_POST['lastname']);
        $this->username = htmlspecialchars($_POST['username']);
        $this->email = htmlspecialchars($_POST['email']);
        $this->password = htmlspecialchars($_POST['password']);
    }


    public function checkUsername()
    {
        $sql = $this->connect->query("SELECT * FROM `admin` WHERE username = '$this->username'");

        if ($sql->num_rows > 0) {
            $this->username_err = 'Username already exist';
            return false;
        } else {
            return true;
        }
    }

    public function checkEmail()
    {
        $sql = $this->connect->query("SELECT * FROM `admin` WHERE email = '$this->email'");

        if ($sql->num_rows > 0) {
            $this->email_err = 'Email already exist';
            return false;
        } else {
            return true;
        }
    }

    public function hashPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function addToDB()
    {
        $sql = $this->connect->query("INSERT INTO `admin` (firstname,lastname,username,email,password) VALUES('$this->firstname','$this->lastname','$this->username','$this->email','$this->password')");
        return $sql;
    }
}
$signup = new signup($connect);


if (isset($_POST["submit"])) {

    $signup->collectInputs();

    $isUsernameValid = $signup->checkUsername();
    $isEmailValid = $signup->checkEmail();

    if ($isUsernameValid && $isEmailValid) {

        $signup->hashPassword();

        $sql = $signup->addToDB();

        if ($sql) {
            echo '
            <div class="position-absolute w-100 h-100 bg-dark z-1 js-success-message">
                <div class="d-flex w-100 h-100 justify-content-center align-items-center">
                    <img src="../img/thumbs_up.png" alt="Success thumbs up" class="img-fluid">
                </div>
            </div>
        ';
            echo '
            <script>
                document.querySelector(".js-success-message").style.display = "block";
                setTimeout(() => {
                    window.location.href = "./admin-login";
                }, 2500);
            </script>
        ';
        } else {
            echo '
            <script>
                window.alert(`Error while inserting into DB\nThe error Message is: ' . $connect->error . '`);
            </script>
        ';
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unity Bookshop - Create an account as an Admin</title>

    <!-- Font Awesome -->
    <link href="./fontawesome/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./Bootstrap/bootstrap.css">

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="./style.css">

    <style>

    </style>
</head>

<body id="admin-signup">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-md py-3 px-0 navbar-dark" id="navbar">
        <div class="container">
            <a href="../" class="text-decoration-none d-block">
                <span class="h1 text-uppercase text-light px-2">Unity</span>
                <span class="h1 text-uppercase text-light">BookShop</span>
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav py-0 ms-auto">
                    <a href="../" class="nav-item nav-link active">Home</a>
                    <a href="./admin-login" class="nav-item nav-link">Admin Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Navbar End -->

    <!-- Login Section Start -->
    <section id="login-section">
        <div class="container text-white py-5">
            <div class="d-flex justify-content-center align-items-center h-100 my-5">
                <div id="signup-wrapper">
                    <div class="bg-white p-5">
                        <h5 class="mb-4">Create an account</h5>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="js-form">
                            <div class="d-block d-md-flex mb-3">
                                <div class="me-md-5 js-firstname">
                                    <input type="text" name="firstname" class="form-control rounded-0 mb-3 mb-md-0 p-3 " placeholder="First Name" required>
                                    <small class="text-danger"></small>
                                </div>
                                <div class="js-lastname">
                                    <input type="text" name="lastname" class="form-control rounded-0 p-3" placeholder="Last Name" required>
                                    <small class="text-danger"></small>
                                </div>
                            </div>

                            <div class="d-block d-md-flex mb-3">
                                <div class="mb-md-0 me-5 js-username">
                                    <input type="text" name="username" class="form-control rounded-0 p-3" placeholder="Username" required>
                                    <small class="text-danger"><?php echo $signup->username_err ?></small>
                                </div>
                                <div class="js-email">
                                    <input type="email" name="email" class="form-control rounded-0 p-3" placeholder="Email address" required>
                                    <small class="text-danger"><?php echo $signup->email_err ?></small>
                                </div>
                            </div>

                            <div class="d-block d-md-flex mb-3">
                                <div class="mb-md-0 me-5 js-password">
                                    <input type="password" name="password" class="form-control rounded-0 p-3" placeholder="Password" required>
                                    <small class="text-danger"></small>
                                </div>
                                <div class="js-cpassword">
                                    <input type="password" name="cpassword" class="form-control rounded-0 p-3" placeholder="Confirm Password" required>
                                    <small class="text-danger"></small>
                                </div>
                            </div>


                            <input type="submit" name="submit" class="w-100 py-2 fs-5 border-0 bg-warning text-white" value="Login">
                        </form>
                    </div>
                    <div class="footer bg-secondary text-center pt-3 pb-2 align-items-center">
                        <p>
                            Already have an account?
                            <a href="./admin-login" class="text-decoration-none">Login</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Section End -->

    <!-- Footer Start -->
    <footer id="footer-section">
        <div class="container">
            <div class="row p-4">
                <div class="col-sm-6 px-xl-0 text-center text-sm-start">
                    <p class="mb-md-0  text-light">
                        &copy; 2024. All Rights Reserved.
                        <br>Designed By: <a href="#" class="text-decoration-none text-warning">Ibrahim Nurudeen Shehu</a>
                    </p>
                </div>
                <div class="col-sm-6 px-xl-0 text-center text-sm-end">
                    <img class="img-fluid" src="../img/payments.png" alt="">
                </div>
            </div>
        </div>

    </footer>
    <!-- Footer End -->


    <!-- Boostrap Javascript -->
    <script src="./Bootstrap/bootstrap.bundle.min.js"></script>
    <!-- Custom Javascript -->
    <script src="./custom.js"></script>
</body>

</html>