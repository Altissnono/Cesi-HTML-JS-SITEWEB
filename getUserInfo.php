<?php
// Connexion à la base de données
$host = "sql966.main-hosting.eu";
$dbname = "u150008834_sitecubecesi";
$username = "u150008834_sitecubecesi";
$password = "5Csjf*cs3A~w";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // En cas d'erreur de connexion, afficher le message d'erreur et arrêter l'exécution du script
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
    exit;
}

// Vérification de la présence du paramètre userId
if (!isset($_GET['userId'])) {
    http_response_code(400);
    echo json_encode(["error" => "userId parameter is required"]);
    exit;
}

$userId = $_GET['userId'];

// Requête pour récupérer les informations de l'utilisateur
$sql = "SELECT username, email, first_name, last_name, created_at FROM users WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérification de la présence de l'utilisateur
if (!$user) {
    http_response_code(404);
    echo json_encode(["error" => "User not found"]);
    exit;
}

// Envoi des informations de l'utilisateur au format JSON
http_response_code(200);
echo json_encode($user);
