<?php
session_start();
if (!isset($_SESSION['is_logged_in'])) {
    header('Location: login.php');
    exit();
}

require_once 'connection.php';


$conn = new mysqli('localhost', 'root', '', 'my_database');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// ดึงข้อมูล point จากฐานข้อมูลตาม username
$username = $_SESSION['username'];
$sql = "SELECT point,id FROM users WHERE username = '$username'";
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
  
  <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>

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
          <img class="h-8 w-auto" src="logo/KW.png" alt="Band Logo">
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

<main class="mx-auto py-8">
  <section class="custom-bg " style="min-height: 100vh;">
  
  <div class="container">

  <div class="mt-10 ">
    <div class="max-w-sm mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="mt-4" >
    <div stlye="padding-right: 1rem; padding-left: 1rem;">
    <p class="text-muted py-3" style="font-size: 25px; padding: 8px;">ประวัติการการซื้อ</p>

        </div>
    <table>
      <tr>
        <th>ราคา</th>
        <th>ชื่อ Username</th>
        <th>รหัสผ่าน</th>
        <th>เวลา</th>
      </tr>
      <?php
      $stmt = $db->query("SELECT * FROM buy_history WHERE user_id = {$row['id']}");
      while($gameHistory = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
      <tr>
        <td><?php echo $gameHistory['price'] ?></td>
        <td><?php echo $gameHistory['game_username'] ?></td>
        <td><?php echo $gameHistory['game_password'] ?></td>
        <td><?php echo $gameHistory['date'] ?></td>
      </tr>
      <?php } ?>
    </table>
    
    </div>
  </div>
  </div>

    </div>

    </div>

    <div class="container ">

    <div class="mt-10 ">
    <div class="max-w-sm mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="mt-4" >
    <div stlye="padding-right: 1rem; padding-left: 1rem;">
    <p class="text-muted py-3" style="font-size: 25px; padding: 8px;">ประวัติการเติม</p>

        </div>
    <table>
      <tr>
        <th>จำนวนเงิน</th>
        <th>สถานะ</th>
        <th>เวลา</th>
      </tr>
      <?php
      $getSlip = $db->prepare("SELECT * FROM payment_slips WHERE user_id = :id");
      $getSlip->execute(['id' => $row['id']]);
      while($slip = $getSlip->fetch(PDO::FETCH_ASSOC)){ ?>
      <tr>
        <td><?php echo $slip['amount'] . " ฿" ?></td>
        <td><?php echo str_replace(['approved','rejected','pending'],["<p style='color: green; font-weight: bold;'>Approved", "<p style='color: red; font-weight: bold;'>Rejected", "<p style='color: gray; font-weight: bold;'>Pending"], $slip['status']) ?></td>
        <td><?php echo $slip['created_at'] ?></td>
      </tr>
      <?php } ?>
    </table>
    
    </div>
  </div>
  </div>

    </div>

    </div>
  </section>
</main>

<footer >
  <div class="text-center">
    <p class="text-gray-400">&copy; 2024 Your Company. All rights reserved.</p>
  </div>
</footer>

<script src="script.js"></script>
</body>
</html>
