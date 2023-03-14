<?php
session_start();
if($_SESSION['user'] == null || $_SESSION['cart'] == null){
    header('Location: login.php');
    exit;
}
else{
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $item_array_id = array_column($_SESSION['cart'], "id");
    if(in_array($id, $item_array_id)){
        $key = array_search($id, $item_array_id);
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
        header('Location: cart.php');
        exit;
    }
    else{
        header('Location: index.php');
        exit;
    }
}