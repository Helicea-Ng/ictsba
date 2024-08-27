<?php 
    session_start();
    require "connection.php";
    $currentDate = date("D-M-Y");
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
        <?php 
            if (isset($_GET["search"])) {
                $search = $_GET["search"];
                $_search="%$search%";
                $sql = sprintf("select distinct name, img from events where name like '%s'",
                    mysqli_real_escape_string($con, $_search));
                echo "<h1>Search results for $search: </h1>";
                
            } else if (isset($_GET["category"])) {
                $category = $_GET["category"];
                $sql = "select distinct name,img from events where category = '$category'";
            } else if (isset($_GET["all"])) {
                $sql = "select distinct name, img from events";
            } else if (isset($_GET["get"])) {
               $get = $_GET["get"];
               $sql = "select * from events where name = '$get'";
            }
        
        if (isset($search)) {
            //echo "<h1>Search results for $search: </h1>";
        } else if (isset($category)) {
            echo "<h1>Sort by category ---- $category:</h1>";
        } else if (isset($_GET["all"])) {
            echo "<h1>All event tickets available:</h1>";
        } else if (isset($get)) {
            echo "<h1>$get :</h1>";
        }
        ?>
        <div class="ticket-container">
            <div style="width: 50%">

        <?php
        if (!isset($get)) {
            if ($result = mysqli_query($con, $sql)) {  // Step 2. Query 
                while ($row = mysqli_fetch_row($result)) {  // Step 3. Fetch 1 row
            ?>
                    <a href="ticket.php?get=<?=$row[0]?>"><div class="ticket" style="background-image: url('UI/ticket.png')">
                        <p><?=$row[0]?></p>
                    </div></a>
            <?php
                 }
    
            }
        } else {
            if (isset($_GET["get"])) {
               $get = $_GET["get"];
               $sql = "select * from events where name = '$get' group by name order by date";
                    if ($result = mysqli_query($con, $sql)) {  // Step 2. Query 
                        while ($row = mysqli_fetch_row($result)) {  // Step 3. Fetch 1 row
                    ?>
                            <div class="ticketBuy" >
                                <form action="cart.php" method="get"><center>
                                    <h2>Buy a ticket for <?=$row[1]?></h2><br>
                                    <?php
                                        if (!empty($row[11])) {
                                            echo "<h4>Please select the desired ticket type: </h4><br>";
                                            $sql2 = "select * from events where name = '$get' group by comments order by price";
                                            if ($result = mysqli_query($con, $sql2)) { 
                                                while ($row = mysqli_fetch_row($result)) { 
                                                    echo "<input type='radio' name='productID' id='productID' value='{$row[0]}' required>";
                                                    echo "<label>{$row[11]}(\${$row[9]})</label><br>";
                                                }
                                            }
                                            echo "<br>";
                                        }

                                    ?>
                                    <a href="cart.php?productID=<?= $row[0]?>"><button class="cartbtn" id="addCart">Add to cart</button></a>
                                </form>

                            </center>
                    <?php
                         }
    
                    }
            }
        }    
                                    
        if ($result->num_rows == 0) {
            echo "<h2>No events found.</h2>";
            echo "<img src='UI/not found.png' class='emoji'>";
            echo "</div>";
        }
            /*$sql = sprintf("select * events where name like '$search'",
                mysql_real_escape_string($search)
            );*/
        ?>
        <!--<?php if (!(isset($_GET["search"])||isset($_GET["all"])||isset($_GET["category"]))) {
        ?>
            <button id="minus" onclick="change(1)">+</button>
            <h4 style="margin: 5px 10px;" id="quantity">1</h4>
            <button id="plus" onclick="change(-1)">-</button><br>
            <a href="cart.php?productID= <?= $row[0]?>"><button class="cartbtn" id="addCart">Add to cart</button></a>
        <?php
        }
        ?>-->
            </div>
    </div>    
    <!--###################################################RIGHT SIDE#########################################################-->
    <div class="viewTicket">
        <?php
        if (isset($get)) {
            $sql = "select * from events where name = '$get' group by name";
            if ($result = mysqli_query($con, $sql)) {  // Step 2. Query 
                while ($row = mysqli_fetch_row($result)) {  // Step 3. Fetch 1 row
            ?>
                                                          
            <div>
                <img src="images/<?=$row[6]?>" width="50%"><br>
                <p>
                    <b>Event name:</b> <?=$row[1]?> <br>
                    <b>Organizer:</b> <?=$row[2]?> <br>
                    <?php
                        if ($row[7]=="fes") {
                            $sql3 = "select name, org, venue, max(date) as maxDate, min(date) as minDate, time, category, length, comments, descEng, descChn from events where name = '$get'";
                            if ($result = mysqli_query($con, $sql3)) {  // Step 2. Query 
                                while ($row = mysqli_fetch_row($result)) {  // Step 3. Fetch 1 row
                                    echo "<h3 class='info'>Information: </h3><br>";
                                    echo "This events lasts for {$row[7]} days, starting from {$row[4]} to {$row[3]}. <br>";
                                    echo "<h3 class='info'>About {$row[1]}: </h3><br>";
                                    echo "{$row[9]}";
                                    /* COUNTER!!!!!!!
                                    <button id="minus" onclick="change(1)">+</button>
                                    <h4 style="margin: 5px 10px;" id="quantity">1</h4>
                                    <button id="plus" onclick="change(-1)">-</button><br>
                                    */
                                }
                            }
                        }
                        else{
                            echo "<b>Date: </b>", $row[4];
                        }
                        echo "<h3 class='info'>About {$row[1]}: </h3><br>";
                    ?>
                </p>
            </div>
                                                          
            <?php
                 }
    
            }
        }
            ?>
    </div>
    </div>

  </body>
</html>
      