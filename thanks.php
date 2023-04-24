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

include('components/head.php');
include('components/navbar.php');

echo "<div class='py-5 px-3 coverImage'>";
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
