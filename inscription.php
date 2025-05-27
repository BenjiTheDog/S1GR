<?php
$pdo = new PDO("mysql:host=localhost;dbname=stockweb;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $util = $_POST['util'];
    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt = $pdo->prepare("INSERT INTO user (util, mdp, role) VALUES (:util, :mdp, :role)");
    $stmt->execute([
        ':util' => $util,
        ':mdp' => $mdp,
        ':role' => $role
    ]);

    header("Location: connexion.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Inscription</h2>
    <form method="POST">
        <label>Nom d'utilisateur :</label>
        <input type="text" name="util" required><br>

        <label>Mot de passe :</label>
        <input type="password" name="mdp" required><br>

        <label>Rôle :</label>
        <select name="role" required>
            <option value="admin">Admin</option>
            <option value="employe">Employé</option>
        </select><br><br>
    </form>
</body>
</html>