<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'doctor') {
    header("Location: login.php");
    exit();
}

$doctor_id = $_SESSION['user_id'];

// Handle Status Updates
if (isset($_POST['update_status'])) {
    $appointment_id = mysqli_real_escape_string($conn, $_POST['appointment_id']);
    $new_status = mysqli_real_escape_string($conn, $_POST['status']);
    
    $update_query = "UPDATE appointments SET status = '$new_status' WHERE id = '$appointment_id' AND doctor_id = '$doctor_id'";
    mysqli_query($conn, $update_query);
}

// Fetch Appointments
$query = "SELECT a.*, u.name as patient_name, u.email as patient_email FROM appointments a 
          JOIN users u ON a.patient_id = u.id 
          WHERE a.doctor_id = '$doctor_id' 
          ORDER BY a.created_at DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard - Sumanyu Ortho</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background: var(--background);">

<nav>
    <a href="index.php" class="logo">Sumanyu Ortho</a>
    <ul class="nav-links">
        <li><span style="font-weight: 600; color: var(--text-muted);">Welcome, Dr. <?php echo $_SESSION['user_name']; ?></span></li>
        <li><a href="logout.php" class="btn btn-outline btn-small">Logout</a></li>
    </ul>
</nav>

<div class="dashboard-grid">
    <div class="sidebar">
        <h3 style="margin-bottom: 2rem; color: #64748b;">DASHBOARD</h3>
        <ul>
            <li><a href="doctor_dashboard.php" class="active">All Appointments</a></li>
            <li><a href="index.php">View Website</a></li>
            <li><a href="logout.php">Sign Out</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h2 style="margin-bottom: 2rem;">Manage Appointments</h2>

        <div class="table-container animate">
            <table>
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Email</th>
                        <th>Date & Slot</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($result) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td data-label="Patient Name"><strong><?php echo $row['patient_name']; ?></strong></td>
                                <td data-label="Email" style="font-size: 0.9rem; color: var(--text-muted);"><?php echo $row['patient_email']; ?></td>
                                <td data-label="Date & Slot">
                                    <?php echo date('M d, Y', strtotime($row['appointment_date'])); ?><br>
                                    <span style="font-size: 0.85rem; color: var(--primary); font-weight: 600;">Slot: <?php echo $row['appointment_time']; ?></span>
                                </td>
                                <td data-label="Reason" style="font-size: 0.9rem; max-width: 200px;"><?php echo $row['message'] ?: '-'; ?></td>
                                <td data-label="Status">
                                    <span class="status status-<?php echo $row['status']; ?>">
                                        <?php echo $row['status']; ?>
                                    </span>
                                </td>
                                <td data-label="Actions">
                                    <?php if($row['status'] == 'pending'): ?>
                                        <form method="POST" class="action-btns">
                                            <input type="hidden" name="appointment_id" value="<?php echo $row['id']; ?>">
                                            <input type="hidden" name="update_status" value="1">
                                            <button type="submit" name="status" value="approved" class="btn btn-primary btn-small" style="background: #10b981; border: none;">
                                                Approve
                                            </button>
                                            <button type="submit" name="status" value="rejected" class="btn btn-primary btn-small" style="background: #ef4444; border: none;">
                                                Reject
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <span style="font-size: 0.85rem; color: #94a3b8;">Done</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 2rem;">No appointments yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
