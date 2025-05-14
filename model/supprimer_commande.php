<?php
$host = 'localhost';
$dbname = 'stockweb';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM commandes WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':id' => $id]);

    header("Location: ../index.php");
    exit;
} else {
    die("ID commande manquant.");
}
?>