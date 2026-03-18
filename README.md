# Sumanyu Ortho - Doctor Booking Website

A modern and responsive web application for an Orthopedic Clinic that allows patients to book appointments and doctors to manage them through a dedicated dashboard.

---

## 🚀 Key Features

- **Patient Portfolio**: View doctor profiles, specialization, and experience.
- **Appointment Booking**: Patients can easily book appointments for specific dates and times.
- **Slot-based Booking**: Customers can book specific slots (Patient 1 to Patient 10) instead of raw timings.
- **Doctor Dashboard**: Manage incoming appointments (Approve/Reject).
- **Mobile Responsive**: Fully optimized for smartphones, tablets, and desktops (including card-like table views).
- **Authentication System**: Secure login and registration for patients and doctors.

---

## 🛠️ Technology Stack

- **Frontend**: HTML5, CSS3 (Custom Design System).
- **Backend**: PHP.
- **Database**: MySQL.
- **Server**: XAMPP / WAMP / Apache.

---

## ⚙️ Installation & Setup

1. **Clone the Repository**:
   Place the project folder in your local server directory (e.g., `C:\xampp\htdocs\sumanyu-ortho`).

2. **Database Configuration**:
   - Open **phpMyAdmin**.
   - Create a new database named `sumanyu_ortho`.
   - Import the `database.sql` file provided in the root directory.
   - (Optional) Configure your database credentials in `db_connect.php` if they differ from the default (localhost, root, no password).

3. **Initialize the Project**:
   - Start your Apache and MySQL modules in XAMPP.
   - Navigate to `http://localhost/sumanyu-ortho/setup.php` in your browser.
   - This will create the necessary tables and insert the default doctor account.

4. **Access the Website**:
   - Go to `http://localhost/sumanyu-ortho/index.php`.

---

## 🔐 Admin (Doctor) Login

The **Doctor** acts as the administrator for managing appointments.

### **Login Credentials**
- **Email**: `doctor@example.com`
- **Password**: `password`

### **How to Login as Admin**
1. Navigate to the **Login** page (`login.php`).
2. Enter the **Email Address** and **Password** mentioned above.
3. Click on the **Log In** button.
4. Upon successful authentication, you will be automatically redirected to the **Doctor Dashboard** (`doctor_dashboard.php`).

### **Dashboard Functionalities**
- **View Appointments**: See all pending, approved, and rejected appointments.
- **Manage Status**: Use the **Approve** or **Reject** buttons to update the status of incoming appointment requests.
- **Patient Info**: View patient names, contact emails, and reason for the visit.

---

## 📂 Project Structure

- `index.php`: The homepage and portal for booking.
- `login.php` / `register.php`: Authentication pages.
- `doctor_dashboard.php`: Administrative panel for the doctor.
- `book_appointment.php`: Form for patients to request a slot.
- `my_appointments.php`: Patient's view of their booking history.
- `setup.php`: Database initialization script.
- `style.css`: Main stylesheet containing the project's design system.
- `db_connect.php`: MySQL database connection configuration.

---

## 📄 License

This project is developed for **Sumanyu Ortho**. All rights reserved.
