<?php
session_start();

if (!isset($_SESSION['userId']) || $_SESSION['username'] !== 'root') {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['userId'])) {
    header('Location: admin.php');
    exit;
}

$userId = intval($_GET['userId']);

if ($userId === $_SESSION['userId']) {
    header('Location: admin.php?message=CannotDeleteRoot');
    exit;
}

require_once 'config.php';

$sql = "DELETE FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);

if ($stmt->execute()) {
    header('Location: admin.php?message=UserDeleted');
} else {
    header('Location: admin.php?message=ErrorDeletingUser');
}
?>
<doctype html>
    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="styleadm.css">
    </head>
    <body>
    </body>
    </html>
