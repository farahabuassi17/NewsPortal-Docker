<?php
session_start();
include("db.php");

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("UPDATE news SET deleted = 0 WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: deleted_new.php?msg=restored");
        exit;
    } else {
        echo "Error restoring news.";
    }
}
?>
