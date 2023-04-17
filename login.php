<?php
session_start();

// Vérifier si le formulaire a été soumis
if (isset($_POST['submit'])) {

    // Vérifier si les champs ont été remplis
    if (empty($_POST['uname']) || empty($_POST['psw'])) {
        $error_message = 'Veuillez remplir tous les champs.';
    } else {
        $username = $_POST['uname'];
        $password = $_POST['psw'];

        // Connexion à la base de données
        $host = 'sql966.main-hosting.eu';
        $db_user = 'u150008834_sitecubecesi';
        $db_password = '5Csjf*cs3A~w';
        $db_name = 'u150008834_sitecubecesi';

        $connection = new mysqli($host, $db_user, $db_password, $db_name);

        if ($connection->connect_error) {
            die('Erreur de connexion: ' . $connection->connect_error);
        }

        // Préparation et exécution de la requête SQL
        $sql = "SELECT id, password FROM users WHERE username = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['id'];
            $hashed_password = $row['password'];

            if (password_verify($password, $hashed_password)) {
                // Stocker l'ID utilisateur dans la session
                $_SESSION['userId'] = $user_id;

                // Stocker l'username dans la session
                $_SESSION['username'] = $username;


                // Rediriger vers la page de contact
                header('Location: contact.php');
                exit;
            } else {
                $error_message = 'Nom d\'utilisateur ou mot de passe incorrect.';
            }
        } else {
            $error_message = 'Nom d\'utilisateur ou mot de passe incorrect.';
        }

        $stmt->close();
        $connection->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page de connexion</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            background-color: #1c1c1c;
            color: white;
        }
        form {
            max-width: 400px;
            margin: auto;
            background-color: #2c2c2c;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.2);
            animation: fadeIn 1s ease-in-out;
        }
        button[type="submit"] {
            background-color: #35b5ff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 16px;
            margin-top: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }
        button[type="submit"]:hover {
            background-color: #007bff;
        }
        .form-check-input:checked {
            background-color: #35b5ff;
            border-color: #35b5ff;
        }
        .form-check-input:checked:after {
            content: '';
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            width: 8px;
            height: 8px;
            background-color: white;
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }
        #userMessage {
            color: red;
            font-size: 14px;
            margin-top: 10px;
            animation: shake 0.5s ease-in-out;
        }
        @keyframes shake {
            0%, 100% {
                transform: translateX(0);
            }
            10%, 30%, 50%, 70%, 90% {
                transform: translateX(-10px);
            }
            20%, 40%, 60%, 80% {
                transform: translateX(10px);
            }
        }
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
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
                        <a class="nav-link" href="login.php">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="scription.php">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user.php">Information</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    echo $error_message; ?>
                </div>
            <?php endif; ?>
            <form action="login.php" method="post" onsubmit="return validateForm()">
                <div class="mb-3">
                    <label for="uname" class="form-label"><b>Nom d'utilisateur</b></label>
                    <input type="text" class="form-control" placeholder="Entrez votre nom d'utilisateur" name="uname" required oninput="checkUsername()">
                    <div id="userMessage"></div>
                </div>
                <div class="mb-3">
                    <label for="psw" class="form-label"><b>Mot de passe</b></label>
                    <input type="password" class="form-control" placeholder="Entrez votre mot de passe" name="psw" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-block">Connexion</button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.min.js"></script>
<script>
    function checkUsername() {
        let usernameInput = document.querySelector('input[name="uname"]');
        let usernameValue = usernameInput.value;
        let specialChars = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
        let messageBox = document.querySelector('#userMessage');

        if (specialChars.test(usernameValue)) {
            messageBox.innerHTML = "<span style='color: red;'>Le nom d'utilisateur ne doit pas contenir de caractères spéciaux</span>";
            usernameInput.classList.add("is-invalid");
            return false;
        } else {
            messageBox.innerHTML = "";
            usernameInput.classList.remove("is-invalid");
            return true;
        }
    }

    function validateForm() {
        let isUsernameValid = checkUsername();
        if (!isUsernameValid) {
            return false;
        }
        return true;
    }
</script>
<script>
    if (sessionStorage.getItem('userId')) {
        window.location.replace('contact.php');
    }
    if (localStorage.getItem('userId')) {
        window.location.replace('contact.php');
    }

</script>
</body>
</html>


