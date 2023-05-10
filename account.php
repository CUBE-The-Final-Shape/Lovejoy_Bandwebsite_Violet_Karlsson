<?php
session_start();
require('components/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // retrieve form data
    $id = $_POST['UID'];
    $name = htmlspecialchars($_POST['name']);
    $email = $_POST['email'];
    $password = htmlspecialchars($_POST['pass']);

    $query = "SELECT * FROM accounts WHERE username='$name'";
    $result = mysqli_query($connection, $query);
    $query2 = "SELECT * FROM accounts WHERE email='$email'";
    $result2 = mysqli_query($connection, $query2);

    $name_regex = '/^[a-zA-Z ]+$/';
    $email_regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    $pass_regex = '/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{6,12}$/';

    $errors = array();

    $sql3 = "SELECT accounts.email, accounts.username FROM accounts WHERE id='$id'"; // Modify the query to join the "posts" and "users" tables
    $result3 = $connection->query($sql3);
    $row2 = mysqli_fetch_assoc($result3);

    if(mysqli_num_rows($result) > 0){
      if ($result3->num_rows > 0) {
        if ($name != $row2["username"]){
          $errors['username'] = "Username already taken";
        }
      }
    } else if (!preg_match($name_regex, $name)) {
        $errors['username'] = "Username can only contain letters and spaces";
    }
    if(mysqli_num_rows($result2) > 0){
      if ($result3->num_rows > 0) {
        if ($email != $row2["email"]){
          $errors['email'] = "The inputed email is already in use";
        }
      }
    } else if (!preg_match($email_regex, $email)) {
        $errors['email'] = "Please enter a valid email or email format";
    }
    if (!preg_match($pass_regex, $password)) {
        $errors['password'] = "Please enter a valid password.<hr> A valid password has: <br> * At least 6 symbols<br> * Includes 1 letter<br> * Includes 1 number";
    }

    $nameErr = "";
    $emailErr = "";
    $passErr = "";

    $_SESSION['errors'] = $errors;

    if (count($errors) > 0) {

        if (isset($_SESSION['errors'])) {
          $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);
        }

        if (isset($errors)) {
            if (isset($errors['username'])) {
                $nameErr = $errors['username'];
                $fmsgNAME = "$nameErr";
            }
            if (isset($errors['email'])) {
                $emailErr = $errors['email'];
                $fmsgEMAIL = "$emailErr";
            }
            if (isset($errors['password'])) {
                $passErr = $errors['password'];
                $fmsgPASS = "$passErr";
            }
        }
      } else if (empty($nameErr) && empty($emailErr) && empty($passErr)) {
    // prepare and execute update query
    $sql = "UPDATE accounts SET username='$name', email='$email', password='$password' WHERE id=$id";

    if ($connection->query($sql) === TRUE) {
      $_SESSION['alert'] = "<h1 class='albumDisplay'>Account succesfully updated.</h1>";
      $_SESSION['username'] = $name;
    } else {
      $_SESSION['alert'] = "<h1 class='albumDisplay'>Account update failed.</h1>";
    }

    $connection->close();
  } else {
    $_SESSION['alert'] = "<h1 class='albumDisplay'>Account update failed.</h1>";
  }
}

$_SESSION['page'] = "account";
if(isset($_SESSION['alert'])){
  $alert = $_SESSION['alert'];
  unset($_SESSION['alert']);
} else {
  $alert = '';
}
if(isset($_SESSION['username'])){
  $username = $_SESSION['username'];
  $auth = $_SESSION['auth'];

  require('components/connect.php');

  include('components/head.php');
  include('components/navbar.php');

echo "<div class='container mt-5'>";
echo "$alert";

echo "<div class='row flex-grow-1'>"; // Add row to center the posts

$sql = "SELECT accounts.username, accounts.email, accounts.password, accounts.id FROM accounts WHERE username='$username'"; // Modify the query to join the "posts" and "users" tables
$result = $connection->query($sql);

// Display the posts
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $UID = $row["id"];
        echo "<div class='col-md-6 mb-4'>";
        echo "<h1>My account</h1><hr>";
        echo " <div class='d-flex justify-content-center align-items-center'>
                <img class='img-fluid' width='200vw' src='media/deafult.png'>
              </div>";
        echo "<div class='post py-3'>";
        echo "<form method='POST' name='form1'>";
        if(isset($fmsgNAME)){ echo"<div class='alert alert-danger' role='alert'> ".$fmsgNAME."</div>"; }else{}
        if(isset($fmsgEMAIL)){ echo"<div class='alert alert-danger' role='alert'> ".$fmsgEMAIL."</div>"; }else{}
        if(isset($fmsgPASS)){ echo"<div class='alert alert-danger' role='alert'> ".$fmsgPASS."</div>"; }else{}
        echo "<input type='hidden' name='UID' value='".$row["id"]."'>";
        echo "<tr><td>Account name:</td></tr>
              <input type='name' class='form-control' name='name' placeholder='Name' value='". $row["username"] ."'><br>";
        echo "<tr><td>Email:</td></tr>
              <input type='email' class='form-control' name='email' placeholder='Mail' value='". $row["email"] ."'><br>";
        echo "<tr><td>Password:</td></tr>
              <input type='password' class='form-control' name='pass' placeholder='Password' value='". $row["password"] ."'><br>";
        echo "<input type='submit' class='btn btn-dark my-2' value='Update profile'>";
        echo "</form>";
        echo "</div>";
        echo "</div>";

        echo "<div class='col-md-6 mb-4'>";
        echo "<h1>My orders</h1><hr>";
        $sql2 = "SELECT orders.ID, orders.timeofday, orders.town, orders.center, orders.ticket_amount, orders.xmlID FROM orders WHERE UID='$UID'";
        $result2 = $connection->query($sql2);
        if ($result2->num_rows > 0) {
          while($row = $result2->fetch_assoc()) {
          echo "<div class='post p-3 my-2 albumDisplay'>";
          echo "<input type='hidden' name='id' value='".$row["ID"]."'>";
          echo "<input type='hidden' name='xmlID' value='".$row["xmlID"]."'>";
          echo "<h3>" . $row["town"] . "</h3>";
          echo "<a href='redirect.php?id=".$row["ID"]."&xmlID=".$row["xmlID"]."' type='button' class='btn btn-dark my-2'>Cancel booking</a><hr> ";
          echo "<p>Date: " . $row["timeofday"] . "</p>";
          echo "<p>Center: " . $row["center"] . "</p>";
          echo "<p>Tickets: " . $row["ticket_amount"] . "</p>";
          echo "</div>";
      }
    }
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "No account found";
}

echo "</div></div>"; // Close the row
echo "</body>";
echo "</html>";

} else {
  header('Location: noentry.php');
}

?>
