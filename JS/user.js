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