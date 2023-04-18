<?php
session_start();

// Vérifier si l'utilisateur est connecté et si c'est l'utilisateur root
if (!isset($_SESSION['userId']) || $_SESSION['username'] !== 'root') {
    header('Location: login.php');
    exit;
}

require_once 'config.php';

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
$users = $result->fetch_all(MYSQLI_ASSOC);
?>
<?php
$sql_registrations = "SELECT DATE(created_at) as date, COUNT(id) as count FROM users WHERE created_at >= DATE(NOW()) - INTERVAL 10 DAY GROUP BY DATE(created_at) ORDER BY date";
$result_registrations = $conn->query($sql_registrations);
$registrations = $result_registrations->fetch_all(MYSQLI_ASSOC);

$dates = [];
$counts = [];

foreach ($registrations as $registration) {
$dates[] = $registration['date'];
$counts[] = $registration['count'];
}
$average = array_sum($counts) / count($counts);
?>
<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <title>Administration des utilisateurs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="styleadm.css">

    <style>
        body {
            background-color: #1c1c1c;
            color: #fff;
        }

        .card {
            background-color: #1c1c1c;
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.5);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.5);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
            }
        }

        .card-header {
            color: #fff;
        }

        .table-striped tr:nth-child(odd) {
            background-color: #1c1c1c;
        }

        .table-striped td, .table-striped th {
            color: #fff;
        }

        .btn-primary, .btn-danger {
            color: #fff;
            background-color: transparent;
            border-color: #fff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            margin-right: 10px;
            transition: all 0.3s ease-in-out;
        }

        .btn-primary:hover, .btn-danger:hover {
            background-color: #fff;
            color: #1c1c1c;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
            transform: translateY(-2px);
        }

        .card-body, .card-body td {
            color: #fff !important;
        }
    </style>
</head>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Cesi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user.php">Information</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<body>
<br>
<div class="container">
    <br>
    <div class="card mt-5">
        <div class="card-header">
            Administration des utilisateurs
        </div>
        <div class="card-body text-white">
            <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom d'utilisateur</th>
            <th>Email</th>
            <th>Prénom</th>
            <th>Nom de famille</th>
            <th>Date de création</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['first_name']; ?></td>
                <td><?php echo $user['last_name']; ?></td>
                <td><?php echo $user['created_at']; ?></td>
                <td>
                    <a href="edit_user.php?userId=<?php echo $user['id']; ?>" class="btn btn-primary">Modifier</a>
                    <a href="delete_user.php?userId=<?php echo $user['id']; ?>" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
            </table>
        </div>
    </div>
</div>
<br><br>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

<br><br><br>>
</body>
</html>
