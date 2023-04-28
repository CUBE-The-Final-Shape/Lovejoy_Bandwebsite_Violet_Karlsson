<?php
require('components/connect.php');

include('components/head.php');
include('components/navbar.php');

if(isset($_SESSION['username'])){
  $username = $_SESSION['username'];

echo"<div class='p-5'>
    <h1>Lovejoy Forums</h1><hr>
    </div>";


echo"
  <div class='footer'>
    <footer class='py-3 footer'>
      <ul class='nav justify-content-center border-bottom pb-3 mb-3>
        <li class='nav-item'><a href='Index.php#' class='nav-link px-2 text-muted'>Index</a></li>
        <li class='nav-item'><a href='Index.php#albums' class='nav-link px-2 text-muted'>Music</a></li>
        <li class='nav-item'><a href='Index.php#about' class='nav-link px-2 text-muted'>This is Lovejoy</a></li>
        <li class='nav-item'><a href='Index.php#concerts' class='nav-link px-2 text-muted'>Concerts</a></li>
      </ul>
    <span class='mb-3 ms-5 mb-md-0 text-muted'>© 2023 Violet Karlsson</span>
  </div>
</footer>
</div>
</body>
</html> ";

 ?>
