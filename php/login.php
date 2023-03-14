<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        require_once 'fonctionBDD.php';
        $result = login($_POST['email'], sha1($_POST['password']));
        echo sha1($_POST['password']);
        echo $_POST['email'];
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
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/cart.css">
</head>

<body>
    <center>
    <a href="index.php">
            <h1>Connexion</h1>
        </a>
        <form style="width: 30%; margin-top: 10%;" action="login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </center>
</body>

</html>