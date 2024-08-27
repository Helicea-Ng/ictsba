<?php
    session_start();
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }
    if (!isset($_SESSION["email"])) {
        header("location: login.php");
        die();
    }

    /*foreach ($_SESSION["cart"] as $id => $value) {  
        echo "id: ";
        var_dump($value);
        echo "<br>";
    }*/

    if (isset($_GET["productID"])) {
        $id = $_GET["productID"];
        if (isset($_SESSION["cart"][$id])) {
            $_SESSION["cart"][$id]["count"] ++;
        }else {
            $con=mysqli_connect("localhost","onemoregod","rejected","dionysus") or die(mysqli_error($con));
            $sql = "select * from events where id = $id";
            if ($result = mysqli_query($con, $sql)) {
                if ($row = mysqli_fetch_row($result)) {  
                    
                    $_SESSION["cart"][$id] = array(
                        "count" => 1,
                        "name" => $row[1],
                        "price" => $row[9]
                    );
                }
                
            }
        }
    }

        
?>
<!DOCTYPE html>
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
        <div style="padding-top: 8%">
            <br>
            <div class="container">
                <center><table cellpadding="15px" class="table cart">
                    <tbody>
                        <tr>
                            <th class="cartTitle">Item Name</th>
                            <th class="cartTitle">Price</th>
                            <th class="cartTitle">Quantity</th>
                        </tr>

<?php
$total = 0;
foreach ($_SESSION["cart"] as $id => $value) { 
    $total += $value["price"]*$value["count"];
?>
    <tr>
        <td><?=$value["name"]?></td>
        <td><?=$value["price"]?></td>
        <th><?=$value["count"]?></th>
        <th><a href='#'>Remove</a></th>
    </tr>
<?php
}
?>
                        <tr>
                            <th>Total</th>
                            <th>$<?= $total?></th>

                        </tr>
                    </tbody>
                </table><br>
                    <a href="success.html" class="btn">Confirm Order</a><br><br><br>
                    <a href="ticket.php?all=1" class="btn">Continue shopping</a>
                </center>

            </div>
            <br><br><br><br><br><br><br><br><br><br>
            <footer class="footer">
               <div class="container text-center">
               </div>
           </footer>
        </div>
    </body>
</html>
