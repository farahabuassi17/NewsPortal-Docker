<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'] ?? 0;

// جلب بيانات الخبر
$res = $conn->query("SELECT * FROM news WHERE id=$id");
if ($res->num_rows == 0) {
    header("Location: new.php");
    exit;
}
$news = $res->fetch_assoc();

// جلب الفئات
$categories = $conn->query("SELECT * FROM categories");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $category_id = $_POST['category'];
    $details = $_POST['details'];

    // تحديث الصورة إذا تم رفع جديدة
    $image_name = $news['image'];
    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image_name);
    }

    $sql = "UPDATE news SET title='$title', category_id=$category_id, details='$details', image='$image_name' WHERE id=$id";

    if ($conn->query($sql)) {
        $success = "News updated successfully!";
        $news['title'] = $title;
        $news['category_id'] = $category_id;
        $news['details'] = $details;
        $news['image'] = $image_name;
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #fce4ec, #e1bee7);
            font-family: 'Poppins', sans-serif;
        }

        .card {
            border-radius: 20px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-pink {
            background-color: #d81b60;
            color: white;
        }

        .btn-pink:hover {
            background-color: #ec407a;
            color: white;
        }

        .navbar {
            background-color: #d81b60 !important;
        }

        .navbar-brand,
        .nav-link {
            color: white !important;
            font-weight: bold;
        }

        .nav-link:hover {
            color: #fce4ec !important;
        }

        h2 {
            color: #ad1457;
            font-weight: bold;
            margin-top: 20px;
        }

        .alert {
            margin-top: 15px;
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
                <li class="nav-item"><a class="nav-link" href="dashboard.php">My News</a></li>
                <li class="nav-item"><a class="nav-link" href="deleted_news.php">Deleted News</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    
    <div class="container mt-4">
        <h2>Edit News</h2>
        <div class="card p-4 mt-3">
            <?php if (!empty($success))
                echo "<div class='alert alert-success'>$success</div>"; ?>
            <?php if (!empty($error))
                echo "<div class='alert alert-danger'>$error</div>"; ?>

            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control"
                        value="<?= htmlspecialchars($news['title']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-select" required>
                        <?php while ($row = $categories->fetch_assoc()) {
                            $selected = $row['id'] == $news['category_id'] ? "selected" : "";
                            echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
                        } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Details</label>
                    <textarea name="details" class="form-control" rows="5"
                        required><?= htmlspecialchars($news['details']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Image (optional)</label>
                    <input type="file" name="image" class="form-control">
                    <?php if (!empty($news['image']))
                        echo "<img src='uploads/" . $news['image'] . "' width='100' class='mt-2 rounded'>"; ?>
                </div>
                <button type="submit" class="btn btn-pink w-100">Update News</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>