<?php
function addToCart($id, $price){
    session_start();
    if(isset($_SESSION['cart'])){
        $item_array_id = array_column($_SESSION['cart'], "id");
        if(!in_array($id, $item_array_id)){
            $count = count($_SESSION['cart']);
            $item_array = array(
                'id' => $id,
                'price' => $price
            );
            $_SESSION['cart'][$count] = $item_array;
            echo '<script>window.location="cart.php"</script>';
        }else{
            echo '<script>alert("Item Already Added")</script>';
            echo '<script>window.location="index.php"</script>';
        }
    }else{
        $item_array = array(
            'id' => $id,
            'price' => $price,
        );
        $_SESSION['cart'][0] = $item_array;
        echo '<script>window.location="cart.php"</script>';
    }
}
