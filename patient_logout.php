<html>
  <head>
    <link rel="stylesheet" type="text/css" href="a.css">
    <title>Patient Log Out Page</title>
  </head>
  <body>
    <?php
      session_start();
      unset($_SESSION['patient']);
      die("<div>You have successfully logged out.<a href = 'patient_login.php'>Log In</a></div>")
    ?>
  </body>
</html>
