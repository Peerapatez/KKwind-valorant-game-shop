<?php
session_start();
require_once 'connection.php';
if (!isset($_SESSION['is_logged_in'])) {
    header('Location: login.php');
    exit();
}


$conn = new mysqli('localhost', 'root', '', 'my_database');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// ดึงข้อมูล point จากฐานข้อมูลตาม username
$username = $_SESSION['username'];
$sql = "SELECT point FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $point = $row['point'];
} else {
    $point = 0; // กรณีไม่พบข้อมูลผู้ใช้ให้แสดง point เป็น 0
}

$conn->close();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;700&display=swap" rel="stylesheet">
  <title>KKW</title>
  <link rel="icon" type="image/x-icon" href="logo/KW.png">
  <link href="output.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  

  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  
</head>
<body>

<!-- ส่วนหัว -->
<header class="bg-white border-b border-gray-300">
<?php include 'navbar.php'; ?>

<!-- Mobile menu, show/hide based on mobile menu state. -->
<div class="lg:hidden hidden" role="dialog" aria-modal="true" id="mobileMenu">
    <div class="fixed inset-0 z-10"></div>
    <div class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
      <div class="flex items-center justify-between">
        <a href="index2.php" class="-m-1.5 p-1.5">
          <span class="sr-only">ร้าน</span>
          <img src="ui/user.png" alt="" width="30" high="auto">
        </a>
        <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" onclick="toggleMobileMenu()">
          <span class="sr-only">Close menu</span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="mt-6 flow-root">
        <div class="-my-6 divide-y divide-gray-500/10">
          <div class="space-y-2 py-6">
            <div class="-mx-3">
              
            <a href="#" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50" role="menuitem">user :<?php echo $_SESSION['username']; ?></a>
            <a href="#" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">Point :</a>
            <a href="histories.php" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">เช็คประวัติ</a>
              <button type="button" class="flex w-full items-center justify-between rounded-lg py-2 pl-3 pr-3.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50" aria-expanded="false" onclick="toggleMobileDropdown()">
                สินค้า
                <svg class="h-5 w-5 flex-none text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                </svg>
              </button>
              
              <div class="mt-2 space-y-2 hidden" id="mobileDropdownMenu">
                <a href="skin.php" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">Valorant สุ่ม Skin</a>
                <a href="skinkr.php" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">Valorant สุ่ม Rank</a>
                <a href="rank.php" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">การันตีสกิน</a>
                <a href="rare.php" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">การันตีของ rare</a>
              </div>
            </div>
            <a href="#" class="block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">เติมเงิน</a>
            <a href="#" class="block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">ติดต่อ</a>
            
          </div>
          <div class="py-6">
            <a href="index.php" class="vl-m-link">Logout <span aria-hidden="true">&rarr;</span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<main class="custom-bg" style="min-height: 100vh;">
  <div class="container">
    <div class="container" style="margin-top: 20px;">
      <h3 class="s-f">Topup Selection</h3>
      <p class="s-sm">เลือกช่องทางการเติมเงิน</p>
    </div>
    <div class="grid grid-cols-12 sm:grid-cols-2 lg:grid-cols-3 justify-center">
      <div class="card-t sm:w-1/2 lg:w-1/3 p-3">
        <div>
          <label for="my_modal_6" class="cursor-pointer"><img src="topup/slipscanpay.png"></label>
        </div>
        <div class="my-3 text-start px-3">
          <div class="row">
            <div class="col-12 text-start">
              <p class="m-0 p-0 text-center text-muted">ธนาคาร (เช็คสลิป)</p>
            </div>
          </div>
        </div>
      </div>
      <div class="card-t sm:w-1/2 lg:w-1/3 p-3">
        <div>
          <label for="wallet_modal" class="cursor-pointer"><img src="topup/wallet.png"></label>
        </div>
        <div class="my-3 text-start px-3">
          <div class="row">
        <div class="col-12 text-start">
          <p class="m-0 p-0 text-center text-muted">Truemoney Wallet (สแกนจ่าย)</p>
        </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<!-- Put this part before </body> tag -->
<form action='slip_db.php' method='POST' enctype='multipart/form-data'>
  <input type="checkbox" id="my_modal_6" class="modal-toggle" />
  <div class="modal" role="dialog">
    <div class="modal-box">
      <h3 class="text-lg font-bold">อัปโหลดสลิป</h3>
      <p class="py-4">จำนวนเงินที่เติม</p>
      <p class="py-4">147-1-82084-5 กสิรกรไทย</p>
      <input class='input input-bordered w-full max-w-xs' name='money' type='number'>
      <p class='py-4'>รูปสลิป</p>
      <input type="file" accept='image/*' name='slip_img'class="file-input file-input-bordered w-full max-w-xs">
      <div class="modal-action">
        <?php
        $getUserId = $db->query("SELECT id FROM users WHERE username = '$username'");
        $userId = $getUserId->fetch(PDO::FETCH_ASSOC);
        ?>
        <input type="text" name='user_id' hidden value='<?php echo $userId['id'] ?>'>
        <button type='submit' name='slip_upload' for="" class='btn btn-success'>อัปโหลด</button>
        <label for="my_modal_6" class="btn btn-error text-white">ยกเลิก</label>
      </div>
    </div>
  </div>
</form>


<!-- Put this part before </body> tag -->
<form action='slip_db.php' method='POST' enctype='multipart/form-data'>
  <input type="checkbox" id="wallet_modal" class="modal-toggle" />
  <div class="modal" role="dialog">
    <div class="modal-box">
      <h3 class="text-lg font-bold">อัปโหลดสลิป</h3>
      <img src="https://cdn.discordapp.com/attachments/1288402977417203793/1318642369104576622/52ee3f7b-e1df-4d3d-bc02-c076a05b8f9a.png?ex=676310e7&is=6761bf67&hm=417e7de27ac449d35754a7be5300ea107734793b429cae587a2d8fcab3d31f2e&" alt="">
      <p class="py-4">จำนวนเงินที่เติม</p>
      
      <input class='input input-bordered w-full max-w-xs' name='money' type='number'>
      <p class='py-4'>รูปสลิป</p>
      <input type="file" accept='image/*' name='slip_img'class="file-input file-input-bordered w-full max-w-xs">
      <div class="modal-action">
        <?php
        $getUserId = $db->query("SELECT id FROM users WHERE username = '$username'");
        $userId = $getUserId->fetch(PDO::FETCH_ASSOC);
        ?>
        <input type="text" name='user_id' hidden value='<?php echo $userId['id'] ?>'>
        <button type='submit' name='slip_upload' for="" class='btn btn-success'>อัปโหลด</button>
        <label for="wallet_modal" class="btn btn-error text-white">ยกเลิก</label>
      </div>
    </div>
  </div>
</form>

<script>
  function showPopup(type) {
    if (type === 'wallet') {
      document.getElementById('wallet_modal').checked = true;
    }
  }
</script>
<!-- ส่วนท้าย -->
<footer  >
  <div class="text-center">
    <p class=" text-gray-400">&copy; 2024 Your Company. All rights reserved.</p>
  </div>
</footer>

<script src="script.js"></script>

</body>
</html>
