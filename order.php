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

  include('components/head.php');
  include('components/navbar.php');

echo "<div class='px-3'>";
echo "<input type='hidden' name='id' value='$id'>";
echo "<div class='row'>
    <div class='col order mx-2'>
    <h1>Order tickets for <br class='d-lg-none'>".$date.", ".$town."<br> At ".$center."</h1><hr><h3>Tickets available: ".$tickets." | Price: $25 per ticket</h3><br>
    <form method='post' name='form1' class='albumDisplay' action='redirect.php'>
        <input type='hidden' name='date' value='$date'>
        <input type='hidden' name='town' value='$town'>
        <input type='hidden' name='center' value='$center'><span style='color: #bd001c;'>* Mandatory</span><hr>
        <div class='row row-cols-1 row-cols-sm-2'>
          <div class='col-sm'>
            <tr><td>Name: <span style='color: #bd001c;'><br>*$nameErr</span></td></tr>
            <input type='name' class='form-control' name='name' placeholder='Name'><br>
            <tr><td>Email: <span style='color: #bd001c;'><br>*$emailErr</span></td></tr>
            <input type='email' class='form-control' name='email' placeholder='Email'><br>
            <tr><td>Phonenumber: <span style='color: #bd001c;'><br>*$phoneErr</span></td></tr>
            <input type='tel' class='form-control' name='phone' placeholder='Phone'><br>
          </div>
          <div class='col-sm'>
            <tr><td>Cardnumber: <span style='color: #bd001c;'><br>*$cardErr</span></td></tr>
            <input type='payment' class='form-control' name='payment' placeholder='Card-nmbr'><br>
            <tr><td>Ticket amount: <span style='color: #bd001c;'><br>*$ticketErr</span></td></tr>
            <input type='number' class='form-control' id='qty' name='ticketamount' min='1'>
          </div>
        </div>
        ";
        if($tickets > "0") {
          echo"<input type='submit' class='btn btn-dark my-2' value='Place order'>";
        } else {
          echo"<div class='alert alert-danger' role='alert'> This concert has been sold out </div>";
        }
        echo "<hr>
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
