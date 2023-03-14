<?php
require_once 'fonctionBDD.php';
require_once 'func.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    if (isset($_GET['id'])) {
        $result = getCapsWithId($_GET['id']);
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $result = addToCart($_POST['id'], $_POST['price']);
        if ($result) {
            header('Location: index.php');
            exit;
        } else {
            echo $result;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>caps</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/cart.css">
</head>

<body>
    <center>
        <a href="index.php">
            <h1>la casquette</h1>
        </a>
    </center>
    <div class="card" style="width: 18rem; margin-left: 45%; margin-top: 20%;">
        <div class="card-body">
            <h5 class="card-title"><?php echo $result[0]["model"]; ?></h5>
            <p class="card-text"><?php echo $result[0]["brand"]; ?></p>
            <p class="card-text"><?php echo $result[0]["description"]; ?></p>
            <?php
            session_start();
            if ($_SESSION != null) {
            ?>
                <form action="#" method="post">
                <input hidden class="card-text" name="id" value="<?php echo $result[0]["id"]; ?>"></input>
                <button type="submit" class="btn btn-primary">Ajouter au panier (<?php echo $result[0]["price"] ?>)</button>
                <input hidden class="card-text" name="price" value="<?php echo $result[0]["price"]; ?>"></input>
                </form>

                <form action="favorite.php" method="post">
                <input hidden class="card-text" name="id" value="<?php echo $result[0]["id"]; ?>"></input>
                <button type="submit" class="btn btn-primary">Ajouter au favoris</button>
                </form>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>