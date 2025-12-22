<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // التحقق إذا كان التصنيف مرتبط بأخبار
    $check = $conn->query("SELECT COUNT(*) as count FROM news WHERE category_id = $id");
    $row = $check->fetch_assoc();

    if ($row['count'] > 0) {
        echo "<script>
                alert('⚠️ Cannot delete this category because it is linked to existing news.');
                window.location.href='categories.php';
              </script>";
        exit;
    }

    // إذا ما في أخبار مرتبط احذف
    $sql = "DELETE FROM categories WHERE id = $id";
    if ($conn->query($sql)) {
        header("Location: categories.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    header("Location: categories.php");
    exit;
}
