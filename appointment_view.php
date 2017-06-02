<html>
  <head>
    <link rel="stylesheet" type="text/css" href="a.css">
    <title>View Appointments</title>
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
              $sql = "SELECT Time, DoctorID FROM appointment WHERE PatientID = " . $_GET['PatientID'] . " ORDER BY Time ASC";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                  ?>
    <table>
      <tr>
        <th>Time</th>
        <th>Doctor</th>
        <th>Edit</th>
        <th>Cancel</th>
      </tr>
    <?php
            while ($row = $result->fetch_assoc()) {
                ?>
      <tr>
        <td><?php echo $row['Time']; ?></td>
        <td><?php echo $conn->query("SELECT Name FROM doctor WHERE ID = " . $row['DoctorID'])->fetch_assoc()['Name']; ?></td>
        <td><a href = "appointment_edit_select_branch.php?Time=<?php echo $row["Time"]; ?>&DoctorID=<?php echo $row["DoctorID"]; ?>&PatientID=<?php echo $_GET['PatientID']; ?>">Edit</a></td>
        <td><a href = "appointment_remove.php?Time=<?php echo $row["Time"]; ?>&DoctorID=<?php echo $row["DoctorID"]; ?>&PatientID=<?php echo $_GET['PatientID']; ?>">Cancel</a></td>
      </tr>
    <?php

            } ?>
    </table>
    <?php

              } else {
                  echo "0 appointments.";
              }
              echo "<br><a href = 'patient_home.php'>Home Page</a>";
          }
          $conn->close();
      }
    ?>
  </body>
</html>
