<?php
session_start();
require_once 'db_connect.php';

$error = "";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role'] = $user['role'];
            
            if ($user['role'] == 'doctor') {
                header("Location: doctor_dashboard.php");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sumanyu Ortho</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%); min-height: 100vh; display: flex; flex-direction: column;">

<nav>
    <a href="index.php" class="logo">Sumanyu Ortho</a>
</nav>

<div class="auth-container animate">
    <h2 style="margin-bottom: 2rem; text-align: center;">Welcome Back</h2>
    
    <?php if($error): ?>
        <p style="color: #ef4444; background: #fee2e2; padding: 0.75rem; border-radius: 0.5rem; margin-bottom: 1rem; text-align: center;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" required placeholder="john@example.com">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required placeholder="••••••••">
        </div>
        <button type="submit" name="login" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Log In</button>
    </form>
    
    <p style="text-align: center; margin-top: 1.5rem; color: var(--text-muted);">
        Don't have an account? <a href="register.php" style="color: var(--primary); font-weight: 600;">Register</a>
    </p>
    
    <div style="margin-top: 2rem; padding-top: 1rem; border-top: 1px solid #e2e8f0; font-size: 0.85rem; color: var(--text-muted); text-align: center;">
        <p>Demo Doctor: doctor@example.com / password</p>
    </div>
</div>

</body>
</html>
