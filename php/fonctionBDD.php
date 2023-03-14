<?php
require "connexionBDD.php";
// Récupérer toutes les casquettes en vente
function getAllHats()
{
  $conn = connectDb();
  $query = "SELECT models.id_model as id, models.name as model, brands.name as brand, caps.price as price, description FROM `models` JOIN caps ON models.id_model = caps.id_model JOIN brands ON models.id_brand = brands.id_brand;";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $result = $stmt->fetchAll();
  return $result;
}

function getCapsWithId($id)
{
  $conn = connectDb();
  $query = "SELECT models.id_model as id, models.name as model, brands.name as brand, caps.price as price, description FROM `models` JOIN caps ON models.id_model = caps.id_model JOIN brands ON models.id_brand = brands.id_brand WHERE models.id_model = $id;";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $result = $stmt->fetchAll();
  return $result;
}

function login($mail, $password)
{
  try {
    $conn = connectDb();
    // Préparation de la requête SELECT
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :mail AND password = :password");
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
      session_start();
      $_SESSION['user'] = $user;
      $_SESSION['user']['id_user'] = $user['id_user'];
      header('Location: index.php');
      exit;
    } else {
      return "Nom d'utilisateur ou mot de passe incorrect";
    }
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
  }
}

function signup($username, $password, $mail)
{
  try {
    $conn = connectDb();
    // Préparation de la requête SELECT
    $stmt = $conn->prepare("INSERT INTO users (email, username, password, actif) VALUES (:mail, :username, :password, 1)");
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
      session_start();
      $_SESSION['user'] = $username;
      header('Location: index.php');
      exit;
    } else {
      return "Nom d'utilisateur ou mot de passe incorrect";
    }
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
  }
}


function searchCaps()
{
  try {
    $conn = connectDb();
    $query = "SELECT models.id_model as id, models.name as model, brands.name as brand, caps.price as price, description FROM `models` JOIN caps ON models.id_model = caps.id_model JOIN brands ON models.id_brand = brands.id_brand WHERE models.name LIKE '%" . $_GET['search'] . "%' OR brands.name LIKE '%" . $_GET['search'] . "%' OR description LIKE '%" . $_GET['search'] . "%' OR models.name LIKE '%" . $_GET['search'] . "%';";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
  }
}

function addCommand($caps)
{
  try {
    $conn = connectDb();
    // Prépare la requête SQL d'insertion avec des marqueurs de paramètres
    foreach ($caps as $cap) {
      $query = "INSERT INTO order_caps (id_user, id_cap) VALUES (:id_user, :id_cap)";
      $stmt = $conn->prepare($query);
      // Lie les valeurs du tableau aux marqueurs de paramètres
      $i = 0;
      $stmt->bindParam(':id_user', $_SESSION['user']['id_user']);
      $stmt->bindParam(':id_cap', $cap['id_cap']);
      // Exécute la requête d'insertion
      $stmt->execute();
      return true;
    }
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    return false;
  }
}

function addFavorite($idUser, $id)
{
  try {
    $conn = connectDb();
    $query = "INSERT INTO favorite(id_user, id_cap) SELECT :idUser, id_cap FROM caps WHERE id_model = :id_model;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':idUser', $idUser);
    $stmt->bindParam(':id_model', $id);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
  }
}

function getFavorite($idUser){
  try {
    $conn = connectDb();
    $query = "SELECT models.id_model as id, models.name as model, brands.name as brand, caps.price as price, description, favorite.id_favorite as id_fav FROM `models` JOIN caps ON models.id_model = caps.id_model JOIN brands ON models.id_brand = brands.id_brand JOIN favorite ON caps.id_cap = favorite.id_cap WHERE favorite.id_user = :idUser;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':idUser', $idUser);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
  }
}

function removeFromFavorite($idFavorite){
  try {
    $conn = connectDb();
    $query = "DELETE FROM favorite WHERE id_favorite = :idFavorite;";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':idFavorite', $idFavorite);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
  }
}