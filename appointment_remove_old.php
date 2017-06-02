<html>
  <head>
    <link rel="stylesheet" type="text/css" href="a.css">
    <title>Remove Appointments</title>
  </head>
  <body>
    <?php
      session_start();
      if (!isset($_SESSION['admin'])) {
          echo "<a href = 'admin_login.php'>Log In</a> to view this page.";
      } else {
          $conn = new mysqli("localhost", "root", "", "has");
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          } else {
              if ($_POST['BranchID'] == 0) {
                  $sql = "SELECT Time, DoctorID, PatientID FROM appointment ORDER BY Time ASC";
              } else {
                  $sql = "SELECT Time, DoctorID, PatientID FROM appointment INNER JOIN doctor ON appointment.DoctorID = doctor.ID WHERE doctor.BranchID = " . $_POST['BranchID'] . " ORDER BY Time ASC";
              }
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                  ?>
    <table>
      <tr>
        <th>Time</th>
        <th>Doctor</th>
        <th>Patient</th>
      </tr>
    <?php
            while ($row = $result->fetch_assoc()) {
                ?>
      <tr>
        <td><?php echo $row['Time']; ?></td>
        <td><?php echo $conn->query("SELECT Name FROM doctor WHERE ID = " . $row['DoctorID'])->fetch_assoc()['Name']; ?></td>
        <td><?php echo $conn->query("SELECT Username FROM patient WHERE ID = " . $row["PatientID"])->fetch_assoc()['Username']; ?></td>
      </tr>
    <?php

            } ?>
    </table>
    <form action="appointment_remove_old_result.php?BranchID=<?php echo $_POST['BranchID'] ?>" method="post">
      <p>Older than: <input type="datetime-local" name="Time" step=300 /></p>
      <p><input type="submit" value="Remove Appointments" />
    </form>
    <?php

              } else {
                  echo "0 appointments.";
              }
              echo "<br><a href = 'admin_home.php'>Home Page</a>";
          }
          $conn->close();
      }
    ?>
  </body>
</html>
