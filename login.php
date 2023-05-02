<?php
session_start();
 require('components/connect.php');

 if (isset($_POST['username']) && isset($_POST['password'])){
 //3.1.1 Assigning posted values to variables.
 $username = $_POST['username'];
 $password = $_POST['password'];
 $auth = $_POST['auth'];

 if($auth == "Sign in") {
   $query = "SELECT * FROM `accounts` WHERE username='$username' and password='$password'";

   $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
   $count = mysqli_num_rows($result);

   if ($count == 1){
    $row = mysqli_fetch_assoc($result);
    $admin = $row['admin'];
     if ($admin == 1){
       $_SESSION['username'] = $username;
       $_SESSION['auth'] = "Admin";
     } else {
       $_SESSION['username'] = $username;
       $_SESSION['auth'] = "User";
     }

   header('Location: index.php');
   exit();

   }else{
   //3.1.3 If the login credentials doesn't match, he will be shown with an error message.
   $fmsg = "Invalid Login Credentials.";
   unset($auth);
   }
 }
}

include('components/head.php');
include('components/navbar.php');

echo "<div class='aboutImage'>";
echo "<br><br>";
echo "<div class='d-flex justify-content-center'>
    <div class='albumDisplay m-5 p-5'><br>
    <h1>Sign in</h1><hr><br>
    <form method='post' class='py-1'>";
    if(isset($fmsg)){ echo"<div class='alert alert-danger' role='alert'> ".$fmsg." </div>"; }else{}
echo "
      <input type='username' class='form-control' name='username' placeholder='Username' required><br>
      <input type='password' class='form-control' id='inputPassword' name='password' placeholder='Password' required><br>
      <input type='submit' class='btn btn-success' name='auth' value='Sign in'>
      <a href='index.php#' class='btn btn-dark my-2'>Cancel</a><br>
      <a href='register.php' class='signup'>Don't have an account? Sign up here</a>
    </form><hr>
  </div>
";
echo "</div><br><br><br><br><br>";
echo "</table>
    <br><br><div class='footer'>
      <footer class='py-3 footer'>
        <ul class='nav justify-content-center border-bottom pb-3 mb-3>
          <li class='nav-item'><a href='index.php#' class='nav-link px-2 text-muted'>Index</a></li>
          <li class='nav-item'><a href='index.php#albums' class='nav-link px-2 text-muted'>Music</a></li>
          <li class='nav-item'><a href='index.php#about' class='nav-link px-2 text-muted'>This is Lovejoy</a></li>
          <li class='nav-item'><a href='index.php#concerts' class='nav-link px-2 text-muted'>Concerts</a></li>
        </ul>
      <span class='mb-3 ms-5 mb-md-0 text-muted'>© 2023 Violet Karlsson</span>
    </div>
    </footer>
    </div></div></body>";
echo "</html>";
?>
