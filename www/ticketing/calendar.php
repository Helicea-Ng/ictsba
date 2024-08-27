<?php 
    session_start();
    require "connection.php";
    $currentYear = date("Y");
    $currentDate = date("D-M-Y");
    $currentMonth = ""; //string
    $_GET["month"] = (int) date("m"); //variable: default set current month
    /* if ($_GET["month"] == 1) {
        $currentMonth= "January";
    } else if ($_GET["month"] == 2){
        $currentMonth = "February";
    } else if ($_GET["month"] == 3){
        $currentMonth = "March";
    } else if ($_GET["month"] == 4){
        $currentMonth = "April";
    } else if ($_GET["month"] == 5){
        $currentMonth = "May";
    } else if ($_GET["month"] == 6){
        $currentMonth = "June";
    } else if ($_GET["month"] == 7){
        $currentMonth = "July";
    } else if ($_GET["month"] == 8){
        $currentMonth = "August";
    } else if ($_GET["month"] == 9){
        $currentMonth = "September";
    } else if ($_GET["month"] == 10){
        $currentMonth = "October";
    } else if ($_GET["month"] == 11){
        $currentMonth = "November";
    } else if ($_GET["month"] == 12){
        $currentMonth = "December";
    } */
?>
<!doctype html>
<html>
    <head>
        <link rel="shortcut icon" href="images/Dionysus.png" />
        <title>Ticket purchasement</title>
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
              <!--<li><a class="navItem"  href="index.php"><img src="UI/Home.png" height="28px"></a></li>-->
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

        <div style="padding-top: 8%;">        
            <button onclick="goBack()"><img src="UI/return.png" height="50px"></button>
            <center>
                <h1>Upcoming events in <?=$currentYear?>!</h1>
            </center>
            <?php
                while ($_GET["month"]<13) {
            ?>
            
            <table class="calendar">
                <tr>
                    <th><?php
                    if ($_GET["month"] == 1) {
                        $currentMonth= "January";
                    } else if ($_GET["month"] == 2){
                        $currentMonth = "February";
                    } else if ($_GET["month"] == 3){
                        $currentMonth = "March";
                    } else if ($_GET["month"] == 4){
                        $currentMonth = "April";
                    } else if ($_GET["month"] == 5){
                        $currentMonth = "May";
                    } else if ($_GET["month"] == 6){
                        $currentMonth = "June";
                    } else if ($_GET["month"] == 7){
                        $currentMonth = "July";
                    } else if ($_GET["month"] == 8){
                        $currentMonth = "August";
                    } else if ($_GET["month"] == 9){
                        $currentMonth = "September";
                    } else if ($_GET["month"] == 10){
                        $currentMonth = "October";
                    } else if ($_GET["month"] == 11){
                        $currentMonth = "November";
                    } else if ($_GET["month"] == 12){
                        $currentMonth = "December";
                    }
                    echo $currentMonth;
                    ?></th>
                </tr>
                <?php 
                    $sql = "select distinct name, date, month(date), day(date) from events order by date";
                    if ($result = mysqli_query($con, $sql)) {  // Step 2. Query 
                        while ($row = mysqli_fetch_row($result)) {  // Step 3. Fetch 1 row    
                            if ($row[2] == $_GET["month"]) {
                ?>
                        <tr>
                            <th><?=$row[3]?></th>                                                
                            <td><a href="ticket.php?get=<?=$row[0]?>"><?=$row[0]?></a></td>
                        </tr>
                <?php
                              }
                        }
                    }
                ?>
                </tr>
            </table>
        <?php
                    $_GET["month"] += 1;
                }
        ?>
        </div>
    </body>
</html>
