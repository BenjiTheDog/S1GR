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

$query = "SELECT * FROM stocks";
$stmt = $pdo->prepare($query);
$stmt->execute();


echo '<div class="container my-5">';
echo '<h2 class="text-center mb-4">Gestion des Stocks</h2>';

echo "<div class='text-end mb-3'>";
echo "<a href='view/ajouter_stocks.php' class='btn btn-success'>Ajouter un produit</a>";
echo "</div>";

echo '<table class="table table-striped table-bordered">';
echo "<thead class='table-dark'>
        <tr>
            <th class='text-center'>ID</th>
            <th class='text-center'>Nom Produit</th>
            <th class='text-center'>Quantité</th>
            <th class='text-center'>Prix</th>
            <th class='text-center'>Actions</th>
        </tr>
      </thead>
      <tbody>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>';
    echo '<td class="text-center">' . htmlspecialchars($row['id']) . "</td>";
    echo '<td class="text-center">' . htmlspecialchars($row['nom_produit']) . "</td>";
    echo '<td class="text-center">' . htmlspecialchars($row['quantité']) . "</td>";
    echo '<td class="text-center">' . htmlspecialchars($row['prix']) . " €</td>";

    echo "<td class='text-center'>
            <a href='view/modifier_stocks.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-warning btn-sm'>Modifier</a>
            <a href='model/supprimer_stocks.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce stock ?\");'>Supprimer</a>
          </td>";
    echo "</tr>";    
}

echo "</tbody></table>";
echo '</div>';
?>