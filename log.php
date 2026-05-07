<?php

session_start();
$conn = new mysqli("localhost", "root", "", "gaming_site");

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['pseudo'] = $user['pseudo'];
        echo "Connexion réussie 🎮 Bienvenue " . $_SESSION['pseudo'];
        // Redirection vers une page d'accueil
        header("Location: accueil.php");
    } else {
        echo "Mot de passe incorrect ";
    }
} else {
    echo "Email introuvable ";
}

$stmt->close();
$conn->close();
