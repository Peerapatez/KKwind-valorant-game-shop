<?php
// buy.php
header('Content-Type: application/json');
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $randomUser = $db->query("SELECT * FROM account WHERE acc_status = 0 ORDER BY RAND() LIMIT 1")->fetch(PDO::FETCH_ASSOC);
    
    if(!$randomUser){
        $response = ['status'=> 'error', 'message'=>'ขณะนี้ไม่มีรหัสเหลือแล้ว กรุณาลองใหม่อีกครั้ง!'];
        echo json_encode($response);
        exit();
    }
    
    $username = $randomUser['acc_name'];
    $password = $randomUser['acc_password'];
    $account_id = $randomUser['acc_id'];

    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
    $price = isset($_POST['price']) ? $_POST['price'] : null;

    $getUserCurrentPoint = $db->query("SELECT point FROM users WHERE id = '$user_id'");
    $userCurrentPoint = $getUserCurrentPoint->fetch(PDO::FETCH_ASSOC);

    if ($userCurrentPoint['point'] < $price) {
        $response = ['status' => 'error', 'message' => 'คุณมีพ้อยไม่เพียงพอ'];
        echo json_encode($response);
        exit();
    }

    $stmt = $db->query("UPDATE users SET point = point - $price WHERE id = '$user_id'");
    $stmt = $db->query("UPDATE account SET acc_status = 1 WHERE acc_id = '$account_id'");

    $stmt = $db->query("INSERT INTO buy_history (user_id,game_username,game_password,price) VALUES ('$user_id','$username','$password','$price')");
    // Your PHP function logic here
    // For example:
    $response = ['status' => 'success', 'message' => $randomUser, 'user_id'=>$user_id];
    echo json_encode($response);
} else {
    $response = ['status' => 'error', 'message' => 'Invalid request method'];
    echo json_encode($response);
}
?>