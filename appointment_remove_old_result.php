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
              if ($_GET['BranchID'] == 0) {
                  $sql = "DELETE FROM appointment WHERE appointment.Time < '" . $_POST['Time'] . "'";
              } else {
                  $sql = "DELETE app FROM appointment app INNER JOIN doctor ON app.DoctorID = doctor.ID WHERE doctor.BranchID = " . $_GET['BranchID'] . " AND app.Time < '" . $_POST['Time'] . "'";
              }
              if ($conn->query($sql) === true) {
                  echo "Appointments were removed successfully.";
              } else {
                  echo "Error removing appointments: " . $conn->error . ".";
              }
              echo "<a href = 'admin_home.php'>Home Page</a>";
          }
          $conn->close();
      }
    ?>
  </body>
</html>
