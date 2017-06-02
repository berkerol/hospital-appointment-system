<?php
  $conn = new mysqli("localhost", "root", "", "has");
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } else {
      $sql = "INSERT INTO patient(Username, Password) VALUES('" . $_POST["Username"] . "', '" . hash('sha512', $_POST["Password"]) . "')";
      if ($conn->query($sql) === true) {
          session_start();
          $_SESSION['patient'] = $_POST["Username"];
          header("Location:patient_home.php");
          die();
      } else {
          echo "Error adding doctor: " . $conn->error . ".<a href = 'patient_signup.php'>Try again</a>";
          $conn->close();
      }
  }
