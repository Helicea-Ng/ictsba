<?php
session_start();
?>
<!doctype html>
<html>
  <head>
      <link rel="shortcut icon" href="images/Dionysus.png" />
      <title>Home</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
      <!-- jquery library -->
      <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
      <!-- Latest compiled and minified javascript -->
      <script type="text/javascript" src="js/scripts.js"></script>
      <!-- External CSS -->
      <link rel="stylesheet" href="css/styles.css" type="text/css">
      <meta charset="utf-8">

      <!--NAVIGATION BAR COPY TO EVERY OTHER DISPLAYABLE FILE-->
    <div>
          <ul id="navbar">
            <li><a href="index.php"><img style="margin-top: 4px;" src="images/Dionysus.png" height="30px"></a></li>
            
          <?php 
              if (isset($_SESSION["email"])) {
          ?>      

            <li class="navItem"><a href="logout.php">Log out</a></li>
            <li class="navItem"><a href="cart.php">Cart</a></li>

          <?php 
              } else { ?>

            <li class="navItem"><a href="signup.php">Sign up</a></li>
            <li class="navItem"><a href="login.php">Log in</a></li>

          <?php } ?> 

        </ul>
        <button class="clear" id="menu" onclick="showMenu()"><img src="UI/menu.png" height="24px"></button>
    </div>
      <script src="scripts.js"></script>
  </head>
  <body>


        <!--Menu navi-->
        <div id="menuDiv" class="invis">
            <ul style="list-style-type: none;">
            <li><a class="menuItem" href="index.php">Home</a></li>
            <?php
                if (isset($_SESSION["email"])) {
                    echo "<li><a class='menuItem' href='logout.php'>Log out</a></li>";
                } else {
                    echo "<li><a class='menuItem' href='login.php'>Login</a></li>";
                }
            ?>
            <li><a class="menuItem" onclick="">Purchase history</a></li>
            <li><a href="cart.php" class="menuItem">Cart</a></li>
            <li><a onclick="expand(0)" class="menuItem" id="alang">Language <img id="alangImg" src="UI/down.png" height="8px"></a></li>
                <div id="lang" class="invis">
                    <a class="menuItem lang" href="#">English</a><br>
                    <a class="menuItem lang" href="#">繁體中文</a>
                </div>
            </ul>
        </div>

    <!--fix position-->
    <center>
      <form style="padding-top: 7%;"method="post" action="signup_submit.php">
        <div class="block2">
          <h1 style="text-align: center">Sign up</h1><br>
          Username: <sup style="color: red">*</sup> <br>
          <input class="form" type="text" name="username" placeholder="Username" required> <br>
          Email address: <sup style="color: red">*</sup><br>
          <input class="form" type="text" name="email" placeholder="Email" required><br>
          Password: <sup style="color: red">*</sup><br>
          <input class="form" type="password" name="password" placeholder="Password (not less than 8 characters long)" required><br>
          Confirm password: <sup style="color: red">*</sup><br>
          <input class="form" type="password" name="passwordC" placeholder="Password" required><br>
          Contact number: <br>
          <input class="form" type="number" name="contact" placeholder="Contact number"><br>
          Shipping address: <br>
          <input class="form" type="text" name="address" placeholder="Shipping address"><br>
          <center><input class="submit btn" type="submit" name="submit" value="Register"></center>
        </div>
      </form></center>
  </body>
</html>