<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
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
    </style>
</head>
<body>
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
                            <a class="nav-link" href="user.php">information</a>
                          </li>
                          </ul>
                        
                        </div>
                    </div>
                </nav>
              </header>
              <br><br>
                        <div class="container">
                        <form action="signup.php" method="POST">
                                <div class="mb-3">
                                  <label for="username" class="form-label"><b>Nom d'utilisateur</b></label>
                                  <input type="text" class="form-control" placeholder="Entrez votre nom d'utilisateur" name="username" required oninput="checkUsername()">
                                  <div class="error-message" id="username-error"></div>
                                </div>
                                <div class="mb-3">
                                  <label for="email" class="form-label"><b>Email</b></label>
                                  <input type="email" class="form-control" placeholder="Entrez votre email" name="email" required oninput="checkEmail()">
                                  <div class="error-message" id="email-error"></div>
                                </div>
                                <div class="mb-3">
                                  <label for="password" class="form-label"><b>Mot de passe</b></label>
                                  <input type="password" class="form-control" placeholder="Entrez votre mot de passe" name="password" required oninput="checkPassword()">
                                  <div class="error-message" id="password-error"></div>
                                </div>
                                <div class="mb-3">
                                  <label for="confirm-password" class="form-label"><b>Confirmez le mot de passe</b></label>
                                  <input type="password" class="form-control" placeholder="Entrez à nouveau votre mot de passe" name="confirm-password" required oninput="checkConfirmPassword()">
                                  <div class="error-message" id="confirm-password-error"></div>
                                </div>
                                <button type="submit" class="btn btn-primary">S'inscrire</button>
                              </form>                              
                        </div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
                        <script>
                            function checkUsername() {
                                const usernameInput =document.getElementsByName("username")[0];
                                const usernameError = document.getElementById("username-error");

                                if (usernameInput.value.length < 3) {
                                    usernameInput.classList.add("is-invalid");
                                    usernameError.innerHTML = "Le nom d'utilisateur doit comporter au moins 3 caractères";
                                    return false;
                                } else if (/^[a-zA-Z0-9]+$/.test(usernameInput.value) === false) {
                                    usernameInput.classList.add("is-invalid");
                                    usernameError.innerHTML = "Le nom d'utilisateur ne peut contenir que des caractères alphanumériques";
                                    return false;
                                } else {
                                    usernameInput.classList.remove("is-invalid");
                                    usernameInput.classList.add("is-valid");
                                    usernameError.innerHTML = "";
                                    return true;
                                }
                            }
                            function checkEmail() {
                                const emailInput = document.getElementsByName("email")[0];
                                const emailError = document.getElementById("email-error");

                                // regular expression for email validation
                                const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

                                if (!emailRegex.test(emailInput.value)) {
                                    emailInput.classList.add("is-invalid");
                                    emailError.innerHTML = "Veuillez entrer une adresse email valide";
                                    return false;
                                } else {
                                    emailInput.classList.remove("is-invalid");
                                    emailInput.classList.add("is-valid");
                                    emailError.innerHTML = "";
                                    return true;
                                }
                            }

                            function checkPassword() {
                                const passwordInput = document.getElementsByName("password")[0];
                                const passwordError = document.getElementById("password-error");

                                if (passwordInput.value.length < 6) {
                                    passwordInput.classList.add("is-invalid");
                                    passwordError.innerHTML = "Le mot de passe doit comporter au moins 6 caractères et doit contenir une majuscule, une minuscule et un chiffre";
                                    return false;
                                } else {
                                    passwordInput.classList.remove("is-invalid");
                                    passwordInput.classList.add("is-valid");
                                    passwordError.innerHTML = "";
                                    return true;
                                }
                            }

                            function checkConfirmPassword() {
                                const passwordInput = document.getElementsByName("password")[0];
                                const confirmPasswordInput = document.getElementsByName("confirm-password")[0];
                                const confirmPasswordError = document.getElementById("confirm-password-error");

                                if (passwordInput.value !== confirmPasswordInput.value) {
                                    confirmPasswordInput.classList.add("is-invalid");
                                    confirmPasswordError.innerHTML = "Les deux mots de passe ne correspondent pas";
                                    return false;
                                } else {
                                    confirmPasswordInput.classList.remove("is-invalid");
                                    confirmPasswordInput.classList.add("is-valid");
                                    confirmPasswordError.innerHTML = "";
                                    return true;
                                }
                            }

                            function validateForm() {
                            const usernameInput = document.getElementsByName("username")[0];
                            const emailInput = document.getElementsByName("email")[0];
                            const passwordInput = document.getElementsByName("password")[0];
                            const confirmPasswordInput = document.getElementsByName("confirm-password")[0];

                            // check if any input is invalid
                            if (checkUsername() && checkEmail() && checkPassword() && checkConfirmPassword()) {
                                // all inputs are valid
                                sessionStorage.setItem("username", usernameInput.value);
                                sessionStorage.setItem("id", 100);
                                window.location.href = "login.php";
                                return true;
                            } else {
                                console.error("La redirection a échoué");
                                return false;
                            }
                        }



            </script>
</body>
</html>


                            
