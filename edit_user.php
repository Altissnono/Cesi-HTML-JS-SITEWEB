<?php
session_start();

if (!isset($_SESSION['userId']) || $_SESSION['username'] !== 'root') {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['userId'])) {
    header('Location: admin.php');
    exit;
}

$userId = intval($_GET['userId']);

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    $sql = "UPDATE users SET username = ?, email = ?, first_name = ?, last_name = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $username, $email, $first_name, $last_name, $userId);

    if ($stmt->execute()) {
        header('Location: admin.php');
        exit;
    } else {
        $error = "Erreur lors de la mise à jour des informations de l'utilisateur.";
    }
}

$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    header('Location: admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'utilisateur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://dev.soundco.me/cube3-dev/style/styleadm.css">
</head>
<body>
<div class="container">
    <h1 class="mt-5 mb-3">Modifier l'utilisateur</h1>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="edit_user.php?userId=<?php echo $userId; ?>" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="first_name" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user['first_name']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Nom de famille</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user['last_name']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="admin.php" class="btn btn-secondary">Retour à l'administration</a>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>

