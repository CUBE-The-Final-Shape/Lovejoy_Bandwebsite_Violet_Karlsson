<?php
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
            echo"<li class='nav-item'>
              <a class='nav-link navbarFont' href='account.php'>My account</a>
            </li><a class='nav-link navbarFont' href='components/logout.php'>Sign out</a>";
          }else{
            echo"<a class='nav-link navbarFont' href='login.php'>Sign in/Sign up</a>";
          }
  echo"</li>
      </ul>
    </div>
  </div>
  </nav>";
  ?>
