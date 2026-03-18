<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'patient') {
    header("Location: login.php");
    exit();
}

$patient_id = $_SESSION['user_id'];
$query = "SELECT a.*, u.name as doctor_name FROM appointments a 
          JOIN users u ON a.doctor_id = u.id 
          WHERE a.patient_id = '$patient_id' 
          ORDER BY a.created_at DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings - Sumanyu Ortho</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background: var(--background);">

<nav>
    <a href="index.php" class="logo">Sumanyu Ortho</a>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="book_appointment.php">New Bookings</a></li>
        <li><a href="logout.php" class="btn btn-outline btn-small">Logout</a></li>
    </ul>
</nav>

<div style="padding: 4rem 10%;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2>My Booking History</h2>
        <a href="book_appointment.php" class="btn btn-primary">Book New</a>
    </div>

    <div class="table-container animate">
        <table>
            <thead>
                <tr>
                    <th>Doctor</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Message</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if(mysqli_num_rows($result) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><strong><?php echo $row['doctor_name']; ?></strong></td>
                            <td><?php echo date('M d, Y', strtotime($row['appointment_date'])); ?></td>
                            <td><?php echo date('h:i A', strtotime($row['appointment_time'])); ?></td>
                            <td style="color: var(--text-muted); font-size: 0.9rem;"><?php echo $row['message'] ?: 'No message'; ?></td>
                            <td>
                                <span class="status status-<?php echo $row['status']; ?>">
                                    <?php echo $row['status']; ?>
                                </span>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 2rem;">No bookings found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
