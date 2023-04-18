<?php
session_start();
if (!isset($_SESSION['userId'])) {
  header('Location: login.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Compte utilisateur</title>
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
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
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

        .notification.red bouncy {
          animation: bounce 1s ease-out;
        }

        @keyframes bounce {
          0% {
            transform: translate(0, 0);
          }
          50% {
            transform: translate(0, -10px);
          }
          100% {
            transform: translate(0, 0);
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
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Déconnexion</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <div id="user-info" class="container mt-5">
      <h1>Informations du compte</h1>
      <form id="user-form">
        <div class="mb-3">
          <label for="username" class="form-label">Nom d'utilisateur</label>
          <input type="text" class="form-control" id="username" readonly>
          <button type="button" class="btn btn-primary mt-2" id="edit-username" onclick="editField('username')">Modifier</button>
          <button type="button" class="btn btn-success mt-2 d-none" id="save-username" onclick="saveField('username')">Sauvegarder</button>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" readonly>
          <button type="button" class="btn btn-primary mt-2" id="edit-email" onclick="editField('email')">Modifier</button>
          <button type="button" class="btn btn-success mt-2 d-none" id="save-email" onclick="saveField('email')">Sauvegarder</button>
        </div>
        <div class="mb-3">
          <label for="first-name" class="form-label">Prénom</label>
          <input type="text" class="form-control" id="first-name" readonly>
          <button type="button" class="btn btn-primary mt-2" id="edit-first-name" onclick="editField('first-name')">Modifier</button>
          <button type="button" class="btn btn-success mt-2 d-none" id="save-first-name" onclick="saveField('first-name')">Sauvegarder</button>
        </div>
        <div class="mb-3">
          <label for="last-name" class="form-label">Nom de famille</label>
          <input type="text" class="form-control" id="last-name" readonly>
          <button type="button" class="btn btn-primary mt-2" id="edit-last-name" onclick="editField('last-name')">Modifier</button>
          <button type="button" class="btn btn-success mt-2 d-none" id="save-last-name" onclick="saveField('last-name')">Sauvegarder</button>
        </div>
        <div class="mb-3">
          <label for="created-at" class="form-label">Date de création</label>
          <input type="text" class="form-control" id="created-at" readonly>
        </div>
      </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
      const originalValues = {};
      // Vérification de la session utilisateur
      <?php if (!isset($_SESSION['userId'])) { ?>
      // Le code reste inchangé
      <?php } else { ?>
      const userId = <?php echo $_SESSION['userId']; ?>;
      fetch(`getUserInfo.php?userId=${userId}`)
          .then((response) => response.json())
          .then((data) => {
            document.querySelector("#username").value = data.username;
            document.querySelector("#email").value = data.email;
            document.querySelector("#first-name").value = data.first_name;
            document.querySelector("#last-name").value = data.last_name;
            document.querySelector("#created-at").value = data.created_at;
          });

      function editField(fieldId) {
        originalValues[fieldId] = document.querySelector(`#${fieldId}`).value;
        document.querySelector(`#${fieldId}`).readOnly = false;
        document.querySelector(`#edit-${fieldId}`).classList.add('d-none');
        document.querySelector(`#save-${fieldId}`).classList.remove('d-none');
      }

      function saveField(fieldId) {
        const fieldValue = document.querySelector(`#${fieldId}`).value;
        const dbFieldId = fieldId.replace(/-/g, '_');
        fetch(`updateUserInfo.php?userId=${userId}&field=${dbFieldId}&value=${fieldValue}`)
            .then((response) => {
              if (!response.ok) {
                console.error(`HTTP error! status: ${response.status}`);
                console.error(`Response: ${JSON.stringify(response)}`);
              }
              return response.json();
            })
            .then((data) => {
              console.log(`Returned data: ${JSON.stringify(data)}`);
              if (data.success) {
                document.querySelector(`#${fieldId}`).readOnly = true;
                document.querySelector(`#edit-${fieldId}`).classList.remove('d-none');
                document.querySelector(`#save-${fieldId}`).classList.add('d-none');

                // Send a Discord embed message via webhook
                const webhookUrl = "https://discord.com/api/webhooks/1097852594434625637/faCahX8zwHKLIsf_sR5gP5WlyIvkbC-Ch-oozCsjCho1g4XI2pkGe9i4TSuM2vh_BSJd";
                const embed = {
                  title: "Modification d'utilisateur",
                  description: `Le champ ${fieldId} a été modifié pour l'utilisateur avec l'ID ${userId}.`,
                  fields: [
                    {
                      name: "ID",
                      value: userId
                    },
                    {
                      name: "Nom",
                      value: document.querySelector("#last-name").value
                    },
                    {
                      name: "Prénom",
                      value: document.querySelector("#first-name").value
                    },
                    {
                      name: "Email",
                      value: document.querySelector("#email").value
                    },
                    {
                      name: "Date de création",
                      value: document.querySelector("#created-at").value
                    },
                    {
                      name: "Modification apportée",
                      value: `${fieldId.replace(/_/g, '-')} : ${originalValues[fieldId]} -> ${fieldValue}`
                    },
                    {
                      name: "Heure de modification",
                      value: new Date().toLocaleString()
                    }
                  ],
                  timestamp: new Date().toISOString(),
                  color: 0xff0000
                };

                const payload = {
                  embeds: [embed]
                };

                fetch(webhookUrl, {
                  method: 'POST',
                  headers: {
                    'Content-Type': 'application/json'
                  },
                  body: JSON.stringify(payload)
                })
                    .then((response) => {
                      if (!response.ok) {
                        console.error(`HTTP error! status: ${response.status}`);
                        console.error(`Response: ${JSON.stringify(response)}`);
                      }
                      return response.json();
                    })
                    .then((data) => {
                      console.log(`Returned data: ${JSON.stringify(data)}`);
                    })
                    .catch((error) => {
                      console.error("Error:", error);
                    });
              } else {
                alert("Erreur lors de la mise à jour des informations.");
              }
            })
            .catch((error) => {
              console.error("Error:", error);
            });
      }
      <?php } ?>
    </script>
  </body>
</html>