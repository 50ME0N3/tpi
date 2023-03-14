<?php
require_once 'fonctionBDD.php';
$casquettes = getAllHats();
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['search'])) {
        $casquettes = searchCaps($_GET['search']);
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Vente de casquettes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body style="background-color: lightgray;">
    <center>
        <h1>Vente de casquettes</h1>
        <?php if (isset($_SESSION['user'])) { ?>
            <h2>Bonjour <?php echo $_SESSION['user']['username']; ?></h2>
            <button type="button" class="btn btn-primary cart" onclick="location.href = 'cart.php'">panier</button>
            <button type="button" class="btn btn-primary logout" onclick="location.href = 'favorite.php'">vos favoris</button>
        <?php } else { ?>
            <button type="button" class="btn btn-primary signup" onclick="location.href = 'signup.php'">s'inscrire</button>
            <button type="button" class="btn btn-primary login" onclick="location.href = 'login.php'">se connecter</button>
        <?php } ?>
        <form action="#" method="get">
            <input type="text" name="search" placeholder="Rechercher une casquette">
            <input type="submit" value="Rechercher">
        </form>
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
                foreach ($casquettes as $casquette) {
                ?>
                    <tr>
                        <td><?php echo $casquette['brand']; ?></td>
                        <td><?php echo $casquette['model']; ?></td>
                        <td><?php echo $casquette['price']; ?></td>
                        <td><a href="caps.php?id=<?php echo $casquette["id"]; ?>"> le produit </a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </center>
    <?php if (isset($_SESSION['user'])) { ?>
        <button type="button" class="btn btn-primary login" onclick="location.href = 'signout.php'">se deconnecter</button>
    <?php } ?>
</body>

</html>