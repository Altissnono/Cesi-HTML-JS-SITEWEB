<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Formulaire de contact</title>
    <style>
    /* Définir les couleurs de base */
:root {
  --primary-color: #3498db;
  --secondary-color: #2980b9;
  --text-color: #333;
}
.error-message {
  color: red;
}
/* Appliquer les couleurs de base */
body {
  background-color: #f7f7f7;
  color: var(--text-color);
  font-family: sans-serif;
}

/* Centrer le formulaire */
form {
  display: flex;
  flex-direction: column;
  align-items: center;
  max-width: 600px;
  margin: 0 auto;
  padding: 2em;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  background-color: #fff;
}

/* Style des champs de formulaire */
label {
  display: block;
  margin-bottom: 0.5em;
  font-weight: bold;
}

input[type="text"],
input[type="email"],
textarea {
  margin-bottom: 1em;
  padding: 0.5em;
  width: 100%;
  border: 1px solid #ccc;
  border-radius: 3px;
  font-size: 1em;
}

textarea {
  resize: vertical;
}
nav {
  background-color: #f2f2f2;
  overflow: hidden;
}

nav ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

nav li {
  float: left;
}

nav li a {
  display: block;
  color: #333;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

nav li a:hover {
  background-color: #ddd;
}

nav li a.active {
  background-color: #4CAF50;
  color: white;
}


input[type="submit"] {
  margin-top: 1em;
  padding: 0.5em 1em;
  background-color: var(--primary-color);
  color: #fff;
  border: none;
  border-radius: 3px;
  font-size: 1em;
  cursor: pointer;
  transition: background-color 0.3s ease-in-out;
}

input[type="submit"]:hover {
  background-color: var(--secondary-color);
}
    </style>
  </head>
<body>
<nav>
<ul>
  <li><a href="contact.php">Contact</a></li>
  <li><a href="connexion.php">Connexion</a></li>
  <li><a href="inscription.php">Inscription</a></li>
</ul>
</nav>
  <h1>Contactez-nous</h1>
  <form id="contact-form" action="#" method="POST">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" placeholder="Entrez votre nom" required pattern="[a-zA-ZÀ-ÿ\s]+$">
    <span class="error" id="nom-error"></span>
    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom" required pattern="[a-zA-ZÀ-ÿ\s]+$">
    <span class="error" id="prenom-error"></span>
    
    <label for="email">Email :</label>
    <input type="email" id="email" name="email" placeholder="Ename@example.com" required>
    <span class="error" id="email-error"></span>
    
    <label for="sujet">Sujet :</label>
    <input type="text" id="sujet" name="sujet"  required>
    <span class="error" id="sujet-error"></span>
    
    <label for="message">Message :</label>
    <textarea id="message" name="message" rows="5" required></textarea>
    <span class="error" id="message-error"></span>
    
    <input type="submit" value="Envoyer">
  </form>
  <div id="success-message"></div>
  <script>
    const form = document.getElementById("contact-form");
    const nom = document.getElementById("nom");
    const prenom = document.getElementById("prenom");
    const email = document.getElementById("email");
    const sujet = document.getElementById("sujet");
    const message = document.getElementById("message");
    const nomError = document.getElementById("nom-error");
    const prenomError = document.getElementById("prenom-error");
    const emailError = document.getElementById("email-error");
    const sujetError = document.getElementById("sujet-error");
    const messageError = document.getElementById("message-error");
    const successMessage = document.getElementById("success-message");

    form.addEventListener("submit", function(event) {
      event.preventDefault();
      let isValid = true;
      if (!nom.value.match(/[a-zA-ZÀ-ÿ\s]+$/)) {
    nomError.textContent = "Nom invalide";
    nomError.style.display = "block";
    nom.style.borderColor = "red";
    isValid = false;
  } else {
    nomError.style.display = "none";
    nom.style.borderColor = "";
  }

  if (!prenom.value.match(/[a-zA-ZÀ-ÿ\s]+$/)) {
    prenomError.textContent = "Prénom invalide";
    prenomError.style.display = "block";
    prenom.style.borderColor = "red";
    isValid = false;
  } else {
    prenomError.style.display = "none";
    prenom.style.borderColor = "";
  }

  if (!email.value.match(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/)) {
    emailError.textContent = "Email invalide";
    emailError.style.display = "block";
    email.style.borderColor = "red";
    isValid = false;
  } else {
    emailError.style.display = "none";
    email.style.borderColor = "";
  }

  if (sujet.value.trim() === "") {
    sujetError.textContent = "Veuillez entrer un sujet";
    sujetError.style.display = "block";
    sujet.style.borderColor = "red";
    isValid = false;
  } else {
    sujetError.style.display = "none";
    sujet.style.borderColor = "";
  }

  if (message.value.trim() === "") {
    messageError.textContent = "Veuillez entrer un message";
    messageError.style.display = "block";
    message.style.borderColor = "red";
    isValid = false;
  } else {
    messageError.style.display = "none";
    message.style.borderColor = "";
  }

  if (isValid) {
    successMessage.textContent = "Formulaire envoyé !";
    successMessage.style.display = "block";
    nom.value = "";
    prenom.value = "";
    email.value = "";
    sujet.value = "";
    message.value = "";
  }
});
  
</script>
  </body>
</html>
