<?php
// Connexion à la base de données
$servername = "sql966.main-hosting.eu";
$username = "u150008834_sitecubecesi";
$password = "5Csjf*cs3A~w";
$dbname = "u150008834_sitecubecesi";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les données du formulaire
$user = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm-password"];

// Vérifier si les mots de passe correspondent
if ($password !== $confirm_password) {
    showErrorAndRedirect("Les mots de passe ne correspondent pas.");
}

// Hasher le mot de passe
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insérer les données dans la base de données
$sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $user, $email, $hashed_password);
$result = $stmt->execute();

if ($result) {
    echo "Inscription réussie.";
    // Rediriger vers la page de connexion
    header("Location: user.php");
} else {
    showErrorAndRedirect("Erreur lors de l'inscription: " . $conn->error);
}

// Fermer la connexion
$stmt->close();
$conn->close();

function showErrorAndRedirect($message) {
    echo "<script>";
    echo "alert('" . addslashes($message) . "');";
    echo "window.location.href='scription.php';";
    echo "</script>";
    exit();
}
?>