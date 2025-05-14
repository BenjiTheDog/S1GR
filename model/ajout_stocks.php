<?php

$host = 'localhost';
$dbname = 'stockweb';
$username = 'root';
$password = '';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom_produit = $_POST['nom_produit'];
    $quantite = $_POST['quantite']; 
    $prix = $_POST['prix'];


    $query = "INSERT INTO stocks (nom_produit, quantité, prix) VALUES (:nom_produit, :quantite, :prix)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':nom_produit' => $nom_produit,
        ':quantite' => $quantite,
        ':prix' => $prix
    ]);

    header("Location: ../index.php");
    exit;
}
?>