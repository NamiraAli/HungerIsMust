<?php
session_start();

// Initialize cart count
$cartCount = 0;

// If cart exists in session, calculate the total count
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += $item['qty'];
    }
}

// Return the cart count
echo $cartCount;
?>
