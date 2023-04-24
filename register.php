<?php
session_start();
require('components/connect.php');

if (isset($_POST['username']) and isset($_POST['email']) and isset($_POST['password'])){

  unset($nameErr);
  unset($emailErr);
  unset($passErr);

  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPass = $_POST['confirmPass'];

    $name_regex = '/^[a-zA-Z ]+$/';
    $email_regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    $pass_regex = '/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{1,12}$/';

    $errors = array();

    if (!preg_match($name_regex, $username)) {
        $errors['username'] = "Username can only contain letters and spaces";
    }
    if (!preg_match($email_regex, $email)) {
        $errors['email'] = "Please enter a valid email or email format";
    }
    if (!preg_match($pass_regex, $password)) {
        $errors['password'] = "Please enter a valid password";
    }
    if (!preg_match($pass_regex, $confirmPass)) {
        $errors['password'] = "Please enter a valid password for confirmation";
    }
    if ($confirmPass !== $password) {
        $errors['password'] = "The confirmation password does not match";
    }

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
    } else {

    $sql = "INSERT INTO accounts (id, username, email, password, active, admin) VALUES ('', '$username', '$email', '$password', '0', '0')";

    if (mysqli_query($connection, $sql)) {
        header('Location: login.php');
        exit();
    } else {
        echo "Error adding record: " . mysqli_error($connection);
    }
  }
}

include('components/head.php');
include('components/navbar.php');

echo "<div class='aboutImage'>";
echo "<br><br><br><br>";
echo "<div class='d-flex justify-content-center'>
    <div class='albumDisplay m-5 p-5'><br>
    <h1>Register account</h1><hr>
    <form method='post' class='py-1'>";
    if(isset($fmsgNAME)){ echo"<div class='alert alert-danger' role='alert'> ".$fmsgNAME."</div>"; }else{}
    if(isset($fmsgEMAIL)){ echo"<div class='alert alert-danger' role='alert'> ".$fmsgEMAIL."</div>"; }else{}
    if(isset($fmsgPASS)){ echo"<div class='alert alert-danger' role='alert'> ".$fmsgPASS."</div>"; }else{}
echo "
      <input type='username' class='form-control' name='username' placeholder='Username' required><br>
      <input type='mail' class='form-control' name='email' placeholder='Email' required><br>
      <input type='password' class='form-control' id='inputPassword' name='password' placeholder='Password' required><br>
      <input type='password' class='form-control' name='confirmPass' placeholder='Confirm password' required><br>
      <input type='submit' class='btn btn-success' name='register' value='Register'>
      <a href='login.php' class='btn btn-dark my-2'>Back to sign in</a><br>
    </form><hr>
  </div>
";
echo "</div><br><br><br><br>";
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
