<html>
  <head>
    <link rel="stylesheet" type="text/css" href="a.css">
    <title>Patient Home Page</title>
  </head>
  <body>
    <?php
      session_start();
      if (!isset($_SESSION['patient'])) {
          echo "<a href = 'patient_login.php'>Log In</a> or <a href = 'patient_signup.php'>Sign Up</a> to view this page.";
      } else {
          $conn = new mysqli("localhost", "root", "", "has");
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          } else {
              $sql = "SELECT ID FROM patient WHERE Username = '" . $_SESSION['patient'] . "'";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                  echo "Welcome, " . $_SESSION['patient'] . ".<br>";
                  $row = $result->fetch_assoc(); ?>
    <ul>
      <li><a href = 'appointment_add_select_branch.php?PatientID=<?php echo $row["ID"]; ?>'>Make appointment</a></li>
      <li><a href = 'appointment_view.php?PatientID=<?php echo $row["ID"]; ?>'>View appointments</a></li>
      <li><a href = 'patient_logout.php'>Log Out</a></li>
    </ul>
    <?php

              } else {
                  echo "Patient not found.";
              }
          }
      }
    ?>
  </body>
</html>
