<?php
session_start();

// Redirection si déjà connecté
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: index.php");
    }
    exit;
}

$pdo = new PDO("mysql:host=localhost;dbname=stockweb;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $util = $_POST['util'];
    $mdp = $_POST['mdp'];

    $stmt = $pdo->prepare("SELECT * FROM user WHERE util = :util");
    $stmt->execute([':util' => $util]);
    $user = $stmt->fetch();

    if ($user && password_verify($mdp, $user['mdp'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['util'] = $user['util'];
        $_SESSION['role'] = $user['role'];

        // Redirection selon le rôle
        if ($user['role'] === 'admin') {
            header("Location: admin.php");
        } else {
            header("Location: index.php");
        }
        exit;
    } else {
        $error = "Identifiants invalides.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Connexion</h2>
    <?php if ($error): ?>
        <p style="color:red"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>Nom d'utilisateur :</label>
        <input type="text" name="util" required><br>

        <label>Mot de passe :</label>
        <input type="password" name="mdp" required><br><br>

        <button type="submit">Se connecter</button>
    </br>
        <a href="inscription.php">S'inscrire</a>
    </form>
</body>
</html>