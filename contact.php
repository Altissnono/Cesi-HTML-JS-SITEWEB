<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page de contact</title>
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
        select {
            background-color: #2c2c2c;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 16px;
            margin-top: 10px;
        }
        option {
            background-color: #2c2c2c;
            color: white;
        }
        #userMessage, #emailMessage {
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
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #2ecc71;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            animation: bounce 1s ease-in-out;
            animation-fill-mode: both;
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
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
                    <?php if (isset($_SESSION['userId'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="user.php">Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Déconnexion</a>
                        </li>
                    <?php } else { ?>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
<br><br>
<div class="container">
    <form onsubmit="return onSubmit(event)">
        <div class="mb-3">
            <label for="uname" class="form-label"><b>Nom</b></label>
            <input type="text" class="form-control" placeholder="Entrez votre nom d'utilisateur" name="uname" required oninput="checkUsername()">
            <div id="userMessage"></div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label"><b>Email</b></label>
            <input type="text" class="form-control" placeholder="Entrez votre email" name="email" required oninput="checkEmail()">
            <div id="emailMessage"></div>
        </div>
        <div class="mb-3">
            <label for="subject" class="form-label"><b>Sujet</b></label>
            <select class="form-select" name="subject">
                <option value="" disabled selected>Choisissez un sujet</option>
                <option value="maison">Maison</option>
                <option value="porte">Porte</option>
                <option value="sprite">Sprite</option>
                <option value="<EUGPSCoordinates>click">Click</EUGPSCoordinates></option>
            </select>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label"><b>Message</b></label>
            <textarea class="form-control" name="message" rows="5" placeholder=""></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Envoyer le message</button>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.min.js"></script>
<script>
    function onSubmit(event) {
        event.preventDefault();
        const notification = document.createElement('div');
        notification.classList.add('notification');
        notification.innerText = 'Form submitted!';
        document.body.appendChild(notification);
        setTimeout(() => {
            notification.remove();
        }, 3000);
        document.querySelector('form').reset();
    }

    function checkUsername() {
        let usernameInput = document.querySelector('input[name="uname"]');
        let usernameValue = usernameInput.value;
        let specialChars = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
        let messageBox = document.querySelector('#userMessage');

        if (specialChars.test(usernameValue)) {
            messageBox.innerHTML = "Le nom d'utilisateur ne doit pas contenir de caractères spéciaux";
            usernameInput.classList.add("is-invalid");
            return false;
        } else {
            messageBox.innerHTML = "";
            usernameInput.classList.remove("is-invalid");
            return true;
        }
    }

    function checkEmail() {
        let emailInput = document.querySelector('input[name="email"]');
        let emailValue = emailInput.value;
        let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        let messageBox = document.querySelector('#emailMessage');

        if (!regex.test(emailValue)) {
            messageBox.innerHTML = "L'email n'est pas valide";
            emailInput.classList.add("is-invalid");
            return false;
        } else {
            messageBox.innerHTML = "";
            emailInput.classList.remove("is-invalid");
            return true;
        }
    }

    function logout() {
        sessionStorage.removeItem('authToken');
        window.location.href = 'login.php';
    }

    // Vérification de la session utilisateur
    <?php if (!isset($_SESSION['userId'])) { ?>
    document.querySelector('form').style.display = "none";
    <?php } ?>
</script>
</body>
