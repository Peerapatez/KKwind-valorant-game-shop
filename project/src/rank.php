<?php
session_start();
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
$sql = "SELECT point,id FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $point = $row['point'];
    $user_id = $row['id'];
} else {
    $point = 0; // กรณีไม่พบข้อมูลผู้ใช้ให้แสดง point เป็น 0
};

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

   <!-- Recommended Items Section -->
   <main>
   <section class="custom-bg p-6" style=" min-height: 100vh;">
    <div class="container borderbanner">
   
      <img src="baner/skin.png" alt="รูปภาพสินค้า" class="imgb">
      <h1 class="text-4xl  fontm ">Valorant สุ่ม Skin</h1>
      <p style="color: aliceblue; margin-left: 5% ;margin-right: 4.9%; margin-bottom: 40px;">สุ่ม skin✅ สุ่มพ้อยคงเหลือ ✅ รับประกันไม่โดนแบน ✅ ⚠️รหัสอาจมีคนเข้าซ้อนแต่ถ้าโชคดีก็ได้เล่นยาวๆ ⚠️ เปลี่ยนรหัสไม่ได้ ⛔ ไม่รับประกัน ⛔ หมายเหตุ : เข้าไม่ได้สามารถเคลมได้ 1 ครั้ง ภายใน 5 วันหลังซื้อ แต่ถ้าเกิดเป็น ID ที่ผมเขียนว่ามีโอกาศเล่นได้นานสูงจะ Claim ได้ภายใน 14 วันครับ! ID ไม่สามารถเข้าหน้าเว็ปได้ ต้อง Login ผ่านตัวเกมอย่างเดียว</p>
      
      <div class="grid grid-cols-12 sm:grid-cols-2 lg:grid-cols-3 ">

        <div class="card-skin sm:w-1/2 lg:w-1/3 p-3">
          <div>
            <h5 class=" text-center py-2">
              <span><i class="fas fa-coins"></i> 10 Point!</span>
            </h5>
            <img src="product/rank/immortal.png" class="card-img-top w-full">
          </div>
          <div class="my-3 text-start px-3">
            <div class="row">
              <div class="col-12 text-start">
                <h5 class="text-lg font-bold mt-3">1-1000 SKIN RANDOM</h5>
                <h5 class="text-md mt-3">50 ฿ </h5>
              </div>
              <div class="col-12">
                <button class='btn btn-danger' id='buyButton'>ซื้อสินค้า</button>
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

</body>
</html>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="script.js"></script>

<script>
document.getElementById('buyButton').addEventListener('click', function() {
    const user_id = <?php echo json_encode($user_id); ?>;
    console.log("user_id ",user_id);
    Swal.fire({
        title: 'คุณแน่ใจหรือไม่?',
        text: "คุณต้องการซื้อสินค้านี้ใช่หรือไม่?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5cdb5c',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่, ฉันต้องการซื้อ!',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "buy.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    try {
                        var response = JSON.parse(xhr.responseText);
                        if (response.status === 'success') {
                            Swal.fire(
                                'สำเร็จ!',
                                response.message,
                                'success'
                            ).then(() => {
                              window.location.href = 'histories.php';
                            });
                        } else {
                            Swal.fire(
                                'ผิดพลาด!',
                                response.message,
                                'error'
                            );
                        }
                    } catch (e) {
                        Swal.fire(
                            'ผิดพลาด!',
                            'เกิดข้อผิดพลาดในการประมวลผลข้อมูล',
                            'error'
                        );
                    }
                }
            };
            xhr.send("user_id=" + encodeURIComponent(user_id));
        }
    });
});

</script>
</body>
</html>