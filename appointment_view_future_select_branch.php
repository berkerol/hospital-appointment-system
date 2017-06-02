<html>
  <head>
    <link rel="stylesheet" type="text/css" href="a.css">
    <title>View Future Appointments</title>
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
    <form action="appointment_view_future.php" method="post">
      Branch: <select name="BranchID">
        <option value=0>ALL</option>
      <?php
            while ($row = $result->fetch_assoc()) {
                ?>
        <option value=<?php echo $row['ID']; ?>><?php echo $row['Name']; ?></option>
        <?php

            } ?>
      </select>
      <p><input type="submit" value="Select Branch" />
      <input type="reset" /></p>
    </form>
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
