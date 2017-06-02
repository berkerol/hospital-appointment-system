<html>
  <head>
    <link rel="stylesheet" type="text/css" href="a.css">
    <title>View Branches</title>
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
              $sql = "SELECT ID, Name FROM branch";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                  ?>
    <table>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Edit</th>
        <th>Remove</th>
      </tr>
    <?php
            while ($row = $result->fetch_assoc()) {
                ?>
      <tr>
        <td><?php echo $row["ID"]; ?></td>
        <td><?php echo $row["Name"]; ?></td>
        <td><a href = "branch_edit.php?ID=<?php echo $row["ID"]; ?>">Edit</a></td>
        <td><a href = "branch_remove.php?ID=<?php echo $row["ID"]; ?>">Remove</a></td>
      </tr>
    <?php

            } ?>
    </table>
    <?php

              } else {
                  echo "0 branches.";
              }
              echo "<br><a href = 'admin_home.php'>Home Page</a>";
          }
          $conn->close();
      }
    ?>
  </body>
</html>
