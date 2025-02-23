<nav class="mx-auto flex max-w-1 items-center justify-between p-1 lg:px-8" aria-label="Global">
  <div class="flex lg:flex-1">
    <a href="index2.php" class="-m-1.5 p-1.5 " style="margin-left: 10%;">
      <span class="sr-only">Band</span>
      <img src="logo/KW.png" alt="Band Name" style="width: 155px; height: auto; padding: 12px; margin: 10px;">
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
                <img src="ui/1.png" alt="Image Description" class="h-full w-full object-cover rounded-lg" />
            </div>
            <div class="flex-auto">
                <a href="skin.php" class="block font-semibold text-gray-900">
                    Valorant สุ่ม 
                    <span class="absolute inset-0"></span>
                </a>
                <p class="mt-1 text-gray-600">ได้Rankตามรูป</p>
            </div>
        </div>
          <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm leading-6 hover:bg-gray-50">
            <div class="flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
              <img src="ui/2.png" alt="Image Description" class="h-full w-full object-cover rounded-lg" />
            </div>
            <div class="flex-auto">
              <a href="skinkr.php" class="block font-semibold text-gray-900">
                Valorant สุ่ม Rank
                <span class="absolute inset-0"></span>
              </a>
              <p class="mt-1 text-gray-600">ได้Rankตามรูป</p>
            </div>
          </div>
          <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm leading-6 hover:bg-gray-50">
            <div class="flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
              <img src="ui/3.png" alt="Image Description" class="h-full w-full object-cover rounded-lg" />
            </div>
            <div class="flex-auto">
              <a href="rare.php" class="block font-semibold text-gray-900">
                การันตีสกิน
                <span class="absolute inset-0"></span>
              </a>
              <p class="mt-1 text-gray-600">ได้ของตามรูป 100% หรือว่าถ้าเกิดโชคดี ก็ได้มากกว่านี้อีก!!!</p>
            </div>
          </div>
          <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm leading-6 hover:bg-gray-50">
            <div class="flex h-11 w-11 flex-none items-center justify-center rounded-lg bg-gray-50 group-hover:bg-white">
              <img src="ui/4.png" alt="Image Description" class="h-full w-full object-cover rounded-lg" />
            </div>
            <div class="flex-auto">
              <a href="rank.php" class="block font-semibold text-gray-900">
                การันตีของ rare
                <span class="absolute inset-0"></span>
              </a>
              <p class="mt-1 text-gray-600">ได้ของตามรูป 100% หรือว่าถ้าเกิดโชคดีก็ได้มากกว่านี้อีก!!!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <a href="point.php" class="vl-m-link">เติมเงิน</a>
    <a href="https://discord.gg/w8eWtD8m" class="vl-m-link">ติดต่อ</a>
  </div>
  <div class="hidden lg:flex lg:flex-1 lg:justify-end">


  <div class="relative inline-block text-left">
  <div class="flex">
    <button id="menuButton" class="inline-flex justify-center w-full  dropdown-button px-4 py-2 text-sm font-medium text-gray-700  " onclick="toggleMenuDropdown()">
      <img src="ui/user.png" alt="" width="30" high="auto">
    </button>
    <a class="block items-center px-4 py-2 text-sm text-gray-700" role="menuitem"><?php echo $_SESSION['username']; ?></a>
    <a class="block items-center px-4 py-2 text-sm text-gray-700" role="menuitem"><?php echo $point; ?>฿</a>
  </div>

  <div id="menuDropdown" class="absolute text-center  z-10 mt-4  origin-top-right  bg-white hidden">
  <div class="py-1" role="none">
    
    <a href="histories.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50" role="menuitem">เช็คประวัติ</a>
    <a href="index.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50" role="menuitem">Logout&rarr;</a>
</div>
  </div>
</div>

    

</div>

  

</nav>