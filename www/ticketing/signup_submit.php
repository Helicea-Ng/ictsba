<?php
session_start();
  function console_log($data) {
      $output = $data;
      if (is_array($output))
          $output = implode(',', $output);

      echo "<script>console.log('Log: " . $output . "' );</script>";
  }

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordC = $_POST["passwordC"];
    $contact = $_POST["contact"];
    $address = $_POST["address"];
    $valid = true;  
    
  //confirm password (entering password twice)
if (!$password == $passwordC) {
    echo "
    <script>window.alert('Please make sure that you have entered the password correctly!')</script>
    <meta http-equiv='refresh' content='1; signup.php' />";
    $valid = false;
}

if (!(str_contains($email, "@")&&str_contains($email,"."))) {
        echo "<script>window.alert('Incorrect email format!')</script>
    <meta http-equiv='refresh' content='1; signup.php' />";
        $valid = false;
}

if (strlen($password)<8) {
        echo "
    <script>window.alert('Your password should be at least 8 characters long!')</script>
    <meta http-equiv='refresh' content='1; signup.php' />";
        $valid = false;
}


// Step 1 Connect to database (Remember update the credential and dbname)
    $con = mysqli_connect("localhost","onemoregod","rejected","dionysus") or die(mysqli_error($con));
    $sql = "select * from users";
    
    if ($result = mysqli_query($con, $sql)) {  // Step 2. Query 
            while ($row = mysqli_fetch_row($result)) {  
                if ($row[2]==$email) {
                    echo "<script>window.alert('That email is already registered.')</script>
                    <meta http-equiv='refresh' content='1; signup.php' />";
                    $valid = false;
                }
             }
    }

  // Step 2 Insert Data.  Create INSERT statement here.
if ($valid==true) {
    $sql = "insert into users (username, email, password, contact, address) values ('$username', '$email', '$password', '$contact', '$address')";
    mysqli_query($con, $sql);
    header("location: login.php");
}
  // Step 3 Close connection
  mysqli_close($con);


  //Step 4 redirect user
?>