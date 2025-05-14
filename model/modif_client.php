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


$client = null;


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM client WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':id' => $id]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$client) {
        die("Client non trouvé.");
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $nom_client = $_POST['nom_client'];
    $mdp = $_POST['mdp'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];

    $query = "UPDATE client SET nom_client = :nom_client, mdp = :mdp, adresse = :adresse, téléphone = :telephone WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':nom_client' => $nom_client,
        ':mdp' => $mdp,
        ':adresse' => $adresse,
        ':telephone' => $telephone,
        ':id' => $id,
    ]);


    header("Location: ../index.php");
    exit;
}