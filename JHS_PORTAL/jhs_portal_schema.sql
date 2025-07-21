-- JHS Portal Database Schema

-- USERS TABLE (for login/authentication)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('student', 'teacher', 'admin') NOT NULL,
    full_name VARCHAR(100),
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- STUDENTS TABLE
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    class VARCHAR(20),
    section VARCHAR(10),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- TEACHERS TABLE
CREATE TABLE teachers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    subject_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- ADMINS TABLE
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- SUBJECTS TABLE
CREATE TABLE subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- CLASSES TABLE (optional)
CREATE TABLE classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    section VARCHAR(10)
);

-- GRADES TABLE
CREATE TABLE grades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    subject_id INT NOT NULL,
    teacher_id INT NOT NULL,
    grade_value VARCHAR(10) NOT NULL,
    grading_period VARCHAR(20),
    remarks VARCHAR(100),
    date_recorded DATE,
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (subject_id) REFERENCES subjects(id),
    FOREIGN KEY (teacher_id) REFERENCES teachers(id)
);

-- ANNOUNCEMENTS TABLE (optional)
CREATE TABLE announcements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); 

INSERT INTO users (username, password, role, full_name, email) VALUES
('student1', '$2y$10$examplehashforstudent', 'student', 'Student One', 'student1@example.com'),
('teacher1', '$2y$10$examplehashforteacher', 'teacher', 'Teacher One', 'teacher1@example.com'),
('admin1', '$2y$10$examplehashforadmin', 'admin', 'Admin One', 'admin1@example.com');

-- Create activity_logs table
CREATE TABLE IF NOT EXISTS activity_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    action VARCHAR(255) NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Insert dummy activity logs
INSERT INTO activity_logs (username, action) VALUES
('admin1', 'Logged in'),
('teacher1', 'Submitted grades for Section A'),
('student1', 'Viewed grades'),
('admin1', 'Added new user student2'),
('teacher2', 'Updated profile information');

-- Example SQL for adviser_subjects table (if not present)
CREATE TABLE IF NOT EXISTS adviser_subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    adviser_id INT NOT NULL,
    subject VARCHAR(100) NOT NULL,
    FOREIGN KEY (adviser_id) REFERENCES users(id)
);