<?php
require "connexionBDD.php";

// Récupérer toutes les casquettes en vente
function getAllHats() {
  $conn = connectDb();
  $query = "SELECT * FROM hats";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $result = $stmt->fetchAll();
  return $result;
}

?>
