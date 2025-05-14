<?php include '../model/modif_commande.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Commande</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Modifier la commande</h2>

        <form method="POST" action="../model/modif_commande.php?id=<?= htmlspecialchars($id) ?>">
            <div class="mb-3">
                <label for="id_client" class="form-label">Client :</label>
                <select name="id_client" id="id_client" class="form-select" required>
                    <?php foreach ($clients as $client): ?>
                        <option value="<?= $client['id'] ?>" 
                            <?= ($client['id'] == $commande['id_client']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($client['nom_client']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="date_commande" class="form-label">Date :</label>
                <input type="date" name="date_commande" id="date_commande" class="form-control" 
                       value="<?= htmlspecialchars($commande['date_commande']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="total" class="form-label">Total :</label>
                <input type="number" step="0.01" name="total" id="total" class="form-control" 
                       value="<?= htmlspecialchars($commande['total']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="statut" class="form-label">Statut :</label>
                <input type="text" name="statut" id="statut" class="form-control" 
                       value="<?= htmlspecialchars($commande['statut']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="stocks" class="form-label">Stocks associés :</label>
                <select name="stocks[]" id="stocks" class="form-select" multiple required>
                    <?php foreach ($all_stocks as $stock): ?>
                        <option value="<?= $stock['id'] ?>" 
                            <?= in_array($stock['id'], array_column($stocks_commande, 'id')) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($stock['nom_produit']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>