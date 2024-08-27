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
    <div id="body">  
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

                  
        <h1 style="font-family: tommy">Search for an event</h1>
              <center><form method="get" action="ticket.php">
                  <img src="UI/search.png" height="35px" style="vertical-align: middle">
                  <input class="searchBar" type="text" name="search" placeholder="Search">
              </form></center>
        </div>

        <!--Logo2-->
        <div class="block">
            <center><img src="UI/logo2.png"><br>
            <img src="UI/text.png" height="30px"></center>
        </div>

        
        
        <!--ads-->
        <!--
        <div class="banner">
            <?php
                $sql = "select distinct ad from events order by date";
                if ($result = mysqli_query($con, $sql)) {
                    while ($row = mysqli_fetch_row($result)) {
                        ?>
                        <img src="images/<?=$row[0]?>" class="ad">
                        <?php
                    }
                }
            ?>
        </div>

        <div width="100%" style="padding: 10px 60px">
            <a href="ticket.php?all=1"><button class="btn"><h1>View all events</h1></button></a>
            <a href="calendar.php"><button class="btn"><h1>Calendar</h1><img src="UI/calendar.png" class="emoji"></button></a>
        </div>-->
        <!--This month-->
        <div>
            <h1>This month</h1>
            <div class="eventArea">
                  <div class="monthTop"></div>
            <div class="photobanner">
            <?php
                $sql = "select distinct name, date, time, img from events where month(date) = {$currentMonth} && year(date) = {$currentYear} && date > $currentDate order by date";
                if ($result = mysqli_query($con, $sql)) {
                        while ($row = mysqli_fetch_row($result)) {
            ?>
                <div class="minEvent">
                    <h2><?= $row[1]?></h2><hr>
                    <img src="images/<?= $row[3]?>" height="120px"><br>
                    <h3><?= $row[0]?></h3><br>
                    <h4> Time: <?= $row[2]?></h4><br>
                </div>
                <?php }
                }?>
            </div>
        </div>

        <!--Categories-->
        <h1>Sort by category</h1>
        <hr>
            <br>
            <a class="btn cat" href="ticket.php?category=music">Music<img src="UI/note.png" class="emoji"></a> 
            <a class="btn cat" href="ticket.php?category=talk">Talk<img src="UI/talk.png" class="emoji"></a> 
            <a class="btn cat" href="ticket.php?category=drama">Drama<img src="UI/drama.png" class="emoji"></a> 
            <a class="btn cat" href="ticket.php?category=exhibition">Exhibition<img src="UI/exhibit.png" class="emoji"></a>
            <a class="btn cat" href="ticket.php?category=fes">Fes<img src="UI/wine.png" class="emoji"></a><br><br><br><br>

        <div>
            <h1>Music related events</h1><br>
            <div class="block2">
            <?php
                $sql = "select distinct ad, name from events where category = 'music'";
                if ($result = mysqli_query($con, $sql)) {  // Step 2. Query 
                    while ($row = mysqli_fetch_row($result)) {
            ?>
                <div width="300px" class="sevent">
                    <center>
                        <a href="ticket.php?get=<?= $row[1]?>"><img src="images/<?= $row[0]?>" height="260px"></a>
                    </center>
                </div>
            <?php
                }
            }
            ?>
            </div>
            <h1>Talk shows</h1><br>
            <h1>Drama</h1><br>
            <h1>Exhibitions</h1><br>
            <h1>Festivals</h1><br>
        </div>
        <!--Show all
        <div class="eventArea">
            <?php
                $sql = "select * from events";
                if ($result = mysqli_query($con, $sql)) {  // Step 2. Query 
                    while ($row = mysqli_fetch_row($result)) {  // Step 3. Fetch 1 row
            ?>
            <a href="tickets.php?event=<?=$row[1]?>"><div class="event">
                <img src="images/<?= $row[6]?>" height="240px"><br>
                <h3><?= $row[1]?></h3>
                <p>Venue: <?= $row[3]?><br>
                Date: <?= $row[4]?><br>
                Time: <?= $row[5]?><br>
                Organizer: <?= $row[2]?>
                </p>
            </div>
            <?php }
            }?> 
        </div></a>-->
        <!--
        <button id="minus" onclick="change(1)">+</button>
        <h4 style="margin: 5px 10px;" id="counter">1</h4>
        <button id="plus" onclick="change(-1)">-</button>
        -->
        </div>
    </body>
</html>