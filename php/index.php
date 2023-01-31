<?php
require_once 'fonctionBDD.php';
$casquettes = getAllHats();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Vente de casquettes</title>
</head>

<body>
    <h1>Vente de casquettes</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($casquettes as $casquette) {
            ?>
                <tr>
                    <td><?php echo $casquette['nom']; ?></td>
                    <td><?php echo $casquette['description']; ?></td>
                    <td><?php echo $casquette['prix']; ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>

</html>