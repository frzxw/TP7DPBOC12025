-- Database structure for Clinic Management System

-- Drop database if exists
DROP DATABASE IF EXISTS db_clinic;

-- Create database
CREATE DATABASE db_clinic;
USE db_clinic;

-- Create patients table
CREATE TABLE patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    birthdate DATE NOT NULL,
    gender ENUM('Laki-laki', 'Perempuan') NOT NULL,
    address TEXT NOT NULL
);

-- Create doctors table
CREATE TABLE doctors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    specialization VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL
);

-- Create appointments table
CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    appointment_date DATETIME NOT NULL,
    status ENUM('Terjadwal', 'Selesai', 'Dibatalkan') NOT NULL DEFAULT 'Terjadwal',
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE,
    FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE CASCADE
);

-- Insert dummy data for patients
INSERT INTO patients (name, birthdate, gender, address) VALUES
('Budi Santoso', '1980-05-15', 'Laki-laki', 'Jl. Merdeka No. 123, Jakarta'),
('Siti Nurhaliza', '1992-10-25', 'Perempuan', 'Jl. Pahlawan No. 45, Bandung'),
('Agus Setiawan', '1975-03-22', 'Laki-laki', 'Jl. Diponegoro No. 67, Surabaya'),
('Dewi Lestari', '1988-12-10', 'Perempuan', 'Jl. Sudirman No. 89, Semarang'),
('Rudi Hartono', '1995-08-17', 'Laki-laki', 'Jl. Ahmad Yani No. 12, Yogyakarta');

-- Insert dummy data for doctors
INSERT INTO doctors (name, specialization, phone) VALUES
('Dr. Andi Wijaya', 'Umum', '081234567890'),
('Dr. Ratna Dewi', 'Anak', '082345678901'),
('Dr. Hendra Gunawan', 'Jantung', '083456789012'),
('Dr. Maya Puspita', 'Kulit', '084567890123'),
('Dr. Bambang Sutrisno', 'Gigi', '085678901234');

-- Insert dummy data for appointments
INSERT INTO appointments (patient_id, doctor_id, appointment_date, status) VALUES
(1, 3, '2025-04-25 10:00:00', 'Terjadwal'),
(2, 1, '2025-04-26 13:30:00', 'Terjadwal'),
(3, 5, '2025-04-24 09:15:00', 'Selesai'),
(4, 2, '2025-04-30 16:00:00', 'Terjadwal'),
(5, 4, '2025-04-29 11:45:00', 'Dibatalkan');