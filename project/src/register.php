<?php
session_start(); // เริ่ม session
?>

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

      .login-arrow span {
          position: relative;
          z-index: 1;
          transition: opacity 0.35s;
      }

      .login-link {
          color: #000000;
          font-size: 0.875rem; /* text-sm */
          margin-top: 10px;
          display: block;
          text-align: center;
          transition: color 0.3s ease-in-out;
      }

      .login-link:hover {
          color: #000000;
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
        if (isset($_SESSION['err_fill'])) {
            echo "<div class='text-red-500'>" . $_SESSION['err_fill'] . "</div>";
            unset($_SESSION['err_fill']);
        }
        if (isset($_SESSION['exist_uname'])) {
            echo "<div class='text-red-500'>" . $_SESSION['exist_uname'] . "</div>";
            unset($_SESSION['exist_uname']);
        }
        if (isset($_SESSION['exist_email'])) {
            echo "<div class='text-red-500'>" . $_SESSION['exist_email'] . "</div>";
            unset($_SESSION['exist_email']);
        }
        if (isset($_SESSION['err_email'])) {
            echo "<div class='text-red-500'>" . $_SESSION['err_email'] . "</div>";
            unset($_SESSION['err_email']);
        }
        if (isset($_SESSION['err_pw'])) {
            echo "<div class='text-red-500'>" . $_SESSION['err_pw'] . "</div>";
            unset($_SESSION['err_pw']);
        }
        if (isset($_SESSION['err_insert'])) {
            echo "<div class='text-red-500'>" . $_SESSION['err_insert'] . "</div>";
            unset($_SESSION['err_insert']);
        }
        if (isset($_SESSION['err_db'])) {
            echo "<div class='text-red-500'>" . $_SESSION['err_db'] . "</div>";
            unset($_SESSION['err_db']);
        }
        ?>

        <form action="register_db.php" method="POST" class="mt-6 space-y-4">
            <div>
                <label class="block text-black">Username</label>
                <input type="text" name="username" class="w-full p-2 mt-2 bg-transparent border-b-2 border-black text-black placeholder-black focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your username" required>
            </div>
            <div>
                <label class="block text-black">Email</label>
                <input type="email" name="email" class="w-full p-2 mt-2 bg-transparent border-b-2 border-black text-black placeholder-black focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your email" required>
            </div>
            <div>
                <label class="block text-black">Password</label>
                <input type="password" name="password" class="w-full p-2 mt-2 bg-transparent border-b-2 border-black text-black placeholder-black focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Create a password" required>
            </div>
            <div>
                <label class="block text-black">Confirm Password</label>
                <input type="password" name="confirm_password" class="w-full p-2 mt-2 bg-transparent border-b-2 border-black text-black placeholder-black focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Confirm your password" required>
            </div>
            <div class="flex justify-center mt-6">
                <button type="submit" name="submit" class="login-arrow">
                    &rarr;
                </button>
            </div>
        </form>
        <a href="index.php" class="login-link">กลับหน้าหลัก? คลิก</a>
        <a href="login.php" class="login-link">มีบัญชีอยู่แล้ว? ล็อคอินเลย</a>
    </div>
</body>
</html>
