<?php 

// Connexion à la base
$conn = new mysqli("localhost", "root", "", "gaming_site");

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Récupération des données
$email = $_POST['email'];
$pseudo = $_POST['pseudo'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Insertion
$sql = "INSERT INTO users (email, pseudo, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $email, $pseudo, $password);

if ($stmt->execute()) {
    echo "Inscription réussie 🎉";
    header("Location: index.html");
} else {
    echo "Erreur : " . $stmt->error;
}

$stmt->close();
$conn->close();
