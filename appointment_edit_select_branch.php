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
              $sql = "SELECT ID, Name FROM branch";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                  ?>
    <form action="appointment_edit.php?Time=<?php echo $_GET['Time']; ?>&DoctorID=<?php echo $_GET['DoctorID']; ?>&PatientID=<?php echo $_GET['PatientID']; ?>" method="post">
      Branch: <select name="BranchID">
      <?php
            while ($row = $result->fetch_assoc()) {
                if ($row['ID'] === $conn->query("SELECT BranchID FROM doctor WHERE ID = " . $_GET['DoctorID'])->fetch_assoc()['BranchID']) {
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
      <p><input type="submit" value="Select Branch" />
      <input type="reset" /></p>
    </form>
    <?php

              } else {
                  echo "0 branches.";
              }
              echo "<br><a href = 'patient_home.php'>Home Page</a>";
          }
          $conn->close();
      }
    ?>
  </body>
</html>
