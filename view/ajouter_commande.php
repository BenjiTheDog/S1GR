<?php include '../model/ajout_commande.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Commande</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <div class="card">
        <div class="card-header bg-primary text-white text-center">
            <h2>Ajouter une Commande</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="ajouter_commande.php"> 
                
                <div class="mb-3">
                    <label for="id_client" class="form-label">Client</label>
                    <select name="id_client" id="id_client" class="form-select" required>
                        <?php foreach ($clients as $client): ?>
                            <option value="<?= htmlspecialchars($client['id']) ?>">
                                <?= htmlspecialchars($client['nom_client']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                
                <div class="mb-3">
                    <label for="date_commande" class="form-label">Date de commande</label>
                    <input type="date" class="form-control" name="date_commande" id="date_commande" required>
                </div>

                
                <div class="mb-3">
                    <label for="total" class="form-label">Total</label>
                    <input type="number" class="form-control" name="total" id="total" step="0.01" required>
                </div>

                
                <div class="mb-3">
                    <label for="statut" class="form-label">Statut</label>
                    <select name="statut" id="statut" class="form-select" required>
                        <option value="En attente">En attente</option>
                        <option value="Expédiée">Expédiée</option>
                        <option value="Livrée">Livrée</option>
                    </select>
                </div>

               
                <div class="mb-3">
                    <label for="stocks" class="form-label">Stocks</label>
                    <select name="stocks[]" id="stocks" class="form-select" multiple required>
                        <?php foreach ($stocks as $stock): ?>
                            <option value="<?= htmlspecialchars($stock['id']) ?>">
                                <?= htmlspecialchars($stock['nom_produit']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <small class="form-text text-muted">Sélectionnez les stocks associés à cette commande.</small>
                </div>

            
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Ajouter la commande</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>