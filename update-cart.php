<?php
include_once "include/connect.php";

if (isset($_GET["cart_id"])) {
    $cart_id = $_GET["cart_id"];
    $quantity = $_GET["quantity"];
    $total = $_GET["total"];

    $sql = $connect->query("UPDATE `cart` SET quantity = $quantity,total = $total WHERE cart_id = $cart_id");

    if ($sql) {
        header("location:cart");
    } else {
        echo '
            <script>
                window.alert("' . $connect->error . '");
                window.location.href="./cart";
            </script>
        ';
    }
}
