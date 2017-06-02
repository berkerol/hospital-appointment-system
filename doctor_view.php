<html>
  <head>
    <link rel="stylesheet" type="text/css" href="a.css">
    <title>View Doctors</title>
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
              $sql = "SELECT ID, Name, BranchID FROM doctor";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                  ?>
    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Branch</th>
        <th>Edit</th>
        <th>Remove</th>
      </tr>
    <?php
            while ($row = $result->fetch_assoc()) {
                ?>
      <tr>
        <td><?php echo $row["ID"]; ?></td>
        <td><?php echo $row["Name"]; ?></td>
        <td><?php echo $conn->query("SELECT Name FROM branch WHERE ID = " . $row['BranchID'])->fetch_assoc()['Name']; ?></td>
        <td><a href = "doctor_edit.php?ID=<?php echo $row["ID"]; ?>&Name=<?php echo $row["Name"]; ?>&BranchID=<?php echo $row["BranchID"]; ?>">Edit</a></td>
        <td><a href = "doctor_remove.php?ID=<?php echo $row["ID"]; ?>">Remove</a></td>
      </tr>
    <?php

            } ?>
    </table>
    <?php

              } else {
                  echo "0 doctors.";
              }
              echo "<br><a href = 'admin_home.php'>Home Page</a>";
          }
          $conn->close();
      }
    ?>
  </body>
</html>
