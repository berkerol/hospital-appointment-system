<html>
  <head>
    <link rel="stylesheet" type="text/css" href="a.css">
    <title>Edit an Appointment</title>
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
              $sql = "SELECT ID, Name FROM doctor WHERE BranchID = " . $_POST['BranchID'];
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                  ?>
    <form action="appointment_edit_result.php?Time=<?php echo $_GET['Time']; ?>&DoctorID=<?php echo $_GET['DoctorID']; ?>&PatientID=<?php echo $_GET['PatientID']; ?>" method="post">
      Doctor: <select name="DoctorID">
      <?php
            while ($row = $result->fetch_assoc()) {
                if ($row['ID'] === $_GET['DoctorID']) {
                    ?>
      <option value=<?php echo $row['ID']; ?> selected><?php echo $row['Name']; ?></option>
      <?php

                } else {
                    ?>
      <option value=<?php echo $row['ID']; ?>><?php echo $row['Name']; ?></option>
      <?php

                }
            } ?>
      </select>
      <p>Time: <input type="datetime-local" name="Time" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($_GET['Time'])); ?>" step=300 /></p>
      <p><input type="submit" value="Edit Appointment" />
      <input type="reset" /></p>
    </form>
    <?php

              } else {
                  echo "0 doctors.";
              }
              echo "<br><a href = 'patient_home.php'>Home Page</a>";
          }
          $conn->close();
      }
    ?>
  </body>
</html>
