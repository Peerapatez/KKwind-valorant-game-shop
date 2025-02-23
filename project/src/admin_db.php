<?php
require_once 'connection.php';

print_r($_POST);

if(isset($_POST['deleteUser'])){
    $userId = $_POST['userId'];
    print_r($userId);
    $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    header('location: admin.php?page=user');
    exit();
};

function addSlipHistory($adminId, $slipId, $action){
    global $db;
    
    $stmt = $db->query("INSERT INTO slip_history (sh_adminId, sh_slipId, sh_action) VALUES ('$adminId','$slipId','$action')");
}

if(isset($_POST['approveSlip'])){
    $slipId = $_POST['slipId'];
    $userId = $_POST['userId'];
    $amount = $_POST['amount'];
    $adminId = $_POST['adminId'];
    
    $getOldPoint = $db->prepare("SELECT point FROM users WHERE id = :id");
    $getOldPoint->execute(['id' => $userId]);
    $oldPoint = $getOldPoint->fetch(PDO::FETCH_ASSOC);

    $totalPoint = $oldPoint['point'] +  $amount;

    $stmt = $db->prepare("UPDATE users SET point = :point WHERE id = :id");
    $stmt->execute(['point' => $totalPoint, 'id' => $userId]);

    $updateSlip = $db->prepare("UPDATE payment_slips SET status = 'approved' WHERE id = :id");
    $updateSlip->execute(['id' => $slipId]);

    addSlipHistory($adminId, $slipId, 'Approve');

    header('location: admin.php?page=slip');
};

if(isset($_POST['rejectSlip'])){
    $slipId = $_POST['slipId'];
    $adminId = $_POST['adminId'];

    $updateSlip = $db->prepare("UPDATE payment_slips SET status = 'rejected' WHERE id = :id");
    $updateSlip->execute(['id' => $slipId]);

    addSlipHistory($adminId, $slipId, 'Reject');

    header('location: admin.php?page=slip');

};


if(isset($_POST['addProduct'])){
    $productName = $_POST['productName'];
    $productType = $_POST['productType'];
    $productImg = $_FILES['product_img'];
    $productPrice = $_POST['productPrice'];

    $target_dir = "product/";
    $target_file = $target_dir . basename($productImg["name"]);

    if(move_uploaded_file($productImg['tmp_name'], $target_file)){
        $stmt = $db->prepare("INSERT INTO product (product_name,type_id,product_img,product_price) VALUES (:product_name, :type_id, :product_img, :product_price)");
        $stmt->execute([
            'product_name' => $productName,
            'type_id' => $productType,
            'product_img' => $target_file,
            'product_price' => $productPrice
            ]);
        header('location: admin.php?page=product');
        exit();
    }else{
        echo "upload failed nigga";
    };
};

if(isset($_POST['deleteProduct'])){
    $product_id = $_POST['product_id'];

    $stmt = $db->prepare("DELETE FROM product WHERE product_id = :product_id");
    $stmt->execute(["product_id"=>$product_id]);

    header("location:admin.php?page=product");
};

if(isset($_POST['editProduct'])){
    $productName = $_POST['productName'];
    $productType = $_POST['productType'];
    $productImg = $_FILES['product_img'];
    $product_id = $_POST['productId'];
    $productPrice = $_POST['productPrice'];

    if(empty($productImg['name'])){
        $getOldImg = $db->query("SELECT product_img FROM product WHERE product_id = '$product_id'");
        $OldImg = $getOldImg->fetch(PDO::FETCH_ASSOC);

        $target_file = $OldImg['product_img'];

        $stmt = $db->query("UPDATE product SET product_name = '$productName', type_id = '$productType', product_price = '$productPrice', product_img = '$target_file' WHERE product_id = '$product_id'");
        header("location: admin.php?page=product");
    }else{
        $target_dir = "product/";
        $target_file = $target_dir . basename($productImg["name"]);
    
        if(move_uploaded_file($productImg['tmp_name'], $target_file)){
            $stmt = $db->query("UPDATE product SET product_name = '$productName', type_id = '$productType', product_price = '$productPrice', product_img = '$target_file' WHERE product_id = '$product_id'");
            header('location: admin.php?page=product');
            exit();
        }else{
            echo "upload failed nigga";
        };
    }
}


if(isset($_POST['addProductType'])){
    $typeName = $_POST['typeName'];
    $typeDesc = $_POST['typeDesc'];
    $typeImage = $_FILES['typeImg'];

    $target_dir = "typeImg/";
    $target_file = $target_dir . basename($typeImage["name"]);

    if(move_uploaded_file($typeImage['tmp_name'], $target_file)){
        $stmt = $db->prepare("INSERT INTO producttype (type_name,type_desc,type_img) VALUES (:type_name, :type_desc, :type_img)");
        $stmt->execute([
            'type_name' => $typeName,
            'type_desc' => $typeDesc,
            'type_img' => $target_file
        ]);
        header("location: admin.php?page=productType");
        exit();
    }else{
        echo "upload failed nigga";
    };
};

if(isset($_POST['deleteProductType'])){
    $type_id = $_POST['type_id'];

    $stmt = $db->prepare("DELETE FROM producttype WHERE type_id = :type_id");
    $stmt->execute(["type_id"=>$type_id]);

    header("location:admin.php?page=productType");
};
if(isset($_POST['editProductType'])){
    $typeName = $_POST['typeName'];
    $typeDesc = $_POST['typeDesc'];
    $typeImage = $_FILES['typeImg'];
    $typeId = $_POST['typeId'];

    if(empty($typeImage['name'])){
        $getOldImg = $db->query("SELECT type_img FROM producttype WHERE type_id = '$typeId'");
        $OldImg = $getOldImg->fetch(PDO::FETCH_ASSOC);

        $target_file = $OldImg['type_img'];

        $stmt = $db->query("UPDATE producttype SET type_name = '$typeName', type_desc = '$typeDesc', type_img = '$target_file' WHERE type_id = '$typeId'");
        header("location: admin.php?page=productType");
    }else{
        echo "no!!!";
        $target_dir = "typeImg/";
        $target_file = $target_dir . basename($typeImage["name"]);
    
        if(move_uploaded_file($typeImage['tmp_name'], $target_file)){
            $stmt = $db->query("UPDATE producttype SET type_name = '$typeName', type_desc = '$typeDesc', type_img = '$target_file' WHERE type_id = '$typeId'");
            header('location: admin.php?page=productType');
            exit();
        }else{
            echo "upload failed nigga";
        };
    }
}


if(isset($_POST['addAccount'])){
    $accountName = $_POST['accountName'];
    $accountPassword = $_POST['accountPassword'];
    $accountType = $_POST['accountType'];

    $stmt = $db->query("INSERT INTO account(acc_name,acc_password,product_id) VALUES ('$accountName', '$accountPassword', '$accountType')");
    header("location:admin.php?page=account");
};
if(isset($_POST['deleteAccount'])){
    $accountId = $_POST['acc_id'];

    $stmt = $db->query("DELETE FROM account WHERE acc_id = '$accountId'");
    header("location:admin.php?page=account");
};
if(isset($_POST['editAccount'])){
    $accountName = $_POST['accountName'];
    $accountPassword = $_POST['accPassword'];
    $accountType = $_POST['accountType'];
    $accId = $_POST['accId'];

    $stmt = $db->query("UPDATE account SET acc_name = '$accountName', acc_password = '$accountPassword', product_id = '$accountType' WHERE acc_id = '$accId'");
    header("location:admin.php?page=account");
}


?>