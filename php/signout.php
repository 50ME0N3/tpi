<?php
// Démarrer la session
session_start();

// Effacer toutes les variables de session
$_SESSION = array();

// Finalement, détruire la session
session_destroy();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Déconnexion</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <h1>Vous êtes déconnecté.</h1>
    <p><a href="login.php">Se connecter à nouveau</a></p>
</body>

</html>