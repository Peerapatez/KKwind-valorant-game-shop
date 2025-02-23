<?php
require_once 'connection.php';

if(isset($_POST['slip_upload'])){
    $money = $_POST['money'];
    $slip_img = $_FILES['slip_img'];
    $user_id = $_POST['user_id'];
    $target_dir = "slips/";
    $target_file = $target_dir . basename($slip_img["name"]);

    if(move_uploaded_file($slip_img["tmp_name"], $target_file)){
        $stmt = $db->prepare("INSERT INTO payment_slips (user_id, slip_image, amount, status) VALUES (:user_id, :slip_img, :money, :status)");
        $stmt->execute([
            'user_id' => $user_id,
            'slip_img' => $target_file,
            'money' => $money,
            'status' => 'pending'
        ]);
        header('location: point.php');
        exit();
    }else{
        echo "Upload failed";
    }
}
?>