<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'patient') {
    header("Location: login.php");
    exit();
}

$success = "";
$error = "";

// Get doctor ID (in this simple version, we take the first doctor)
$doctor_query = "SELECT id, name FROM users WHERE role = 'doctor' LIMIT 1";
$doctor_result = $conn->query($doctor_query);
$doctor = $doctor_result->fetch_assoc();

if (isset($_POST['book'])) {
    $patient_id = $_SESSION['user_id'];
    $doctor_id = $doctor['id'];
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    $query = "INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time, message) 
              VALUES ('$patient_id', '$doctor_id', '$date', '$time', '$message')";
    
    if (mysqli_query($conn, $query)) {
        $success = "Appointment request sent successfully! Waiting for doctor's approval.";
    } else {
        $error = "Failed to book appointment. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment - Sumanyu Ortho</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <a href="index.php" class="logo">Sumanyu Ortho</a>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="my_appointments.php">My Bookings</a></li>
        <li><a href="logout.php" class="btn btn-outline btn-small">Logout</a></li>
    </ul>
</nav>

<div class="auth-container animate" style="max-width: 600px;">
    <h2 style="margin-bottom: 2rem;">Book an Appointment</h2>
    <p style="margin-bottom: 2rem; color: var(--text-muted);">Requesting appointment with <strong><?php echo $doctor['name']; ?></strong></p>

    <?php if($success): ?>
        <div style="background: #d1fae5; color: #10b981; padding: 1rem; border-radius: 0.5rem; margin-bottom: 2rem;">
            <?php echo $success; ?>
            <br><br>
            <a href="my_appointments.php" class="btn btn-primary btn-small">View My Bookings</a>
        </div>
    <?php elseif($error): ?>
        <p style="color: #ef4444; background: #fee2e2; padding: 0.75rem; border-radius: 0.5rem; margin-bottom: 1rem;"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if(!$success): ?>
    <form method="POST">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group">
                <label>Preferred Date</label>
                <input type="date" name="date" required min="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="form-group">
                <label>Preferred Time</label>
                <input type="time" name="time" required>
            </div>
        </div>
        <div class="form-group">
            <label>Reason / Message (Optional)</label>
            <textarea name="message" rows="4" placeholder="Briefly describe your condition..."></textarea>
        </div>
        <button type="submit" name="book" class="btn btn-primary" style="width: 100%; padding: 1rem;">Send Booking Request</button>
    </form>
    <?php endif; ?>
</div>

</body>
</html>
