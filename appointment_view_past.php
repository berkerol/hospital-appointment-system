<html>
  <head>
    <link rel="stylesheet" type="text/css" href="a.css">
    <title>View Past Appointments</title>
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
                  $sql = "CALL viewPast('ALL')";
              } else {
                  $sql = "CALL viewPast('" . $conn->query("SELECT Name FROM branch WHERE ID = " . $_POST['BranchID'])->fetch_assoc()['Name'] . "')";
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
        <td><?php echo $row["Name"]; ?></td>
        <td><?php echo $row["Username"]; ?></td>
      </tr>
    <?php

            } ?>
    </table>
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
