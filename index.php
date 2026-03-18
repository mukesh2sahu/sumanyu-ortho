<?php
session_start();
require_once 'db_connect.php';

// Fetch doctor info for portfolio
$doctor_query = "SELECT * FROM users WHERE role = 'doctor' LIMIT 1";
$doctor_result = $conn->query($doctor_query);
$doctor = $doctor_result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sumanyu Ortho - Premium Orthopedic Care</title>
    <meta name="description" content="Book your appointment with Dr. Sumanyu Sahu, the leading orthopedic surgeon for joint replacements and sports medicine.">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <a href="index.php" class="logo">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-activity"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
        Sumanyu Ortho
    </a>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="#portfolio">Doctor Portfolio</a></li>
        <?php if(isset($_SESSION['user_id'])): ?>
            <?php if($_SESSION['role'] == 'doctor'): ?>
                <li><a href="doctor_dashboard.php">Dashboard</a></li>
            <?php else: ?>
                <li><a href="my_appointments.php">My Bookings</a></li>
            <?php endif; ?>
            <li><a href="logout.php" class="btn btn-outline btn-small">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php" class="btn btn-outline btn-small">Login</a></li>
            <li><a href="register.php" class="btn btn-primary btn-small">Register</a></li>
        <?php endif; ?>
    </ul>
</nav>

<section class="hero animate">
    <div class="hero-content">
        <p>RESTORING MOBILITY, RECLAIMING LIFE</p>
        <h1>Expert Orthopedic Care <span>Tailored for You</span></h1>
        <p>Specialized treatments in joint replacement, sports injuries, and advanced orthopedic surgery using the latest medical technologies.</p>
        <div class="hero-btns">
            <a href="register.php" class="btn btn-primary">Get Started</a>
            <a href="#portfolio" class="btn btn-outline" style="margin-left: 1rem;">View Portfolio</a>
        </div>
    </div>
    <div class="hero-image">
        <img src="images/hero.png" alt="Hospital Care">
    </div>
</section>

<section id="portfolio" class="portfolio animate">
    <div class="section-title">
        <p>Meet Our Expert</p>
        <h2>Doctor's Portfolio</h2>
    </div>

    <?php if($doctor): ?>
    <div class="doctor-card">
        <div class="doctor-img">
            <img src="images/doctor.png" alt="<?php echo $doctor['name']; ?>" style="width: 100%; border-radius: 1rem;">
        </div>
        <div class="doctor-info">
            <h3><?php echo $doctor['name']; ?></h3>
            <p class="specialty"><?php echo $doctor['specialization']; ?></p>
            <p><?php echo $doctor['experience']; ?></p>
            
            <div class="experience">
                <strong>Expertise:</strong>
                <ul>
                    <li>Advanced Joint Replacements</li>
                    <li>Minimally Invasive Surgery</li>
                    <li>Sports Medicine & Rehabilitation</li>
                </ul>
            </div>
            
            <?php if(isset($_SESSION['user_id']) && $_SESSION['role'] == 'patient'): ?>
                <a href="book_appointment.php" class="btn btn-primary" style="margin-top: 2rem;">Book Appointment Now</a>
            <?php elseif(!isset($_SESSION['user_id'])): ?>
                <a href="login.php" class="btn btn-primary" style="margin-top: 2rem;">Login to Book Appointment</a>
            <?php endif; ?>
        </div>
    </div>
    <?php else: ?>
        <p style="text-align: center;">Doctor information not available.</p>
    <?php endif; ?>
</section>

<footer style="padding: 4rem 10%; background: var(--secondary); color: var(--white); text-align: center;">
    <p>&copy; <?php echo date('Y'); ?> Sumanyu Ortho. All rights reserved.</p>
</footer>

</body>
</html>
