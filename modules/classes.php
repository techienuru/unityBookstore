<?php
class index
{
    public $connect;

    public function __construct($connect)
    {
        $this->connect = $connect;
    }

    public function selectCategories()
    {
        $sql = $this->connect->query("SELECT * FROM `categories`");
        return $sql;
    }

    public function countCategoryBooks($category_id)
    {
        $sql = $this->connect->query("SELECT COUNT(books_id) AS noOfcategoryBook FROM `books` WHERE category_id = $category_id");
        return $sql;
    }

    public function selectBooks()
    {
        $sql = $this->connect->query("SELECT * FROM `books`");
        return $sql;
    }

    public function selectNewlyAdded()
    {
        $sql = $this->connect->query("SELECT * FROM `books` ORDER BY books_id DESC LIMIT 4");
        return $sql;
    }
}
class books extends index
{
    public $passedBookID;

    public function getPassedBookID()
    {
        $this->passedBookID = $_GET["books_id"];
    }

    public function selectPassedBook()
    {
        $sql = $this->connect->query("SELECT * FROM `books` INNER JOIN `categories` ON `books`.category_id = `categories`.category_id WHERE books_id = $this->passedBookID");
        return $sql;
    }
}

class wishlist extends index {}
class cart extends index
{
    public $user_id;
    public $noInCart;
    public $subTotal;
    public $overall_total;

    public function createUserID()
    {
        $cookie_name = "user_id";
        if (!isset($_COOKIE[$cookie_name])) {
            $this->user_id = bin2hex(random_bytes(5)); //Generates a random number (10 digits)

            //Create a cookie with the random number that expires in 6 months(i.e 30 * 6 = 360)
            setcookie($cookie_name, $this->user_id, time() + (86400 * 360), "/");
        } else {
            $this->user_id = $_COOKIE[$cookie_name];
        }
    }

    public function insertCart($books_id)
    {
        // Fetching price from Database
        $sql = $this->connect->query("SELECT * FROM `books` WHERE books_id = '$books_id'");
        $result = $sql->fetch_assoc();
        $price = $result["price"] - 350; //Discounting the price of the book

        $sql = $this->connect->query("INSERT INTO `cart` (user_id,books_id,quantity,total) VALUES ('$this->user_id',$books_id,1,$price)");

        if ($sql) {
            echo '
                <section class="container-fluid position-absolute js-success-message h-100" style="z-index: 99;background-color:#f3f4f5b0;">
                    <div class="d-flex justify-content-center align-items-center w-100 h-100">
                        <div class="alert alert-success">Added to Cart</div>
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
            // echo '
            //     <script>
            //         setTimeout(() => {
            //             window.location.href="index.php";
            //         },2000);
            //     </script>
            // ';
        } else {
            echo '
                <section class="container-fluid position-absolute js-success-message h-100" style="z-index: 99;background-color:#f3f4f5b0;">
                    <div class="d-flex justify-content-center align-items-center w-100 h-100">
                        <div class="alert alert-danger">Error While Inserting: ' . $this->connect->error . '</div>
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
        }
    }

    public function noInCart()
    {
        $sql = $this->connect->query("SELECT COUNT(cart_id) AS noInCart FROM `cart` WHERE user_id = '$this->user_id' AND status IS NULL");
        $result = $sql->fetch_assoc();
        $this->noInCart = $result["noInCart"] ?? 0;
    }

    public function selectCartItems()
    {
        $sql = $this->connect->query("SELECT * FROM `cart` INNER JOIN `books` ON `cart`.books_id = `books`.books_id WHERE `status` IS NULL");
        return $sql;
    }


    public function calcSubTotal()
    {
        $sql = $this->connect->query("SELECT SUM(total) AS subTotal FROM `cart` WHERE user_id = '$this->user_id' AND `status` IS NULL");
        $result = $sql->fetch_assoc();
        $this->subTotal = $result["subTotal"] ?? 0;
    }
    public function calcOverallTotal()
    {
        $this->overall_total = $this->subTotal + 100;
    }
}

class checkout extends index
{
    public function updateCartToPaid($user_id)
    {
        $sql = $this->connect->query("UPDATE `cart` SET status = 'paid' WHERE user_id = '$user_id' AND `status` IS NULL");
        return $sql;
    }
    public function acummulateBoughtBooksNumber($user_id)
    {
        $bought_books = 0;
        $sql = $this->connect->query("SELECT * FROM `cart` WHERE user_id = '$user_id' AND `status` IS NULL");
        while ($result = $sql->fetch_assoc()) {
            $books_id = $result['books_id'];
            $bought_books++;
        }
        return $bought_books;
    }

    public function selectBoughtBooks($user_id, $bought_books_number)
    {
        $sql = $this->connect->query("SELECT * FROM `cart` WHERE user_id = '$user_id' AND `status` = 'paid' ORDER BY cart_id DESC LIMIT $bought_books_number");
        return $sql;
    }
}
