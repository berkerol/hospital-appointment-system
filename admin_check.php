<?php
  $conn = new mysqli("localhost", "root", "", "has");
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } else {
      $sql = "SELECT Username FROM admin WHERE Username = '" . hash('sha512', $_POST["Username"]) . "' AND Password = '" . hash('sha512', $_POST["Password"]) . "'" ;
      if ($conn->query($sql)->num_rows > 0) {
          session_start();
          $_SESSION['admin'] = $_POST["Username"];
          header("Location:admin_home.php");
          die();
      } else {
          $conn->close();
          die("<div>Wrong username or password.<a href = 'admin_login.php'>Try again</a></div>");
      }
  }
