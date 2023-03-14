<?php
session_start();
if(isset($_POST)){
    if(addCommand($_SESSION['cart'])){
        unset($_SESSION['cart']);
        header('Location: index.php');
        exit;
    }
    else{
        echo '<script>alert("Il y a eu une erreur lors de votre commande")</script>';
        header('Location: cart.php');
        exit;
    }

}