<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;700&display=swap" rel="stylesheet">
  <title>KKWIND SHOP</title>
  <link rel="icon" type="image/x-icon" href="logo/KW.png">
  <link href="output.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Custom Styles */
    .login-arrow {
      display: block;
      text-decoration: none;
      padding: 10px 30px;
      color: #fff; /* สีข้อความ */
      background-color: #ff9215;
      text-align: center;
      position: relative;
      border: 1px solid rgba(255, 255, 255, 0.493); /* ขอบปุ่ม */
      overflow: hidden; /* ป้องกันไม่ให้เอฟเฟกต์เกินขอบ */
      width: 100%; /* ความกว้างของปุ่ม */
      max-width: 400px; /* ความกว้างสูงสุด */
      margin: 0 auto; /* จัดกึ่งกลาง */
      transition: color 0.35s, border-color 0.35s; /* การเปลี่ยนแปลงอย่างราบรื่น */
    }

    .login-arrow::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background-color: #ff7b00;
      transition: left 0.35s;
      z-index: 0;
    }

    .login-arrow:hover::before {
      left: 0;
    }

    .login-arrow:hover {
      color: #000;
    }

    .register-link {
      color: #000000; /* สีคู่ตรงข้ามกับสีส้ม */
      font-size: 0.875rem; /* text-sm */
      margin-top: 10px;
      display: block;
      text-align: center;
      transition: color 0.3s ease-in-out;
    }

    .register-link:hover {
      color: #000000; /* สีเข้มขึ้นเมื่อ hover */
      text-decoration: underline;
    }
  </style>
</head>
<body class="flex items-center justify-center min-h-screen custom-bg">
  <div class="bg-transparent p-8 rounded-lg shadow-lg max-w-md w-full border-2 border-black bg-white">
    <h2 class="flex justify-center w-full">
      <img src="logo/KW.png" alt="Logo" class="w-auto">
    </h2>

    <?php
    session_start();
    if (isset($_SESSION['err_fill'])) {
        echo '<p class="text-red-500">' . $_SESSION['err_fill'] . '</p>';
        unset($_SESSION['err_fill']);
    }
    if (isset($_SESSION['err_uname'])) {
        echo '<p class="text-red-500">' . $_SESSION['err_uname'] . '</p>';
        unset($_SESSION['err_uname']);
    }
    if (isset($_SESSION['err_pw'])) {
        echo '<p class="text-red-500">' . $_SESSION['err_pw'] . '</p>';
        unset($_SESSION['err_pw']);
    }
    if (isset($_SESSION['err_db'])) {
        echo '<p class="text-red-500">' . $_SESSION['err_db'] . '</p>';
        unset($_SESSION['err_db']);
    }
    ?>

    <form class="mt-6 space-y-4" action="login_db.php" method="POST">
      <div>
        <label class="block text-black">Username</label>
        <input type="text" name="username" class="w-full p-2 mt-2 bg-transparent border-b-2 border-black text-black placeholder-black focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Enter your username" required>
      </div>
      <div>
        <label class="block text-black">Password</label>
        <input type="password" name="password" class="w-full p-2 mt-2 bg-transparent border-b-2 border-black text-black placeholder-black focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Enter your password" required>
      </div>
      <div class="flex justify-center mt-6">
        <button type="submit" class="login-arrow">
          &rarr;
        </button>
      </div>
    </form>
    <a href="index.php" class="register-link">กลับหน้าหลัก? คลิก</a>
    <a href="register.php" class="register-link">ยังไม่มีบัญชี? สมัครเลย</a>
  </div>
</body>
</html>
