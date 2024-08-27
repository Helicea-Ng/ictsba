<?php 
    session_start();
    require "connection.php";
    if (isset($_SESSION["email"])) {
        require "connection.php";
        $_email = mysqli_real_escape_string($con, $_SESSION["email"]);
        $sql = "select username from users where email = '$_email'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        $_SESSION["username"] = $row["username"];
    }
    $currentDate = date("Y-m-d");
    $currentMonth = date("m");
    $currentYear = date("Y");

?>
<!doctype html>
<html>
  <head>
      <link rel="shortcut icon" href="images/Dionysus.png" />
      <title>Tutorial</title>
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
  <body class="light">
      
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
      

        <!--main body-->
        <!--Search bar-->
        <div style="padding-top: 7%;">
        <h1 style="font-size: 40px;"><?php if (isset($_SESSION["username"])) {echo "Welcome, ".$_SESSION["username"]."!";} ?></h1><br>

                  
        <h1>Search for an event</h1>
              <center><form method="get" action="ticket.php">
                  <img src="UI/search.png" height="35px" style="vertical-align: middle">
                  <input class="searchBar" type="text" name="search" placeholder="Search">
              </form></center>
        </div>
    </body>
</html>