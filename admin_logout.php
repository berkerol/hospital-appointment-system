<html>
  <head>
    <link rel="stylesheet" type="text/css" href="a.css">
    <title>Admin Log Out Page</title>
  </head>
  <body>
    <?php
      session_start();
      unset($_SESSION['admin']);
      die("<div>You have successfully logged out.<a href = 'admin_login.php'>Log In</a></div>")
    ?>
  </body>
</html>
