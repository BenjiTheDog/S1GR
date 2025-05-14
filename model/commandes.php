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

// Inclure les informations des clients
$query = "SELECT 
            c.id AS commande_id, 
            c.date_commande, 
            c.total, 
            c.statut, 
            cl.nom_client, 
            GROUP_CONCAT(s.nom_produit SEPARATOR ', ') AS stocks
          FROM commandes c
          LEFT JOIN client cl ON c.id_client = cl.id
          LEFT JOIN détails_commande dc ON c.id = dc.id_commande
          LEFT JOIN stocks s ON dc.id_stock = s.id
          GROUP BY c.id
          ORDER BY c.date_commande DESC";
$stmt = $pdo->prepare($query);
$stmt->execute();

echo '<div class="container my-5">';
echo '<h2 class="text-center mb-4">Gestion des Commandes</h2>';
echo "<div class='text-end mb-3'>";
echo "<a href='view/ajouter_commande.php' class='btn btn-success'>Ajouter une commande</a>";
echo "</div>";

echo '<table class="table table-striped table-bordered">';
echo "<thead class='table-dark'>
        <tr>
            <th class='text-center'>ID</th>
            <th class='text-center'>Client</th>
            <th class='text-center'>Date</th>
            <th class='text-center'>Total</th>
            <th class='text-center'>Statut</th>
            <th class='text-center'>Stocks</th>
            <th class='text-center'>Actions</th>
        </tr>
      </thead>
      <tbody>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>';
    echo '<td class="text-center">' . htmlspecialchars($row['commande_id'] ?? '') . "</td>";
    echo '<td class="text-center">' . htmlspecialchars($row['nom_client'] ?? 'Client inconnu') . "</td>";
    echo '<td class="text-center">' . htmlspecialchars($row['date_commande'] ?? '') . "</td>";
    echo '<td class="text-center">' . htmlspecialchars($row['total'] ?? '') . " €</td>";
    echo '<td class="text-center">' . htmlspecialchars($row['statut'] ?? '') . "</td>";
    echo '<td class="text-center">' . htmlspecialchars($row['stocks'] ?? 'Aucun stock associé') . "</td>";
    echo "<td class='text-center'>
            <a href='view/modifier_commande.php?id=" . htmlspecialchars($row['commande_id'] ?? '') . "' class='btn btn-warning btn-sm'>Modifier</a>
            <a href='model/supprimer_commande.php?id=" . htmlspecialchars($row['commande_id'] ?? '') . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cette commande ?\");'>Supprimer</a>
          </td>";
    echo "</tr>";
}

echo "</tbody></table>";

echo '<div class="text-end">';
echo '<a href="view/historique_commande.php" class="btn btn-info">Historique</a>';
echo '</div>';

echo '</div>';
?>