<?php
session_start();
 require('connect.php');

 if (isset($_POST['username']) and isset($_POST['password'])){
 //3.1.1 Assigning posted values to variables.
 $username = $_POST['username'];
 $password = $_POST['password'];
 $auth = $_POST['auth'];

 if($auth == "Login") {
   $query = "SELECT * FROM `user` WHERE username='$username' and password='$password'";

   $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
   $count = mysqli_num_rows($result);

   if ($count == 1){
   $_SESSION['username'] = $username;
   $_SESSION['auth'] = "User";

   header('Location: index.php');
   exit();

   }else{
   //3.1.3 If the login credentials doesn't match, he will be shown with an error message.
   $fmsg = "Invalid Login Credentials.";
   unset($auth);
   }

 } elseif($auth == "Admin"){
   $query = "SELECT * FROM `admin` WHERE username='$username' and password='$password'";

   $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
   $count = mysqli_num_rows($result);

   if ($count == 1){
   $_SESSION['username'] = $username;
   $_SESSION['auth'] = "Admin";

   header('Location: index.php');
   exit();
   }else{
   //3.1.3 If the login credentials doesn't match, he will be shown with an error message.
   $fmsg = "Invalid Login Credentials.";
   unset($auth);
   }
}
}

echo "<html>
         <head>
            <title>Lovejoy - Unoffical</title>
            <meta charset='utf-8'>
            <link href='css/index.css' rel='stylesheet'>
            <link rel='icon' type='image/x-icon' href='media/favicon.ico'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
            <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM' crossorigin='anonymous'></script>
            <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'/>
         </head>
         <body bgcolor='#FFFBDA'>";
         echo" <nav class='navbar navbar-expand-sm bg-dark navbar-dark sticky-top'>
             <div class='container-fluid'>
               <a class='navbar-brand' href='index.php#'><img src='media/LogoLight.png' alt='Lovejoy Logo' class='img-fluid' width='100' height='auto'></a>
                 <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarTogglerDemo03' aria-controls='navbarTogglerDemo03' aria-expanded='false' aria-label='Toggle navigation'>
                   <span class='navbar-toggler-icon'></span>
                 </button>
               <div class='collapse navbar-collapse' id='navbarTogglerDemo03'>
               <ul class='navbar-nav ms-auto mb-2 mb-lg-0'>
                 <li class='nav-item'>
                   <a class='nav-link navbarFont' href='index.php#albums'>Music</a>
                 </li>
                <li class='nav-item'>
                   <a class='nav-link navbarFont' href='index.php#about'>This is Lovejoy</a>
                 </li>
                 <li class='nav-item'>
                   <a class='nav-link navbarFont' href='index.php#concerts'>Concerts</a>
                 </li>
                 <li class='nav-item'>";
                   if(isset($auth)){
                     echo"<a class='nav-link navbarFont' href='logout.php'>Sign out</a>";
                   }else{
                     echo"<a class='nav-link navbarFont' href='login.php'>Sign in</a>";
                   }
           echo"</li>
               </ul>
             </div>
           </div>
           </nav>";
echo "<div class='aboutImage'>";
echo "<br><br><br><br>";
echo "<div class='d-flex justify-content-center'>
    <div class='albumDisplay m-5 p-5'>
    <br>
    <h1>Sign in</h1><hr>
    <form method='post' class='py-1' name='form1'>";
    if(isset($fmsg)){ echo"<div class='alert alert-danger' role='alert'> ".$fmsg." </div>"; }else{}
echo "
      <input type='username' class='form-control' name='username' placeholder='Username' required><br>
      <input type='password' class='form-control' id='inputPassword' name='password' placeholder='Password' required><br>
      <input type='submit' class='btn btn-success my-2' name='auth' value='Login'>
      <input type='submit' class='btn btn-dark my-2' name='auth' value='Admin'>
      <a href='index.php#' class='btn btn-danger'>Cancel</a>
      <br>
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
