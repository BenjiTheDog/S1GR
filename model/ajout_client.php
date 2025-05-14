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
    $nom_client = $_POST['nom_client'];
    $mdp = $_POST['mdp']; 
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];


    $query = "INSERT INTO client (nom_client, mdp, adresse, téléphone) VALUES (:nom_client, :mdp, :adresse, :telephone)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':nom_client' => $nom_client,
        ':mdp' => $mdp,
        ':adresse' => $adresse,
        ':telephone' => $telephone
    ]);

    header("Location: ../index.php");
    exit;
}
?>