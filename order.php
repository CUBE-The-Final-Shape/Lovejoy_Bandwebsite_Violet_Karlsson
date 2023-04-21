<?php
session_start();
if(isset($_SESSION['username'])){
  $username = $_SESSION['username'];
  $auth = $_SESSION['auth'];
}
$tickets = $_SESSION['tickets'];
$date = $_SESSION['date'];
$country = $_SESSION['country'];
$town = $_SESSION['town'];
$center = $_SESSION['center'];
$id = $_SESSION['id'];
$_SESSION['page'] = "order";
session_write_close();

$nameErr = "";
$emailErr = "";
$phoneErr = "";
$cardErr = "";
$ticketErr = "";

if (isset($_SESSION['errors'])) {
  $errors = $_SESSION['errors'];
unset($_SESSION['errors']);
}

if (isset($errors)) {
    if (isset($errors['name'])) {
        $nameErr = $errors['name'];
    }
    if (isset($errors['email'])) {
        $emailErr = $errors['email'];
    }
    if (isset($errors['phone'])) {
        $phoneErr = $errors['phone'];
    }
    if (isset($errors['payment'])) {
        $cardErr = $errors['payment'];
    }
    if (isset($errors['tickets'])) {
        $ticketErr = $errors['tickets'];
    }
}

include ('constant.php');

if(isset($date)){
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
echo "<div class='p-5 coverImage'>";
echo "<input type='hidden' name='id' value='$id'><br>";
echo "<div class='row'>
    <div class='col order m-2'><br>
    <h1>Order tickets for <br class='d-lg-none'>".$date.", ".$town."<br> At ".$center."</h1><hr><h3>Tickets available: ".$tickets."</h3><br>
    <form method='post' name='form1' class='albumDisplay' action='redirect.php'>
        <input type='hidden' name='date' value='$date'>
        <input type='hidden' name='town' value='$town'>
        <input type='hidden' name='center' value='$center'><span style='color: #bd001c;'>* Mandatory</span><hr>
        <div class='row'>
          <div class='col'>
            <tr><td>Name: <span style='color: #bd001c;'><br>*$nameErr</span></td></tr>
            <input type='name' class='form-control' name='name' placeholder='Name'><br>
            <tr><td>Email: <span style='color: #bd001c;'><br>*$emailErr</span></td></tr>
            <input type='email' class='form-control' name='email' placeholder='Email'><br>
            <tr><td>Number of tickets: <span style='color: #bd001c;'><br>*$ticketErr</span></td></tr>
            <input type='number' class='form-control' name='ticketamount' min='1'><br>
          </div>
          <div class='col'>
            <tr><td>Phonenumber: <span style='color: #bd001c;'><br>*$phoneErr</span></td></tr>
            <input type='tel' class='form-control' name='phone' placeholder='Phone'><br>
            <tr><td>Cardnumber: <span style='color: #bd001c;'><br>*$cardErr</span></td></tr>
            <input type='payment' class='form-control' name='payment' placeholder='Card-nmbr'>
          </div>
        </div>
        ";
        if($tickets > "0") {
          echo"<input type='submit' class='btn btn-dark my-2' value='Place order'>";
        } else {
          echo"<div class='alert alert-danger' role='alert'> This concert has been sold out </div>";
        }
        echo "<hr><br>
    </form>
  </div>
";
echo "</div>";
echo "</table></div>
    <div class='footer'>
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
    </div></body>";
echo "</html>";}
else {
  header('Location: error.php');
  exit();
}

?>
