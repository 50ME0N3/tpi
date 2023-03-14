<?php
session_start();
require 'fonctionBDD.php';

if (isset($_GET["id"])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    removeFromFavorite($id);
    echo "<script> alert('casquette retirée des favoris'); </script>";
}

if (isset($_POST['id'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $idUser =  $_SESSION['user']['id_user'];
    addFavorite($idUser, $id);
    echo "<script> alert('casquette ajoutée aux favoris'); </script>";
}
if (isset($_SESSION['user'])) {
    $caps = getFavorite($_SESSION['user']['id_user']);
} else {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/cart.css">
</head>

<body>
    <center>
        <a href="index.php">
            <h1>Vos favoris</h1>
        </a>
        <table class="table table-success table-striped">
            <thead>
                <tr>
                    <th>marque</th>
                    <th>modèle</th>
                    <th>Prix</th>
                    <th>voir le produit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($caps as $cap) {
                ?>
                    <tr>
                        <td><?php echo $cap['brand']; ?></td>
                        <td><?php echo $cap['model']; ?></td>
                        <td><?php echo $cap['price']; ?></td>
                        <td><a href="favorite.php?id=<?php echo $cap["id_fav"]; ?>"> Retirer des favoris </a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </center>
</body>

</html>