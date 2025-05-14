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

$stocks = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM stocks WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':id' => $id]);
    $stocks = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$stocks) {
        die("Stock non trouvé.");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $nom_produit = $_POST['nom_produit'];
    $quantite = $_POST['quantite'];
    $prix = $_POST['prix'];

    $query = "UPDATE stocks SET nom_produit = :nom_produit, quantité = :quantite, prix = :prix WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':nom_produit' => $nom_produit,
        ':quantite' => $quantite,
        ':prix' => $prix,
        ':id' => $id,
    ]);


    header("Location: ../index.php");
    exit;
}