<?php
session_start();
include("db.php");

// التأكد من تسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// استرجاع الخبر إذا ضغط المستخدم Restore
if (isset($_GET['restore_id'])) {
    $restore_id = intval($_GET['restore_id']);
    $conn->query("UPDATE news SET deleted = 0 WHERE id = $restore_id");
    header("Location: deleted_news.php");
    exit;
}

// جلب جميع الأخبار المحذوفة
$res = $conn->query("SELECT news.id, news.title, categories.name AS category, 
                            users.name AS author, news.details, news.image
                     FROM news
                     LEFT JOIN categories ON news.category_id = categories.id
                     LEFT JOIN users ON news.user_id = users.id
                     WHERE news.deleted = 1
                     ORDER BY news.id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Deleted News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8bbd0, #f3e5f5);
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background-color: #d81b60 !important;
        }

        .navbar-brand,
        .nav-link {
            color: white !important;
            font-weight: bold;
        }

        h2 {
            color: #880e4f;
            font-weight: bold;
            margin-top: 20px;
        }

        .btn-restore {
            background-color: #8e24aa;
            color: white;
        }

        .btn-restore:hover {
            background-color: #6a1b9a;
        }

        img {
            border-radius: 6px;
        }
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
                <li class="nav-item"><a class="nav-link" href="new.php">My News</a></li>
                <li class="nav-item"><a class="nav-link" href="deleted_news.php">Deleted News</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <h2>🗑️ Deleted News</h2>
        <div class="card p-4 mt-3 shadow-sm">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Details</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($res && $res->num_rows > 0) {
                        while ($row = $res->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td>{$row['title']}</td>";
                            echo "<td>{$row['category']}</td>";
                            echo "<td>{$row['author']}</td>";
                            echo "<td>" . substr($row['details'], 0, 50) . "...</td>";
                            echo "<td>";
                            if (!empty($row['image']))
                                echo "<img src='uploads/{$row['image']}' width='80'>";
                            else
                                echo "No Image";
                            echo "</td>";
                            echo "<td>
                                <a href='deleted_news.php?restore_id={$row['id']}' 
                                   class='btn btn-sm btn-restore'
                                   onclick='return confirm(\"Do you want to restore this news?\");'>
                                   Restore
                                </a>
                              </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center text-muted'>No deleted news found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>