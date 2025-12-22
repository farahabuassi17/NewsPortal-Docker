<?php 
include("db.php"); 
session_start();
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $email = $_POST['email'];
  $password = trim($_POST['password']);
  if (preg_match("/^[0-9]+$/", $name)) {
     echo "<div class='alert alert-danger text-center'>❌ Full name cannot be only numbers." . $conn->error . "</div>";
       
    }  
     else{
           
        $check = $conn->query("SELECT * FROM users WHERE name='$name' OR email='$email'");
        if ($check && $check->num_rows > 0) {
             echo "<div class='alert alert-danger text-center'>❌ This name or email is already registered." . $conn->error . "</div>";
           
        }
       else{     
     $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name','$email','$password')";
     if ($conn->query($sql)) {
        echo "<div class='alert alert-success text-center'>💖 Account created successfully! <a href='index.php'>Login</a></div>";
    } else {
        echo "<div class='alert alert-danger text-center'>❌ Error: " . $conn->error . "</div>";
    }
}
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #fce4ec, #f3e5f5);
            font-family: 'Poppins', sans-serif;
        }
        .card {
            border-radius: 20px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }
        .btn-pink {
            background-color: #ec407a;
            color: white;
        }
        .btn-pink:hover {
            background-color: #f06292;
            color: #fff;
        }
        h2 {
            color: #d81b60;
            font-weight: bold;
        }
        .form-label {
            color: #8e24aa;
            font-weight: 600;
        }
        a {
            color: #e91e63;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="col-md-5">
        <div class="card p-4">
            <div class="card-body">
                <h2 class="text-center mb-4">✨ Create Account ✨</h2>
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="btn btn-pink w-100">Register</button>
                </form>
                <p class="mt-3 text-center">Already have an account? <a href="index.php">Login here</a></p>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
