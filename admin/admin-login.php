<?php
session_start();
include_once "../include/connect.php";

class login
{
    public $connect;
    public $username_email;
    public $password;

    public $username_email_err;
    public $password_err;

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
        $this->username_email = htmlspecialchars($_POST['username_email']);
        $this->password = htmlspecialchars($_POST['password']);
    }

    public function checkUsernameEmail()
    {
        $sql = $this->connect->query("SELECT * FROM `admin` WHERE username = '$this->username_email' OR email = '$this->username_email'");

        if ($sql->num_rows > 0) {
            return true;
        } else {
            $this->username_email_err = 'Username/Email doesn\'t exist!';
            return false;
        }
    }

    public function checkPassword()
    {
        $sql = $this->connect->query("SELECT * FROM `admin` WHERE email = '$this->username_email' OR username = '$this->username_email'");
        $result = $sql->fetch_assoc();
        $password = $result['password'];

        if (password_verify($this->password, $password)) {
            return true;
        } else {
            $this->password_err = 'Incorrect Password';
            return false;
        }
    }

    public function createSession()
    {
        $sql = $this->connect->query("SELECT * FROM `admin` WHERE email = '$this->username_email' OR username = '$this->username_email'");
        $result = $sql->fetch_assoc();
        $admin_id = $result['admin_id'];
        $_SESSION["admin_id"] = $admin_id;
    }

    public function redirection()
    {
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
                    window.location.href = "./pages/dashboard";
                }, 2500);
            </script>
        ';
    }
}
$login = new login($connect);

if (isset($_POST["submit"])) {
    $login->collectInputs();

    $isUsernameEmailValid = $login->checkUsernameEmail();

    if ($isUsernameEmailValid) {
        $isPasswordCorrect = $login->checkPassword();

        if ($isPasswordCorrect) {
            $login->createSession();
            $login->redirection();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unity Bookshop - Login as an Admin</title>

    <!-- Font Awesome -->
    <link href="./fontawesome/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./Bootstrap/bootstrap.css">

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="./style.css">

</head>

<body id="admin-login">
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
                <div id="login-wrapper">
                    <div class="bg-white p-5">
                        <h5 class="mb-4">Login to your account</h5>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="mb-3">
                                <input type="text" name="username_email" class="form-control rounded-0 p-3 shadow-none" placeholder="Username or Email" required>
                                <small class="text-danger"><?php echo $login->username_email_err; ?></small>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control rounded-0 p-3 shadow-none" placeholder="Password" required>
                                <small class="text-danger"><?php echo $login->password_err; ?></small>
                            </div>

                            <input type="submit" name="submit" class="w-100 py-2 fs-5 border-0 bg-warning text-white" value="Login">
                        </form>
                    </div>
                    <div class="footer bg-secondary text-center pt-3 pb-2 align-items-center">
                        <p>
                            Not registered?
                            <a href="./admin-signup" class="text-decoration-none">Create an account</a>
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
                        <br>Designed By: <a href="#" class="text-decoration-none text-warning" target="_blank">Ibrahim Nurudeen Shehu</a>
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
</body>

</html>