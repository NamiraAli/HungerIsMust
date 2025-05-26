<?php
session_start();



if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'fetch':
            echo json_encode(['cart' => $_SESSION['cart']]);
            exit;

        case 'add':
            $item_id = $_POST['item_id'];
            $item_name = $_POST['item_name'];
            $item_price = floatval($_POST['item_price']);
            $item_img = $_POST['item_img'];
            $item_qty = intval($_POST['item_qty']);

            if (isset($_SESSION['cart'][$item_id])) {
                $_SESSION['cart'][$item_id]['qty'] += $item_qty;
            } else {
                $_SESSION['cart'][$item_id] = [
                    'name' => $item_name,
                    'price' => $item_price,
                    'img' => $item_img,
                    'qty' => $item_qty,
                ];
            }

            echo json_encode(['cart' => $_SESSION['cart']]);
            exit;

        case 'remove':
            $item_id = $_POST['item_id'];
            if (isset($_SESSION['cart'][$item_id])) {
                unset($_SESSION['cart'][$item_id]);
            }
            echo json_encode(['cart' => $_SESSION['cart']]);
            exit;

        default:
            echo json_encode(['error' => 'Invalid action']);
            exit;
    }
} else {
    echo json_encode(['error' => 'No action specified']);
}
