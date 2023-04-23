<?php

session_start();
if(isset($_SESSION['username'])){
  $username = $_SESSION['username'];
  $auth = $_SESSION['auth'];
}
$date = $_SESSION['date'];
$country = $_SESSION['country'];
$town = $_SESSION['town'];
$center = $_SESSION['center'];
$id = $_SESSION['id'];
$price = $_SESSION['price'];
$email = $_SESSION['email'];
$amount = $_SESSION['ticketamount'];
session_write_close();

include ('constant.php');

echo "<html>
         <head>
            <title>Lovejoy - Unoffical</title>
            <link rel='stylesheet' href='style.css'>
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
                     echo"<a class='nav-link navbarFont' href='logout.php'>".$auth." sign out</a>";
                   }else{
                     echo"<a class='nav-link navbarFont' href='login.php'>Sign in</a>";
                   }
           echo"</li>
               </ul>
             </div>
           </div>
           </nav>";
echo "<div class='p-5 coverImage'>";
echo "<div class='row py-4 my-5'>
        <div class='col albumDisplay'>
        <br>
        <h1>Thank you for your order to the following concert!</h1><hr><br><h2>$town <br> At $center | $date.</h2><br>
        <h4>An email has been sent to $email containing the tickets.<br>Tickets ordered: $amount<br>Final ticket price: $$price dollars.</h4>
        <a href='index.php#' type='button' class='btn btn-dark my-2'>Back to home page</a><hr><br>
        </div>
      </div>
";
echo "</div>";
echo"
    <div class='footer'>
      <footer class='py-3 footer'>
        <ul class='nav justify-content-center border-bottom pb-3 mb-3>
          <li class='nav-item'><a href='index.php#' class='nav-link px-2 text-muted'>Index</a></li>
          <li class='nav-item'><a href='index.php#albums' class='nav-link px-2 text-muted'>Music</a></li>
          <li class='nav-item'><a href='index.php#about' class='nav-link px-2 text-muted'>This is Lovejoy</a></li>
          <li class='nav-item'><a href='index.php#concerts' class='nav-link px-2 text-muted'>Concerts</a></li>
        </ul>
      <br><span class='mb-3 ms-5 mb-md-0 text-muted'>© 2023 Violet Karlsson</span>
    </div>
  </footer>
</div> </body>";
echo "</html>";

?>
