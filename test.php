<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="admin.css" />
    <title>Admin</title>
</head>

<body>
<?php
$db = new PDO('mysql:host=172.19.0.10;port=3306;dbname=user_php;charset=utf8', 'user_php', '1234');


// Get users
$userStatement = $db->prepare("SELECT * FROM users");
$userStatement->execute();

// Replace fetch() with fetchAll()
$users = $userStatement->fetchAll();


?>
<div class="container">
    <div class="components">
        <div class="title">
            <h2>Liste des utilisateurs</h2>
        </div>
        <table class="users-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Genre</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user['PK_user']; ?></td>
                    <td><?php echo $user['prenom']; ?></td>
                    <td><?php echo $user['nom']; ?></td>
                    <td><?php echo $user['genre']; ?></td> <!-- Add this line -->
                    <td><?php echo $user['email']; ?></td>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script>
    const ctx = document.getElementById('registrationChart').getContext('2d');
    const data = {
        labels: <?php echo json_encode($dates); ?>,
        datasets: [{
            label: 'Nombre d\'inscriptions',
            data: <?php echo json_encode($counts); ?>,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        },
            {
                type: 'line',
                label: 'Moyenne',
                data: Array(<?php echo json_encode($counts); ?>.length).fill(<?php echo $average; ?>),
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 1,
        borderDash: [5, 5],
        fill: false
    },
    {
        type: 'line',
            label: '10',
        data: Array(<?php echo json_encode($counts); ?>.length).fill(10),
        borderColor: 'rgba(255, 165, 0, 1)',
        borderWidth: 1,
        borderDash: [5, 5],
        fill: false
    }]
    };
    const options = {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };
    const myChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: options
    });
</script>
</body>

</html>