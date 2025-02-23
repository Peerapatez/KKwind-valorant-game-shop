<?php 
session_start();
require_once 'connection.php';

$stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => $_SESSION['username']]);
$getUserRole = $stmt->fetch();
if($getUserRole['role'] != 'admin'){
    header('Location: index.php');
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="bg-blue-100 min-h-screen"></body>
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <link rel="icon" type="image/x-icon" href="logo/KW.png">
                <div class="flex items-center">
                    <!-- Add any other left-aligned items here -->
                </div>
                <div class="flex items-center ml-auto">
                    <a href="login.php" class="text-gray-800 hover:text-gray-600">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="flex container mx-auto px-4 text-white mt-10">
        <div class="container w-80">
            <ul class="menu bg-base-200 rounded-box w-100">
                <li><a href="admin.php?page=user">จัดการผู้ใช้</a></li>
                <li><a href="admin.php?page=slip">ตรวจสอบสลิป</a></li>
                <li><a href="admin.php?page=slip_history">ประวัติอนุมัติสลิป</a></li>
                <li><a href="admin.php?page=productType">จัดการประเภทสินค้า</a></li>
                <li><a href="admin.php?page=product">จัดการสินค้า</a></li>
                <li><a href="admin.php?page=account">จัดการรหัส</a></li>
            </ul>
        </div>
        <div class="container px-10">
            <?php if($_GET['page'] == 'user'){?>
                <div class="text-3xl text-black ms-5 font-bold">หน้าจัดการแอดมิน</div>
                <div class="overflow-x-auto text-black">
                <div class="overflow-x-auto">
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr class='text-black'>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Password</th>
                                <th>Email</th>
                                <th>Point</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- row 1 -->
                         <?php 
                         $stmt = $db->prepare("SELECT * FROM users");
                         $stmt->execute();

                         while($row = $stmt->fetch()){ ?>
                            <tr>
                                <th><?php echo $row['id'] ?></th>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['role']; ?></td>
                                <td><?php echo $row['email']?></td>
                                <td><?php echo $row['point']?></td>
                                <td>
                                    <form action="admin_db.php" method='POST' >
                                        <input type="text" hidden value='<?php echo $row['id'] ?>' name='userId'>
                                        <button type='submit' name='deleteUser' class='btn btn-sm btn-outline btn-error'>ลบ</button>
                                    </form>
                                </td>
                            </tr>
                         <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php }elseif ($_GET['page'] == 'slip') { ?>
                <div class="text-3xl text-black ms-5 font-bold">หน้าตรวจสอบสลิป</div>
                <div class="overflow-x-auto">
                    <table class="table text-black">
                        <!-- head -->
                        <thead>
                        <tr class='text-black'>
                            <th>ID</th>
                            <th>Username</th>
                            <th>จำนวนเงินที่เติม</th>
                            <th>รูปสลิป</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                             <?php
                             $stmt = $db->query("SELECT * FROM payment_slips WHERE status = 'pending'");
                             while($slips = $stmt->fetch(PDO::FETCH_ASSOC)){
                            $getUsername = $db->prepare("SELECT username,id FROM users WHERE id = :id");
                            $getUsername->execute(['id' => $slips['user_id']]);
                            $username = $getUsername->fetch(PDO::FETCH_ASSOC);
                             ?>
                            <tr>
                                <th><?php echo $slips['id'] ?></th>
                                <td><?php echo $username['username']?></td>
                                <td><?php echo $slips['amount'] ?></td>
                                <td><img class='w-40' src='<?php echo $slips['slip_image']; ?>'></td>
                                <td>
                                    <form action="admin_db.php" method='POST'>
                                        <input type="text" hidden value='<?php echo $slips['id'] ?>' name='slipId'>
                                        <input type="text" value='<?php echo $username['id']; ?>' name='userId' hidden>
                                        <input type="text" value="<?php echo $getUserRole['id'] ?>" name="adminId" hidden>
                                        <input type="text" value='<?php echo $slips['amount'] ?>' name='amount' hidden>
                                        <button type='submit' name='approveSlip' class='btn btn-sm btn-outline btn-success'>อนุมัติ</button>
                                        <button type='submit' name='rejectSlip' class='btn btn-sm btn-outline btn-error'>ปฏิเสธ</button>
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
            <?php }elseif ($_GET['page'] == 'product'){ ?>
                <div class="flex justify-between"> 
                    <div class="text-3xl text-black ms-5 font-bold">หน้าจัดการสินค้า</div>
                    <label for="addProductModal" class="btn btn-primary text-white">เพิ่มรายการ</label>
                </div>
                <!-- Add Product Modal -->
                <input type="checkbox" id="addProductModal" class="modal-toggle" />
                <div class="modal">
                    <div class="modal-box relative">
                        <label for="addProductModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                        <h3 class="text-lg font-bold">เพิ่มรายการสินค้า</h3>
                        <form action="admin_db.php" enctype="multipart/form-data" method="POST">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">ชื่อ</span>
                                </label>
                                <input type="text" name="productName" class="input input-bordered" required />
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">ราคา</span>
                                </label>
                                <input type="int" name="productPrice" class="input input-bordered" required />
                                <label class="label">
                                    <span class="label-text">ประเภท</span>
                                </label>
                                <select class='select select-bordered w-full' name="productType" id="" required>
                                    <option value="" disabled selected>เลือกประเภท</option>
                                    <?php
                                    $stmt = $db->query("SELECT * FROM producttype");
                                    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                    <option value="<?php echo $result['type_id'] ?>"><?php echo $result['type_name'] ?></option>
                                    <?php } ?>
                                </select>
                                <label class="label">
                                    <span class="label-text">รูปภาพ</span>
                                </label>
                                <input type="file" accept="image/*" class="file-input w-full" name="product_img" required>
                            </div>
                            <div class="form-control mt-4">
                                <button type="submit" name="addProduct" class="btn btn-primary">เพิ่มสินค้า</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="table text-black">
                        <!-- head -->
                        <thead>
                        <tr class='text-black'>
                            <th>ID</th>
                            <th>ชื่อสินค้า</th>
                            <th>ราคา</th>
                            <th>ประเภทสินค้า</th>
                            <th>รูปภาพ</th>
                        </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                             <?php
                             $stmt = $db->query("SELECT * FROM product");
                             while($slips = $stmt->fetch(PDO::FETCH_ASSOC)){
                                $typeId = $slips['type_id'];
                                $getTypeName = $db->query("SELECT type_name FROM productType WHERE type_id = '$typeId'");
                                $typeName = $getTypeName->Fetch(PDO::FETCH_ASSOC)
                             ?>
                            <tr>
                                <th><?php echo $slips['product_id'] ?></th>
                                <td><?php echo $slips['product_name']?></td>
                                <td><?php echo $slips['product_price'] . " ฿" ?></td>
                                <td><?php echo $typeName['type_name'] ?></td>
                                <td><img class='max-w-16 min-w-16' src="<?php echo $slips['product_img'] ?>" alt=""></td>
                                <td>
                                    <form action="admin_db.php" method="POST">
                                        <input type="text" value="<?php echo $slips['product_id'] ?>" name='product_id' hidden>
                                        <button type="button" onclick="editProduct.showModal(); editProd('<?php echo $slips['product_name']; ?>', '<?php echo $slips['product_price'] ?>', '<?php echo $slips['type_id'] ?>', '<?php echo $slips['product_id'] ?>')" class="btn btn-sm btn-outline btn-warning">แก้ไข</button>
                                        <button type='submit' name='deleteProduct' class='btn btn-sm btn-outline btn-error'>ลบ</button>
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php }elseif ($_GET['page'] == 'productType'){ ?>
                <div class="flex justify-between"> 
                    <div class="text-3xl text-black ms-5 font-bold">หน้าจัดการประเภทสินค้า</div>
                    <label for="addProductModal" class="btn btn-primary text-white">เพิ่มรายการ</label>
                </div>
                <input type="checkbox" id="addProductModal" class="modal-toggle" />
                <div class="modal">
                    <div class="modal-box relative">
                        <label for="addProductModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                        <h3 class="text-lg font-bold">เพิ่มประเภทสินค้า</h3>
                        <form action="admin_db.php" enctype='multipart/form-data' method="POST">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">ชื่อ</span>
                                </label>
                                <input type="text" name="typeName" class="input input-bordered" required />
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">คำอธิบาย</span>
                                </label>
                                <input type="text" name="typeDesc" class="input input-bordered" required />
                                <label class="label">
                                    <span class='label-text'>รูปภาพ</span>
                                </label>
                                <input type="file" accept="image/*" name='typeImg' class="file-input w-full max-w-xs" required>
                            </div>
                            <div class="form-control mt-4">
                                <button type="submit" name="addProductType" class="btn btn-primary">เพิ่มสินค้า</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="table text-black">
                        <!-- head -->
                        <thead>
                        <tr class='text-black'>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Description</th>
                            <th>รูปปก</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                             <?php
                             $stmt = $db->query("SELECT * FROM productType");
                             while($productType = $stmt->fetch(PDO::FETCH_ASSOC)){
                             ?>
                            <tr>
                                <th><?php echo $productType['type_id'] ?></th>
                                <td><?php echo $productType['type_name']?></td>
                                <td><?php echo $productType['type_desc'] ?></td>
                                <td><img class='max-w-64 min-w-64' src="<?php echo $productType['type_img'] ?>" alt=""></td>
                                <td>
                                    <form action="admin_db.php" method="POST">
                                        <button type="button" onclick="editType.showModal(); editTyp('<?php echo $productType['type_name']; ?>', '<?php echo $productType['type_desc'] ?>', '<?php echo $productType['type_id'] ?>')" class="btn btn-sm btn-outline btn-warning">แก้ไข</button>
                                        <input type="hidden" name="type_id" value='<?php echo $productType['type_id'] ?>'>
                                        <button type='submit' name='deleteProductType' class='btn btn-sm btn-outline btn-error'>ลบ</button>
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
            <?php }elseif ($_GET['page'] == 'account'){ ?>
                <div class="flex justify-between"> 
                    <div class="text-3xl text-black ms-5 font-bold">หน้าจัดการรหัส</div>
                    <label for="addAccountModal" class="btn btn-primary text-white">เพิ่มรายการ</label>
                </div>
                <!-- Add Account Modal -->
                <input type="checkbox" id="addAccountModal" class="modal-toggle" />
                <div class="modal">
                    <div class="modal-box relative">
                        <label for="addAccountModal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                        <h3 class="text-lg font-bold">เพิ่มรายการสินค้า</h3>
                        <form action="admin_db.php" enctype="multipart/form-data" method="POST">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">ชื่อ</span>
                                </label>
                                <input type="text" name="accountName" class="input input-bordered" required />
                                <label class="label">
                                    <span class="label-text">รหัสผ่าน</span>
                                </label>
                                <input type="text" name="accountPassword" class="input input-bordered" required />
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">ประเภทรหัส</span>
                                </label>
                                <select class='select select-bordered w-full' name="accountType" id="" required>
                                    <option value="" disabled selected>เลือกประเภท</option>
                                    <?php
                                    $stmt = $db->query("SELECT * FROM product");
                                    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                    <option value="<?php echo $result['product_id'] ?>"><?php echo $result['product_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-control mt-4">
                                <button type="submit" name="addAccount" class="btn btn-primary">เพิ่มสินค้า</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="table text-black">
                        <!-- head -->
                        <thead>
                        <tr class='text-black'>
                            <th>ID</th>
                            <th>ชื่อ Username</th>
                            <th>รหัส</th>
                            <th>ประเภทสินค้า</th>
                            <th>สถานะสินค้า</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                             <?php
                             $stmt = $db->query("SELECT * FROM account");
                             while($slips = $stmt->fetch(PDO::FETCH_ASSOC)){
                                $productId = $slips['product_id'];
                                $getTypeName = $db->query("SELECT product_name FROM product WHERE product_id = '$productId'");
                                $typeName = $getTypeName->fetch(PDO::FETCH_ASSOC);
                             ?>
                            <tr>
                                <th><?php echo $slips['acc_id'] ?></th>
                                <td><?php echo $slips['acc_name']?></td>
                                <td><?php echo $slips['acc_password'] ?></td>
                                <td><?php echo $typeName['product_name'] ?></td>
                                <td><?php echo ($slips['acc_status'] == 0) ? "ยังไม่ขาย" : "ขายแล้ว"; ?></td>
                                <td>
                                    <form action="admin_db.php" method="POST">
                                    <button type="button" onclick="editAccount.showModal(); editAcc('<?php echo $slips['acc_name'] ?>', '<?php echo $slips['acc_password'] ?>', '<?php echo $slips['product_id'] ?>', '<?php echo $slips['acc_id'] ?>')" class="btn btn-sm btn-outline btn-warning">แก้ไข</button>
                                    <input type="text" value="<?php echo $slips['acc_id'] ?>" name='acc_id' hidden>
                                    <button type='submit' name='deleteAccount' class='btn btn-sm btn-outline btn-error'>ลบ</button>
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php }elseif ($_GET['page'] == 'slip_history'){ ?>
                <div class="text-3xl text-black ms-5 font-bold">ประวัติอนุมัติสลิป</div>
                <div class="overflow-x-auto">
                    <table class="table text-black">
                        <!-- head -->
                        <thead>
                        <tr class='text-black'>
                            <th>ID</th>
                            <th>ชื่อแอดมิน</th>
                            <th>ชื่อลูกค้าที่เติม</th>
                            <th>จำนวนเงินที่เติม</th>
                            <th>ผลการอนุมัติ</th>
                        </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                             <?php
                             $stmt = $db->query("SELECT * FROM slip_history");
                             while($slips = $stmt->fetch(PDO::FETCH_ASSOC)){
                                $getUsername = $db->prepare("SELECT username,id FROM users WHERE id = :id");
                                $getUsername->execute(['id' => $slips['sh_adminId']]);
                                $username = $getUsername->fetch(PDO::FETCH_ASSOC);

                                

                                $slipId = $slips['sh_slipId'];
                                $getSlipDetail = $db->query("SELECT * FROM payment_slips WHERE id = '$slipId'");
                                $slipDetail = $getSlipDetail->fetch(PDO::FETCH_ASSOC);

                                $getCustomerUsername = $db->prepare("SELECT username FROM users WHERE id = :id");
                                $getCustomerUsername->execute(['id'=>$slipDetail['user_id']]);
                                $customerUsername = $getCustomerUsername->fetch(PDO::FETCH_ASSOC);
                             ?>
                            <tr>
                                <th><?php echo $slips['sh_id'] ?></th>
                                <td><?php echo $username['username'] ?></td>
                                <td><?php echo $customerUsername['username']?></td>
                                <td><?php echo $slipDetail['amount'] ?></td>
                                <td><?php echo $slips['sh_action'] ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
            <?php } ?>
        </div>
    </div>

<dialog id="editProduct" class="modal">
  <div class="modal-box">
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <h3 class="text-lg font-bold">แก้ไขรายการ</h3>
    <form action="admin_db.php" enctype="multipart/form-data" method="POST">
        <label class="label">
            <span class="label-text">ชื่อ</span>
        </label>
        <input type="text" name="productName" id="productName" class="input input-bordered w-full" required />
        <label class="label">
            <span class="label-text">ราคา</span>
        </label>
        <input type="text" name="productPrice" id="productPrice" class="input input-bordered w-full" required />
        <label class="label">
            <span class="label-text">ประเภท</span>
        </label>
        <select class='select select-bordered w-full' name="productType" id="productType" required>
            <option value="" disabled selected>เลือกประเภท</option>
            <?php
            $stmt = $db->query("SELECT * FROM producttype");
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
            <option value="<?php echo $result['type_id'] ?>"><?php echo $result['type_name'] ?></option>
            <?php } ?>
        </select>
        <input type="text" name='productId' id='productId'hidden>
        <label class="label">
            <span class="label-text">รูปภาพ</span>
        </label>
        <input type="file" accept="image/*" class="file-input w-full" name="product_img">
        <div class="form-control mt-4">
            <button type="submit" name="editProduct" class="btn btn-primary">แก้ไข</button>
        </div>
    </form>
  </div>
</dialog>

<dialog id="editType" class="modal">
  <div class="modal-box">
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <h3 class="text-lg font-bold">แก้ไขรายการ</h3>
    <form action="admin_db.php" enctype="multipart/form-data" method="POST">
        <label class="label">
            <span class="label-text">ชื่อ</span>
        </label>
        <input type="text" name="typeName" id="typeName" class="input input-bordered w-full" required />
        <label class="label">
            <span class="label-text">คำอธิบาย</span>
        </label>
        <input type="text" name="typeDesc" id="typeDesc" class="input input-bordered w-full" required />
        <input type="text" name='typeId' id='typeId' hidden>
        <label class="label">
            <span class="label-text">รูปภาพ</span>
        </label>
        <input type="file" accept="image/*" class="file-input w-full" name="typeImg">
        <div class="form-control mt-4">
            <button type="submit" name="editProductType" class="btn btn-primary">แก้ไข</button>
        </div>
    </form>
  </div>
</dialog>

<dialog id="editAccount" class="modal">
  <div class="modal-box">
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <h3 class="text-lg font-bold">แก้ไขรหัส</h3>
    <form action="admin_db.php" enctype="multipart/form-data" method="POST">
        <label class="label">
            <span class="label-text">ชื่อ</span>
        </label>
        <input type="text" name="accountName" id="accountName" class="input input-bordered w-full" required />
        <label class="label">
            <span class="label-text">รหัสผ่าน</span>
        </label>
        <input type="text" name="accPassword" id="accountPassword" class="input input-bordered w-full" required />
        <label class="label">
            <span class="label-text">ประเภทรหัส</span>
        </label>
        <select class='select select-bordered w-full' name="accountType" id="accountType" required>
            <option value="" disabled selected>เลือกประเภท</option>
            <?php
            $stmt = $db->query("SELECT * FROM product");
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
            <option value="<?php echo $result['product_id'] ?>"><?php echo $result['product_name'] ?></option>
            <?php } ?>
        </select>
        <input type="text" name='accId' id='accountId' hidden>
        <div class="form-control mt-4">
            <button type="submit" name="editAccount" class="btn btn-primary">แก้ไข</button>
        </div>
    </form>
  </div>
</dialog>

<script src='main.js'></script>
</body>
</html>
