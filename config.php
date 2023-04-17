<?php
define('DB_SERVER', 'sql966.main-hosting.eu');
define('DB_USERNAME', 'u150008834_sitecubecesi');
define('DB_PASSWORD', '5Csjf*cs3A~w');
define('DB_NAME', 'u150008834_sitecubecesi');

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}
?>
