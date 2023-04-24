<?php

session_start();
if(isset($_SESSION['username'])){
  $username = $_SESSION['username'];
  $auth = $_SESSION['auth'];
}
session_write_close();

echo" <html>
  <head>
  <title>Lovejoy - Unoffical</title>
  <meta charset='utf-8'>
  <link href='css/index.css' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link rel='apple-touch-icon' href='https://getbootstrap.com/docs/5.2/assets/img/favicons/apple-touch-icon.png' sizes='180x180'>
  <link rel='mask-icon' href='https://getbootstrap.com/docs/5.2/assets/img/favicons/safari-pinned-tab.svg' color='#712cf9'>
  <link rel='icon' type='image/x-icon' href='media/favicon.ico'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
  <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM' crossorigin='anonymous'></script>
  <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'/>
</head>
  <body>
    <nav class='navbar navbar-expand-sm bg-dark navbar-dark sticky-top'>
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
    </nav>
    <div class='p-5 container-fluid'>
    <h1>Seems like I messed up. Contact Violet about this. She might get annoyed, not on you but on herself. She's going to be mad because she messed up.</h1><br>
    <a href='index.php' type='button' class='btn btn-dark my-2'>Return to home page</a>
    </div>
  </body>
</html>";
?>
