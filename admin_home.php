<html>
  <head>
    <link rel="stylesheet" type="text/css" href="a.css">
    <title>Admin Home Page</title>
  </head>
  <body>
    <?php
      session_start();
      if (!isset($_SESSION['admin'])) {
          echo "<a href = 'admin_login.php'>Log In</a> to view this page.";
      } else {
          echo "Welcome, " . $_SESSION['admin'] . ".<ul>
        <li><a href = 'branch_add.php'>Add branch</a></li>
        <li><a href = 'branch_view.php'>View branches</a></li>
        <li><a href = 'doctor_add.php'>Add doctor</a></li>
        <li><a href = 'doctor_view.php'>View doctors</a></li>
        <li><a href = 'appointment_view_past_select_branch.php'>View past appointments</a></li>
        <li><a href = 'appointment_view_future_select_branch.php'>View future appointments</a></li>
        <li><a href = 'appointment_remove_old_select_branch.php'>Remove appointments</a></li>
        <li><a href = 'admin_logout.php'>Log Out</a></li></ul>";
      }
    ?>
  </body>
</html>
