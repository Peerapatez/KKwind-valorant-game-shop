<?php
require_once 'connection.php';
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;700&display=swap" rel="stylesheet">
  <title>KKWIND SHOP</title>
  <link rel="icon" type="image/x-icon" href="logo/KW.png" style="width: 155px; height: auto; padding: 12px; margin: 10px;">
  <link href="output.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- ส่วนหัว -->
<header class="bg-white border-b border-gray-300">
<nav class="mx-auto flex max-w-1 items-center justify-between p-1 lg:px-8" aria-label="Global">
  <div class="flex lg:flex-1">
    <a href="index.php" class="-m-1.5 p-1.5 " style="margin-left: 10%;">
      <span class="sr-only">Band</span>
      <img src="logo/KW.png" alt="Band Name"  style="width: 155px; height: auto; padding: 10px;">
    </a>
  </div>
  <div class="flex lg:hidden">
    <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700" onclick="toggleMobileMenu()">
      <span class="sr-only">Main menu</span>
      <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
      </svg>
    </button>
  </div>
  <div class="hidden lg:flex lg:gap-x-12">
    <div class="relative">
     
      <div class="absolute -left-8 top-full z-10 items-center mt-20 w-screen max-w-md overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-900/5 hidden" id="dropdownMenu">
        <div class="p-4">
          <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm leading-6 hover:bg-gray-50">
            <div class="flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
                <img src="your-image-url.jpg" alt="Image Description" class="h-full w-full object-cover rounded-lg" />
            </div>
            <div class="flex-auto">
                <a href="login.php" class="block font-semibold text-gray-900">
                    Valorant สุ่ม 
                    <span class="absolute inset-0"></span>
                </a>
                <p class="mt-1 text-gray-600">ได้Rankตามรูป</p>
            </div>
        </div>
          <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm leading-6 hover:bg-gray-50">
            <div class="flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
              <img src="your-image-url.jpg" alt="Image Description" class="h-full w-full object-cover rounded-lg" />
            </div>
            <div class="flex-auto">
              <a href="login.php" class="block font-semibold text-gray-900">
                Valorant สุ่ม Rank
                <span class="absolute inset-0"></span>
              </a>
              <p class="mt-1 text-gray-600">ได้Rankตามรูป</p>
            </div>
          </div>
          <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm leading-6 hover:bg-gray-50">
            <div class="flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
              <img src="your-image-url.jpg" alt="Image Description" class="h-full w-full object-cover rounded-lg" />
            </div>
            <div class="flex-auto">
              <a href="login.php" class="block font-semibold text-gray-900">
                การันตีสกิน
                <span class="absolute inset-0"></span>
              </a>
              <p class="mt-1 text-gray-600">ได้ของตามรูป 100% หรือว่าถ้าเกิดโชคดี ก็ได้มากกว่านี้อีก!!!</p>
            </div>
          </div>
          <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm leading-6 hover:bg-gray-50">
            <div class="flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
              <img src="your-image-url.jpg" alt="Image Description" class="h-full w-full object-cover rounded-lg" />
            </div>
            <div class="flex-auto">
              <a href="login.php" class="block font-semibold text-gray-900">
                การันตีของ rare
                <span class="absolute inset-0"></span>
              </a>
              <p class="mt-1 text-gray-600">ได้ของตามรูป 100% หรือว่าถ้าเกิดโชคดีก็ได้มากกว่านี้อีก!!!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <a href="login.php" class="vl-m-link">เติมเงิน</a>
    <a href="" class="vl-m-link">ติดต่อ</a>

    </div>
    <div class="hidden lg:flex lg:flex-1 lg:justify-end">
      <a href="login.php" class="vl-m-hover" style="margin-right: 10%;">Log in <span aria-hidden="true">&rarr;</span></a>
    </div>
  </nav>

  <!-- Mobile menu, show/hide based on mobile menu state. -->
  <div class="lg:hidden hidden" role="dialog" aria-modal="true" id="mobileMenu">
    <div class="fixed inset-0 z-10"></div>
    <div class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
      <div class="flex items-center justify-between">
        <a href="login.php" class="-m-1.5 p-1.5">
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
                <a href="login.php" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">Valorant สุ่ม Skin</a>
                <a href="login.php" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">Valorant สุ่ม Rank</a>
                <a href="login.php" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">การันตีสกิน</a>
                <a href="login.php" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">การันตีของ rare</a>
              </div>
            </div>
            <a href="#" class="block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">เติมเงิน</a>
            <a href="#" class="block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">ติดต่อ</a>
          </div>
          <div class="py-6">
            <a href="login.php" class="vl-m-link">Log in <span aria-hidden="true">&rarr;</span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>


<!-- Order Section -->
<main class=" mx-auto py-8 ">
<section class="custom-bg p-20  bg-cover bg-center" style=" min-height: 100vh;">
  <div class="max-w-4xl mx-auto  p-6 rounded-lg shadow-md">
      
    <!-- Your main content section -->
     <div class="relative isolate py-30 pt-14 lg:px-8">
      <!-- Background shape -->
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
    <!-- Your background shape or gradient -->
        </div>
          <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
    <!-- Your main content -->
               <div class="text-center">
                  <h1 class="vl-m">valorant</h1>
                  <p class="-mt-1 text-lg leading-8 text-white">📌ID Valorant🎮ราคาประหยัด สกินเท่ มีประกันสูงสุดถึง14⏱️วันเจ๋งจริง!

                    <div class="mt-10 flex items-center justify-center gap-x-6">
                      <a href="login.php" class="sungsinkha">
                          <span>สั่งซื้อสินค้า</span>
                      </a>
                  </div>

                  
        
                </div>
          </div>
    </div>
  </div>
  </section>
  </main>

   <!-- Recommended Items Section -->
    <div class="container"></div>
      <section class=" p-6" style=" min-height: 100vh;">
        <p style="margin-left: 1.6%;">สินค้าแนะนำ</p>
        <h2 style="margin-left: 1.6%;"class="text-2xl font-bold mb-4 mt-40">Recommended Items</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
          <?php 
          $stmt = $db->prepare("SELECT * FROM productType");
          $stmt->execute();
          while($productType = $stmt->fetch(PDO::FETCH_ASSOC)){
          ?>
          <div class="card-recommended ">
            <h3 class="text-xl font-semibold mb-2 shadow-lg">
              <a href="login.php"><img src="<?php echo $productType['type_img'] ?>" alt="Item Image"></a>
            </h3>
            <p class="select-none">
              <h1 class='text-4xl font-bold'><?php echo $productType['type_name'] ?></h1>
              <?php echo $productType['type_desc'] ?>
          </p>
          </div>
          <?php } ?>
        </div>
      </section>
    </div>

</main>



<footer >
  <div class="text-center">
    <p class="text-gray-400">&copy; 2024 Your Company. All rights reserved.</p>
  </div>
</footer>

</body>
</html>






<!-- End Header -->

<script>
  function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    mobileMenu.classList.toggle('hidden');
  }

  function toggleDropdown() {
    const dropdownMenu = document.getElementById('dropdownMenu');
    dropdownMenu.classList.toggle('hidden');
  }

  function toggleMobileDropdown() {
    const mobileDropdownMenu = document.getElementById('mobileDropdownMenu');
    mobileDropdownMenu.classList.toggle('hidden');
  }
</script>

</body>
</html>
