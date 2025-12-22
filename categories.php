<?php
session_start();
include("db.php");

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #fce4ec, #e1bee7);
            font-family: 'Poppins', sans-serif;
        }
        .navbar {
            background-color: #d81b60 !important;
        }
        .navbar-brand, .nav-link {
            color: white !important;
            font-weight: bold;
        }
        .nav-link:hover { color: #fce4ec !important; }

        h2 {
            color: #ad1457;
            font-weight: bold;
            margin-top: 20px;
        }

        .btn-edit { background-color: #ab47bc; color: white; }
        .btn-edit:hover { background-color: #ba68c8; }

        .btn-delete { background-color: #d81b60; color: white; }
        .btn-delete:hover { background-color: #ec407a; }

        table th { background-color: #f8bbd0; color: #880e4f; }
    </style>
</head>
<body>

<!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">💖 My News Dashboard</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="add_category.php">Add Category</a></li>
                <li class="nav-item"><a class="nav-link" href="categories.php">View Categories</a></li>
                <li class="nav-item"><a class="nav-link" href="add_news.php">Add News</a></li>
                <li class="nav-item"><a class="nav-link" href="dashboard.php">My News</a></li>
                <li class="nav-item"><a class="nav-link" href="deleted_news.php">Deleted News</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
<div class="container mt-4">
    <h2>All Categories</h2>
    <div class="card p-3 mt-3">
        <?php
        $res = $conn->query("SELECT * FROM categories ORDER BY id DESC");
        if ($res && $res->num_rows > 0) {
            echo "<table class='table table-striped table-hover'>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>";
            while ($row = $res->fetch_assoc()) {
                echo "<tr>
                    <td>".$row['id']."</td>
                    <td>".$row['name']."</td>
                    <td>
                        <a href='edit_category.php?id=".$row['id']."' class='btn btn-sm btn-edit'>Edit</a>
                        <a href='delete_category.php?id=".$row['id']."' class='btn btn-sm btn-delete' onclick='return confirm(\"Are you sure you want to delete this category?\");'>Delete</a>
                    </td>
                </tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='text-muted'>No categories found.</p>";
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
