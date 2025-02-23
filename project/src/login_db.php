<?php
session_start();  // เริ่ม session
include('connection.php');  // เชื่อมต่อฐานข้อมูล

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // ตรวจสอบว่ามีการกรอกข้อมูลหรือไม่
    if (empty($username) || empty($password)) {
        $_SESSION['err_fill'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
        header('location: login.php');
        exit();
    } else {
        // ตรวจสอบ username และดึงข้อมูลจากฐานข้อมูล
        $select_stmt = $db->prepare("SELECT username, password, role FROM users WHERE username = :username");
        $select_stmt->bindParam(':username', $username);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

        //ถ้าไม่มี username 
        if (!$row) {
            $_SESSION['err_uname'] = "ไม่มี username นี้ในระบบ";
            header('location: login.php');
            exit();
        } else {
            //ตรวจสอบรหัสผ่าน
            if (password_verify($password, $row['password'])) {
            
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $row['role'];
                $_SESSION['is_logged_in'] = true;

                //ตรวจสอบ role
                if ($row['role'] === 'admin') {
                    header('location: admin.php'); 
                } else {
                    header('location: index2.php'); 
                }
                exit();
            } else {
                $_SESSION['err_pw'] = "รหัสผ่านไม่ถูกต้อง";
                header('location: login.php');
                exit();
            }
        }
    }
} else {
    header('location: login.php');
    exit();
}
