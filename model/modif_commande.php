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


    $query = "SELECT * FROM commandes WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':id' => $id]);
    $commande = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$commande) {
        die("Commande non trouvée.");
    }


    $query = "SELECT s.id, s.nom_produit 
              FROM stocks s 
              JOIN détails_commande dc ON s.id = dc.id_stock 
              WHERE dc.id_commande = :id_commande";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':id_commande' => $id]);
    $stocks_commande = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $query = "SELECT id, nom_produit FROM stocks";
    $stmt = $pdo->query($query);
    $all_stocks = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $query = "SELECT id, nom_client FROM client";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_client = $_POST['id_client'];
        $date_commande = $_POST['date_commande'];
        $total = $_POST['total'];
        $statut = $_POST['statut'];
        $stocks_selectionnes = $_POST['stocks'] ?? [];


        $query = "UPDATE commandes SET id_client = :id_client, date_commande = :date_commande, total = :total, statut = :statut WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':id_client' => $id_client,
            ':date_commande' => $date_commande,
            ':total' => $total,
            ':statut' => $statut,
            ':id' => $id
        ]);


        $query = "DELETE FROM détails_commande WHERE id_commande = :id_commande";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':id_commande' => $id]);


        foreach ($stocks_selectionnes as $id_stock) {
            $query = "INSERT INTO détails_commande (id_commande, id_stock) VALUES (:id_commande, :id_stock)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([':id_commande' => $id, ':id_stock' => $id_stock]);
        }

        header("Location: ../index.php");
        exit;
    }
} else {
    die("ID manquant.");
}
?>