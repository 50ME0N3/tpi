<?php
// Connexion à la base de données
function connectDb() {
    $host = 'localhost';
    $dbname = 'hat_sale';
    $username = 'username';
    $password = 'password';
    
    try {
      $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conn;
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
?>