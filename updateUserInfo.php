<?php
session_start();
require_once 'config.php';

if (isset($_GET['userId']) && isset($_GET['field']) && isset($_GET['value'])) {
    $userId = intval($_GET['userId']);
    $field = $_GET['field'];
    $value = $_GET['value'];

    $allowedFields = ['username', 'email', 'first_name', 'last_name'];

    if (in_array($field, $allowedFields)) {
        $sql = "UPDATE users SET $field = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $value, $userId);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid field']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Missing parameters']);
}
?>
