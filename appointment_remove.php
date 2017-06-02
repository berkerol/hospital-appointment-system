<html>
  <head>
    <link rel="stylesheet" type="text/css" href="a.css">
    <title>Cancel an Appointment</title>
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
              $sql = "SELECT Name FROM doctor WHERE ID = " . $_GET['DoctorID'];
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                  ?>
    <form action="appointment_remove_result.php?DoctorID=<?php echo $_GET['DoctorID'] ?>&PatientID=<?php echo $_GET['PatientID'] ?>" method="post">
    <?php
            $row = $result->fetch_assoc(); ?>
      Are you sure you want to cancel this appointment? <br>
      <p>Doctor: <input type="text" name="Doctor" value="<?php echo $row["Name"] ?>" readonly /></p>
      <p>Time: <input type="text" name="Time" value="<?php echo $_GET['Time']; ?>" readonly /></p>
      <p><input type="submit" value="Cancel Appointment" /></p>
    </form>
    <?php

              } else {
                  echo "Appointment does not exist.";
              }
              echo "<br><a href = 'patient_home.php'>Home Page</a>";
          }
          $conn->close();
      }
    ?>
  </body>
</html>
