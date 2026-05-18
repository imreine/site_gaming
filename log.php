<?php

session_start();

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
$password = $_POST['password'] ?? '';

$sql = "SELECT * FROM users WHERE email = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $email);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {

        $_SESSION['pseudo'] = $user['pseudo'];

        header("Location: accueil.php");
        exit();

    } else {

        echo "Mot de passe incorrect";

    }

} else {

    echo "Email introuvable";

}

$stmt->close();
$conn->close();

?>
$conn->close();
