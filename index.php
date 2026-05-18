<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Méthode non autorisée");
}

$host = getenv("MYSQLHOST");
$user = getenv("MYSQLUSER");
$pass = getenv("MYSQLPASSWORD");
$db   = getenv("MYSQLDATABASE");
$port = getenv("MYSQLPORT");

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Erreur connexion : " . $conn->connect_error);
}

$email = $_POST['email'] ?? '';
$pseudo = $_POST['pseudo'] ?? '';
$password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);

$sql = "INSERT INTO users (email, pseudo, password) VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param("sss", $email, $pseudo, $password);

if ($stmt->execute()) {

    header("Location: index.html");
    exit();

} else {

    echo "Erreur : " . $stmt->error;
}

$stmt->close();
$conn->close();

?>
