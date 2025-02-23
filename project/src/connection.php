<?php

$db_host = "localhost"; 
$db_user = "root";     
$db_password = "";
$db_name = "my_database";

try {   // ทำการเชื่อมต่อ database
    $db = new PDO("mysql:host={$db_host};dbname={$db_name}", username: $db_user, password: $db_password );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, value: PDO::FETCH_ASSOC); // กำหนดโหมดการดึงข้อมูล

} catch (PDOException $e) {   // หากเชื่อมต่อผิดพลาดให้แสดงข้อความเตือน
    error_log("Connection failed: " . $e->getMessage()); // บันทึกข้อผิดพลาดใน 
    die("ไม่สามารถเชื่อมต่อฐานข้อมูลได้"); // เเจ้งสถานะ
}
