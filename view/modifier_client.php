<?php include '../model/modif_client.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Client</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h2>Modifier les Informations du Client</h2>
            </div>
            <div class="card-body">
                <?php if ($client): ?>
                <form method="POST" action="../model/modif_client.php?id=<?= htmlspecialchars($client['id']) ?>">
                    <div class="mb-3">
                        <label for="nom_client" class="form-label">Nom du client</label>
                        <input type="text" class="form-control" name="nom_client" id="nom_client" 
                               value="<?= htmlspecialchars($client['nom_client']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="mdp" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="mdp" id="mdp" 
                               value="<?= htmlspecialchars($client['mdp']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" class="form-control" name="adresse" id="adresse" 
                               value="<?= htmlspecialchars($client['adresse']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <input type="tel" class="form-control" name="telephone" id="telephone" 
                               value="<?= htmlspecialchars($client['téléphone']) ?>" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="../index.php" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-success">Mettre à jour</button>
                    </div>
                </form>
                <?php else: ?>
                    <p class="text-danger text-center">Impossible de charger les informations du client.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>