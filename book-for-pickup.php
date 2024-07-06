<?php
include_once "include/connect.php";

if (isset($_POST["submit"])) {
    $user_id = $_POST["user_id"];

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $address = $_POST["address"];

    // // Insert into `pickup` table
    $insert_into_pickup = $connect->query("INSERT INTO `pickup` (user_id,first_name,last_name,email,phone,address) VALUES ('$user_id','$first_name','$last_name','$email','$phone_number','$address')");

    // Selecting the just inserted pickup from `pickup` table
    $select_pickup_id = $connect->query("SELECT * FROM `pickup` ORDER BY pickup_id DESC LIMIT 1");
    $fetch_pickup_id = $select_pickup_id->fetch_assoc();
    $last_inserted_pickup_id = $fetch_pickup_id["pickup_id"];


    // Update `cart` table's status (to 'Pickup') and pickup_id to the just collected pickup_id
    $update_cart_status = $connect->query("UPDATE `cart` SET `status` = 'Pickup', pickup_id = $last_inserted_pickup_id WHERE user_id = '$user_id' AND `status` IS NULL");


    if ($insert_into_pickup && $update_cart_status) {
        echo '
            <script>
                window.alert("Books booked for pickup successfully!\n\nRemember that you will need to visit the bookstore to pick up your items.");
                window.location.href="./cart";
            </script>
        ';
        die();
    } else {
        echo '
            <script>
                window.alert("' . $connect->error . '");
                window.location.href="./cart";
            </script>
        ';
        die();
    }
}
