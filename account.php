<?php
session_start();
require('components/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // retrieve form data
    $id = $_POST['UID'];
    $name = htmlspecialchars($_POST['name']);
    $email = $_POST['email'];
    $password = htmlspecialchars($_POST['pass']);
    $confirmPass = $_POST['confirmPass'];

    // prepare and execute update query
    $sql = "UPDATE accounts SET username='$name', email='$email', password='$password' WHERE id=$id";

    if ($connection->query($sql) === TRUE) {
      $_SESSION['alert'] = "<h1 class='albumDisplay'>Account succesfully updated.</h1>";
      $_SESSION['username'] = $name;
    } else {
      $_SESSION['alert'] = "<h1 class='albumDisplay'>Account update failed.</h1>";
    }

    $connection->close();
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
          echo "<div class='post p-3 albumDisplay'>";
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
echo "<footer class='footer py-3 bg-dark fixed-bottom d-none d-lg-block'>";
echo "<ul class='nav justify-content-center border-bottom pb-3 mb-3'>";
echo "<li class='nav-item'><a href='Index.php#' class='nav-link px-2 text-muted'>Index</a></li>";
echo "<li class='nav-item'><a href='Index.php#albums' class='nav-link px-2 text-muted'>Music</a></li>";
echo "<li class='nav-item'><a href='Index.php#about' class='nav-link px-2 text-muted'>This is Lovejoy</a></li>";
echo "<li class='nav-item'><a href='Index.php#concerts' class='nav-link px-2 text-muted'>Concerts</a></li>";
echo "</ul>";
echo "<span class='mb-3 ms-5 mb-md-0 text-muted'>© 2023 Violet Karlsson</span>";
echo "</footer>";
echo "</body>";
echo "</html>";

} else {
  header('noentry.php');
}

?>
