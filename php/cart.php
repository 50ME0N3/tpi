<?php
session_start();
require "fonctionBDD.php";
if (isset($_SESSION)) {
    if (isset($_SESSION['cart'])) {
        $cart = true;
        $casquettes = array();
        $count = 0;
        foreach ($_SESSION['cart'] as $key => $value) {
            $id = $value['id'];
            $casquettes[$count] = getCapsWithId($id);
            $count++;
        }
    } else {
        $cart = false;
    }
} else {
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/cart.css">

</head>

<body>
    <center>
        <?php
        if ($cart) {
        ?>
            <a href="index.php">
                <h1>Votre panier</h1>
            </a>
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th>marque</th>
                        <th>modèle</th>
                        <th>Prix</th>
                        <th>supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($casquettes as $casquette) {
                    ?>
                        <tr>
                            <td><?php echo $casquette[0]['brand']; ?></td>
                            <td><?php echo $casquette[0]['model']; ?></td>
                            <td><?php echo $casquette[0]['price']; ?></td>
                            <td><a href="deleteFromCart.php?id=<?php echo $casquette[0]["id"]; ?>"> supprimer du panier </a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <form action="commande.php">
                <input hidden name="id" value="<?php echo $casquette[0]["id"]; ?>">
                <input hidden name="price" value="<?php echo $casquette[0]["price"]; ?>">
                <button type="submit" class="btn btn-primary">Commander</button>
            </form>
        <?php
        } else {
        ?>
            <a href="index.php">
                <h1>Votre panier est vide</h1>
            </a>
        <?php
        }
        ?>

    </center>
</body>

</html>