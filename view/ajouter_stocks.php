<?php include '../model/ajout_stocks.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Stock</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h2>Ajouter un Nouveau Stock</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="../model/ajout_stocks.php">
                    <div class="mb-3">
                        <label for="nom_produit" class="form-label">Nom du Produit</label>
                        <input type="text" class="form-control" name="nom_produit" id="nom_produit" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantite" class="form-label">Quantité</label>
                        <input type="number" class="form-control" name="quantite" id="quantite" required>
                    </div>
                    <div class="mb-3">
                        <label for="prix" class="form-label">Prix</label>
                        <input type="number" step="0.01" class="form-control" name="prix" id="prix" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="../index.php" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>