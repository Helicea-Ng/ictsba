<?php
  session_start();

  require "connection.php";
  $password = $_POST["password"];
  $email = $_POST["email"];
  $valid = false;
  

  $sql = "select * from users where email='$email' and password='$password'";
  if ($result = mysqli_query($con, $sql)) {
      $rows_count = mysqli_num_rows($result);
      // check if exists or not
      if ($rows_count == 0) {
      ?>
          <script>
              window.alert("Wrong email or password");
          </script>
          <meta http-equiv="refresh" content="1; login.php" /> <!--wait 1 second then refresh
      <?
      }
      else {
          $_SESSION["email"] = $email;
          header("location: index.php");
      }
  }
  
  // Step 3 Close connection
  mysqli_close($con);