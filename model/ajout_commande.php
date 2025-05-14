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

$query = "SELECT * FROM stocks";
$stmt = $pdo->prepare($query);
$stmt->execute();
$stocks = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT id, nom_client FROM client";
$stmt = $pdo->prepare($query);
$stmt->execute();
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id_client = $_POST['id_client'];
    $date_commande = $_POST['date_commande'];
    $total = $_POST['total'];
    $statut = $_POST['statut'];

    if (empty($id_client) || empty($date_commande) || empty($total) || empty($statut)) {
        echo "Tous les champs sont obligatoires.";
        exit;
    }

    $query = "INSERT INTO commandes (id_client, date_commande, total, statut) VALUES (:id_client, :date_commande, :total, :statut)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':id_client' => $id_client,
        ':date_commande' => $date_commande,
        ':total' => $total,
        ':statut' => $statut
    ]);

  
    $commande_id = $pdo->lastInsertId();


    if (isset($_POST['stocks']) && !empty($_POST['stocks'])) {
        foreach ($_POST['stocks'] as $stock_id) {
            $query = "INSERT INTO détails_commande (id_commande, id_stock) VALUES (:id_commande, :id_stock)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':id_commande' => $commande_id,
                ':id_stock' => $stock_id
            ]);
        }
    }


    header("Location: ../index.php");
    exit;
}
?>