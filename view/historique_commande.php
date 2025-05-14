<?php

require_once '../model/historique_commande.php'; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des commandes</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Historique des commandes</h2>
        
        <?php if (isset($historique) && $historique): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Commande</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Produit</th>
                        <th>Total</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($historique as $commande): ?>
                        <tr>
                            <td><?= htmlspecialchars($commande['id_commande']) ?></td>
                            <td><?= htmlspecialchars($commande['id_client']) ?></td>
                            <td><?= htmlspecialchars($commande['date_commande']) ?></td>
                            <td><?= htmlspecialchars($commande['nom_stock']) ?></td>
                            <td><?= htmlspecialchars($commande['total']) ?></td>
                            <td><?= htmlspecialchars($commande['statut']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucune commande n'a été trouvée dans l'historique.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>