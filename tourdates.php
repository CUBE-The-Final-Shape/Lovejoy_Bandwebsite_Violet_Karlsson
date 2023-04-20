<?php
session_start();
$_SESSION['page'] = "edit";
if(isset($_SESSION['auth'])){
  $username = $_SESSION['username'];
  $auth = $_SESSION['auth'];
  if($auth == "Admin") {
  $passkey = $_SESSION['passkey'];
}
} else {
  unset($auth);
}
session_write_close();

if(isset($_SESSION['passkey'])){
  if($auth == "Admin"){

  include('xml_class.php');
  include('constant.php');

  //creat a object of class xml_opration
  $xml = new xml_opration;
  $xml->xmlFormat();
  $xml->page();

  //display records for appointed count
  $data = $xml->xmlPartFormat($page,$pagecount);

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
  <body>";

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

  echo" <div class='p-5'>
      <h1>Concert list</h1><hr>";
      $i = 1;
      /* echo '<pre>' . var_export($data, true) . '</pre>'; */
      $data_by_id = array();
      foreach($data as $val){
          //print_r($val);
          if ($val['tag'] == 'root' && $val['type'] == 'open')
            continue;
          if ($val['tag'] == 'root' && $val['type'] == 'close')
            break;
          if ($val['tag'] == 'concert' && $val['type'] == 'open'){
                 $id = $val['attributes']['id'];
                 $data_by_id[$id] = array();
                 continue;
          }

          if ($val['tag'] == 'tickets'){
              $data_by_id[$id]['tickets'] = $val['value'];
              continue;
          }
          if ($val['tag'] == 'date'){
              $data_by_id[$id]['date'] = $val['value'];
              continue;
          }
          if ($val['tag'] == 'country'){
              $data_by_id[$id]['country'] = $val['value'];
              continue;
          }
          if ($val['tag'] == 'town'){
              $data_by_id[$id]['town'] = $val['value'];
              continue;
          }
          if ($val['tag'] == 'center'){
              $data_by_id[$id]['center'] = $val['value'];
              continue;
          }
        }

        if ($i == 1 && $page == 1){
          $highest_id = max(array_keys($data_by_id));
        echo "<a href='newtour.php?id=$highest_id' type='button' class='btn btn-dark my-2'>New entry</a>";
        }

  ksort($data_by_id);
  foreach($data_by_id as $id => $val){
          echo "<tr>
                  <div class='col albumDisplay m-2'>
                    <td width='20%'>".$val['date'].", </td>
                    <br>
                    <td>".$val['country']."</td>
                </tr>
                  <tr>
                    <td>".$val['town']."</td><br>
                    <td>".$val['center']."</td><br>
                    <td>Tickets available: ".$val['tickets']."</td>
                  </tr><br>
                  <a href='redirect.php?id=$id&tickets=".$val['tickets']."' type='button' class='btn btn-dark my-2'>Update entry</a>
                  <a href='delete.php?id=$id' type='button' class='btn btn-dark my-2'>Delete entry</a>
                  </div>
               </tr>";
      }


    echo"</div>

    </div>
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
  </html> ";}
} else {
  include("noentry.php");
}

?>
