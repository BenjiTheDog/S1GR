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


$query = "SELECT 
            hc.id_commande, 
            hc.id_client, 
            hc.date_commande, 
            s.nom_produit AS nom_stock, 
            hc.total, 
            hc.statut
          FROM historique_commande hc
          JOIN détails_commande dc ON hc.id_commande = dc.id_commande
          JOIN stocks s ON dc.id_stock = s.id
          ORDER BY hc.date_commande DESC";

$stmt = $pdo->prepare($query);
$stmt->execute();


$historique = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>