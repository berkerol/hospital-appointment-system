<html>
  <head>
    <link rel="stylesheet" type="text/css" href="a.css">
    <title>Add a Branch</title>
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
              ?>
    <form action="branch_add_result.php" method="post">
      <p>Name: <input type="text" name="Name" /></p>
      <p><input type="submit" value="Add Branch" />
      <input type="reset" /></p>
    </form>
    <br><a href = 'admin_home.php'>Home Page</a>
    <?php

          }
          $conn->close();
      }
    ?>
  </body>
</html>
