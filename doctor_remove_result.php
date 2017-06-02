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
              $sql = "DELETE FROM doctor WHERE ID = " . $_POST['ID'];
              if ($conn->query($sql) === true) {
                  echo "Doctor was removed successfully.";
              } else {
                  echo "Error removing doctor: " . $conn->error . ".";
              }
              echo "<a href = 'admin_home.php'>Home Page</a>";
          }
          $conn->close();
      }
    ?>
  </body>
</html>
