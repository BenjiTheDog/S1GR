<?php include '../model/ajout_client.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un client</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h2>Ajouter un Nouveau Client</h2>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="nom_client" class="form-label">Nom du client</label>
                        <input type="text" class="form-control" name="nom_client" id="nom_client" required>
                    </div>

                    <div class="mb-3">
                        <label for="mdp" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="mdp" id="mdp" required>
                    </div>

                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" class="form-control" name="adresse" id="adresse" required>
                    </div>

                    <div class="mb-3">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" name="telephone" id="telephone" required>
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