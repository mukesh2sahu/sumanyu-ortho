-- Database for Doctor Booking Website
CREATE DATABASE IF NOT EXISTS sumanyu_ortho;
USE sumanyu_ortho;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('patient', 'doctor') DEFAULT 'patient',
    specialization VARCHAR(100) DEFAULT NULL, -- For doctors
    experience TEXT DEFAULT NULL,             -- For doctors
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    appointment_date DATE NOT NULL,
    appointment_time VARCHAR(50) NOT NULL,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES users(id),
    FOREIGN KEY (doctor_id) REFERENCES users(id)
);

-- Insert a default doctor for the portfolio
INSERT INTO users (name, email, password, role, specialization, experience) 
VALUES ('Dr. Sumanyu Sahu', 'doctor@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'doctor', 'Orthopedic Surgeon', 'Over 15 years of experience in joint replacements and sports medicine.')
ON DUPLICATE KEY UPDATE name=name;
