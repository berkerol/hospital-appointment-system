<html>
  <head>
    <link rel="stylesheet" type="text/css" href="a.css">
    <title>Edit a Doctor</title>
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
              $sql = "UPDATE doctor SET Name = '" . $_POST['Name'] . "', BranchID = " . $_POST['BranchID'] . " WHERE ID = " . $_POST['ID'];
              if ($conn->query($sql) === true) {
                  echo "Doctor was edited successfully.";
              } else {
                  echo "Error editing doctor: " . $conn->error . ".";
              }
              echo "<a href = 'admin_home.php'>Home Page</a>";
          }
          $conn->close();
      }
    ?>
  </body>
</html>
