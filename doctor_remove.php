<html>
  <head>
    <link rel="stylesheet" type="text/css" href="a.css">
    <title>Remove a Doctor</title>
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
              $sql = "SELECT ID, Name, BranchID FROM doctor WHERE ID = " . $_GET['ID'];
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                  ?>
    <form action="doctor_remove_result.php" method="post">
    <?php
            $row = $result->fetch_assoc(); ?>
      Are you sure you want to remove this doctor? <br>
      <p>ID: <input type="text" name="ID" value = "<?php echo $row["ID"] ?>" readonly /></p>
      <p>Name: <input type="text" name="Name" value = "<?php echo $row["Name"] ?>" readonly /></p>
      <p>Branch: <input type="text" name="BranchID" value = "<?php echo $conn->query("SELECT Name FROM branch WHERE ID = " . $row['BranchID'])->fetch_assoc()['Name']; ?>" readonly /></p>
      <p><input type="submit" value = "Remove Doctor" /></p>
    </form>
    <?php

              } else {
                  echo "Doctor does not exist.";
              }
              echo "<br><a href = 'admin_home.php'>Home Page</a>";
          }
          $conn->close();
      }
    ?>
  </body>
</html>
