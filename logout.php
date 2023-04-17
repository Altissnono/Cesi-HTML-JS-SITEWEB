<?php
session_start();

// Détruire la session et toutes les variables de session
session_unset();
session_destroy();

// Rediriger vers la page de connexion
header('Location: login.php');
exit;
?>
