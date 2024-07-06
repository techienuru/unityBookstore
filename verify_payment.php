<?php
include_once "include/connect.php";
include_once "modules/classes.php";

$cart = new cart($connect);
$checkout = new checkout($connect);

if (isset($_GET['reference'])) {
    $reference = $_GET['reference'];

    // Set your secret key
    $secret_key = 'sk_test_72c230c556febf7e85bacb4f7dc4005ddf231c2f';

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $reference,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer " . $secret_key,
            "Content-Type: application/json",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        // Handle error
        echo '
        <script>
            alert("cURL Error #: ' . $err . '");
            window.location.href="./payment-error";
        </script>
        ';
        die();
    } else {
        $result = json_decode($response, true);

        if ($result['status'] && $result['data']['status'] == 'success') {
            // Payment was successful
            // Save order details to the database
            echo "<p>Payment successful. Thank you for your purchase!</p>";
        } else {
            // Payment failed
            header("location:payment-error");
        }
    }
} else {
    // No reference found
    echo "<p>No reference found.</p>";
    die();
}





if ($result['status'] && $result['data']['status'] == 'success') {
    // If Payment was successful
    $user_id = htmlspecialchars($_GET['user_id']);
    $email = htmlspecialchars($_GET['email']);
    $number = htmlspecialchars($_GET['number']);

    $sql = "INSERT INTO orders (user_id,email,phone, payment_reference) VALUES ('$user_id','$email','$number','$reference')";

    if ($connect->query($sql) === TRUE) {
        // Collecting Bought book numbers
        $bought_books_number = $checkout->acummulateBoughtBooksNumber($user_id);
        // Empty Cart
        // Update Cart status to "paid"
        $checkout->updateCartToPaid($user_id);
        header("location:payment-success?user_id=$user_id&bought_books_number=$bought_books_number");
    } else {
        echo '
            <script>
                alert("Error while inserting into DB: ' . $sql . '\n\n ' . $connect->error . '");
                window.location.href="./payment-error";
            </script>
            ';
        die();
    }

    $connect->close();

    echo "<p>Payment successful. Thank you for your purchase!</p>";
} else {
    // Payment failed
    echo "<p>Payment failed. Please try again.</p>";
}
