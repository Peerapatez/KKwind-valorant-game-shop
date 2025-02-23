<?php
session_start();    // เริ่ม session
include('connection.php');  // นำเข้าไฟล์ database

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // ตรวจสอบว่ากรอกข้อมูลครบหรือไม่
    if (empty($email) || empty($username) || empty($password) || empty($confirm_password)) {
        $_SESSION['err_fill'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
        header('location: register.php');
        exit();
    }

    // ตรวจสอบรูปแบบอีเมล
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['err_email'] = "รูปแบบอีเมลไม่ถูกต้อง";
        header('location: register.php');
        exit();
    }

    // ตรวจสอบว่ารหัสผ่านและยืนยันรหัสผ่านตรงกันหรือไม่
    if ($password !== $confirm_password) {
        $_SESSION['err_pw'] = "กรุณากรอกรหัสผ่านให้ตรงกัน";
        header('location: register.php');
        exit();
    } 

    try {
        // ตรวจสอบว่ามี username และ email นี้อยู่ในระบบหรือไม่
        $select_stmt = $db->prepare("SELECT COUNT(username) AS count_uname, COUNT(email) AS count_email FROM users WHERE username = :username OR email = :email");
        $select_stmt->bindParam(':username', $username);
        $select_stmt->bindParam(':email', $email);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        // ถ้ามี username หรือ email ในระบบ
        if ($row['count_uname'] != 0) {
            $_SESSION['exist_uname'] = "มี username นี้ในระบบ";
            header('location: register.php');
            exit();
        } 
        if ($row['count_email'] != 0) {
            $_SESSION['exist_email'] = "มี email นี้ในระบบ";
            header('location: register.php');
            exit();
        } 

        // ถ้าไม่มี username และ email จะทำการเข้ารหัสรหัสผ่าน
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insert_stmt = $db->prepare("INSERT INTO users (username, password, email, role) VALUES (:username, :password, :email, 'user')");
        $insert_stmt->bindParam(':username', $username);
        $insert_stmt->bindParam(':password', $hashed_password);
        $insert_stmt->bindParam(':email', $email);
        $insert_stmt->execute();

        // ถ้าสมัครสมาชิกสำเร็จ
        if ($insert_stmt) {
            $_SESSION['username'] = $username;
            $_SESSION['is_logged_in'] = true;
            header('location: index2.php');
            exit();
        } else {
            $_SESSION['err_insert'] = "ไม่สามารถนำเข้าข้อมูลได้";
            header('location: register.php');
            exit();
        }
    } catch (PDOException $e) {
        // จัดการกับข้อผิดพลาดของฐานข้อมูล
        error_log("Database error: " . $e->getMessage());
        $_SESSION['err_db'] = "เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล";
        header('location: register.php');
        exit();
    }
}
