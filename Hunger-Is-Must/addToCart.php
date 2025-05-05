<?php
session_start();

// Check if cart data is sent via POST
if (isset($_POST['cartItem'])) {
    $cartItem = json_decode($_POST['cartItem'], true);

    // Initialize the cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the item already exists in the cart
    $found = false;
    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['name'] === $cartItem['name']) {
            // Update the quantity if item already exists
            $_SESSION['cart'][$index]['qty'] += $cartItem['qty'];
            $found = true;
            break;
        }
    }

    // If the item doesn't exist, add it to the cart
    if (!$found) {
        $_SESSION['cart'][] = $cartItem;
    }

    // Return success response
    echo 'Item added';
}
?>
