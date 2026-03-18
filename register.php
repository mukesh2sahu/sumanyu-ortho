<?php
session_start();
require_once 'db_connect.php';

$error = "";
$success = "";

if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Check if email already exists
    $check_email = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check_email) > 0) {
        $error = "Email already registered!";
    } else {
        $query = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', 'patient')";
        if (mysqli_query($conn, $query)) {
            $success = "Registration successful! You can now <a href='login.php'>Login</a>";
        } else {
            $error = "Registration failed!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sumanyu Ortho</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%); min-height: 100vh; display: flex; flex-direction: column;">

<nav>
    <a href="index.php" class="logo">Sumanyu Ortho</a>
</nav>

<div class="auth-container animate">
    <h2 style="margin-bottom: 2rem; text-align: center;">Join Sumanyu Ortho</h2>
    
    <?php if($error): ?>
        <p style="color: #ef4444; background: #fee2e2; padding: 0.75rem; border-radius: 0.5rem; margin-bottom: 1rem; text-align: center;"><?php echo $error; ?></p>
    <?php endif; ?>
    
    <?php if($success): ?>
        <p style="color: #10b981; background: #d1fae5; padding: 0.75rem; border-radius: 0.5rem; margin-bottom: 1rem; text-align: center;"><?php echo $success; ?></p>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label>FullName</label>
            <input type="text" name="name" required placeholder="John Doe">
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" required placeholder="john@example.com">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required placeholder="••••••••">
        </div>
        <button type="submit" name="register" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Register Now</button>
    </form>
    
    <p style="text-align: center; margin-top: 1.5rem; color: var(--text-muted);">
        Already have an account? <a href="login.php" style="color: var(--primary); font-weight: 600;">Log in</a>
    </p>
</div>

</body>
</html>
