<?php
session_start();
$_SESSION['page'] = "index";
if(isset($_SESSION['username'])){
  $username = $_SESSION['username'];
  $auth = $_SESSION['auth'];
  if($auth == "Admin"){
    $_SESSION['passkey'] = "edit";
  }
}
session_write_close();

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
      <a class='navbar-brand' href='#'><img src='media/LogoLight.png' alt='Lovejoy Logo' class='img-fluid' width='100' height='auto'></a>
        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarTogglerDemo03' aria-controls='navbarTogglerDemo03' aria-expanded='false' aria-label='Toggle navigation'>
          <span class='navbar-toggler-icon'></span>
        </button>
      <div class='collapse navbar-collapse' id='navbarTogglerDemo03'>
      <ul class='navbar-nav ms-auto mb-2 mb-lg-0'>
        <li class='nav-item'>
          <a class='nav-link navbarFont' href='#albums'>Music</a>
        </li>
       <li class='nav-item'>
          <a class='nav-link navbarFont' href='#about'>This is Lovejoy</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link navbarFont' href='#concerts'>Concerts</a>
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

echo" <div class='p-5 text-white coverImage'>
    <img src='media/LogoLight.png' alt='Lovejoy Logo' class='mx-auto d-block coverLogo img-fluid' width='450' height='auto'>
  </div>

  <div class='p-5 container-fluid' id='albums'>
    <h1>The music of <img src='media/LogoDark.png' alt='Lovejoy Logo' class='img-fluid' width='150' height='auto'></h1>
    <hr>
    <div class='row'>
      <div class='col albumDisplay mx-2'>
        <img src='media/Album1.png' alt='Are You Alright?' class='mx-auto d-block rounded img-fluid' width='350' height='auto'>
        <p class='ps-4 pt-2 albumTitle fw-bold'>Are You Alright?</p>
        <hr>
          <div class='container'>
            <p class=' ms-2 streamon'>Available on</p>
            <div class='col'><a href='https://open.spotify.com/album/5nlhLmWKBfIzkCxwVRAFd2?si=EVTQpG-ZRuK6F5O2X9S2nw' class='streamon'><img src='media/spotify.png' alt='Spotify' class='mx-auto rounded img-fluid' width='60' height='auto'> Spotify</a></div><br>
            <div class='col'><a href='https://www.youtube.com/watch?v=SMhFTex19DU' class='streamon'><img src='media/youtube.png' alt='Youtube' class='mx-auto rounded img-fluid' width='60' height='auto'> Youtube</a></div><br>
            <div class='col'><a href='https://music.apple.com/us/album/are-you-alright-ep/1636696498' class='streamon'><img src='media/applemusic.png' alt='Apple Music' class='mx-auto rounded img-fluid' width='60' height='auto'> Itunes</a></div>
          </div>
          <hr>
      </div>
      <div class='col albumDisplay mx-2'>
        <img src='media/Album2.png' alt='Pebble Brain' class='mx-auto d-block rounded img-fluid' width='350' height='auto'>
        <p class='ps-4 pt-2 albumTitle fw-bold'>Pebble Brain</p>
        <hr>
          <div class='container'>
            <p class=' ms-2 streamon'>Available on</p>
            <div class='col'><a href='https://open.spotify.com/album/43yKUvEVZ2dTy2vOrozS2j?si=-62tep3XSJ6PrkYymUTPbw' class='streamon'><img src='media/spotify.png' alt='Spotify' class='mx-auto rounded img-fluid' width='60' height='auto'> Spotify</a></div><br>
            <div class='col'><a href='https://www.youtube.com/watch?v=twbZII_djEo' class='streamon'><img src='media/youtube.png' alt='Youtube' class='mx-auto rounded img-fluid' width='60' height='auto'> Youtube</a></div><br>
            <div class='col'><a href='https://music.apple.com/us/album/pebble-brain/1636670884' class='streamon'><img src='media/applemusic.png' alt='Apple Music' class='mx-auto rounded img-fluid' width='60' height='auto'> Itunes</a></div>
          </div>
          <hr>
      </div>
      <div class='col albumDisplay mx-2'>
        <img src='media/Single1.png' alt='Knee Deep at ATP' class='mx-auto d-block rounded img-fluid' width='350' height='auto'>
        <p class='ps-4 pt-2 albumTitle fw-bold'>Knee Deep at ATP</p>
        <hr>
          <div class='container'>
            <p class=' ms-2 streamon'>Available on</p>
            <div class='col'><a href='https://open.spotify.com/album/6pTPviSRgaaaGzxGiuna5O?si=kO273hJDTu2-8ukRFv3puw' class='streamon'><img src='media/spotify.png' alt='Spotify' class='mx-auto rounded img-fluid' width='60' height='auto'> Spotify</a></div><br>
            <div class='col'><a href='https://www.youtube.com/watch?v=XhL7qUwjiX0' class='streamon'><img src='media/youtube.png' alt='Youtube' class='mx-auto rounded img-fluid' width='60' height='auto'> Youtube</a></div><br>
            <div class='col'><a href='https://music.apple.com/us/album/knee-deep-at-atp-single/1636704240' class='streamon'><img src='media/applemusic.png' alt='Apple Music' class='mx-auto rounded img-fluid' width='60' height='auto'> Itunes</a></div>
          </div>
          <hr>
      </div>
      <div class='col albumDisplay mx-2'>
        <img src='media/Single2.png' alt='Call Me What You Like' class='mx-auto d-block rounded img-fluid' width='350' height='auto'>
        <p class='ps-4 pt-2 albumTitle fw-bold'>Call Me What You Like</p>
        <hr>
          <div class='container'>
            <p class=' ms-2 streamon'>Available on</p>
            <div class='col'><a href='https://open.spotify.com/album/0hTfLMecWyjNUaxmk2OSuc?si=FSHn0EgJTBilAraxxSXPrw' class='streamon'><img src='media/spotify.png' alt='Spotify' class='mx-auto rounded img-fluid' width='60' height='auto'> Spotify</a></div><br>
            <div class='col'><a href='https://www.youtube.com/watch?v=E91pJYO_s7I' class='streamon'><img src='media/youtube.png' alt='Youtube' class='mx-auto rounded img-fluid' width='60' height='auto'> Youtube</a></div><br>
            <div class='col'><a href='https://music.apple.com/us/album/call-me-what-you-like-single/1666975593' class='streamon'><img src='media/applemusic.png' alt='Apple Music' class='mx-auto rounded img-fluid' width='60' height='auto'> Itunes</a></div>
          </div>
          <hr>
      </div>
    </div>
  </div>

  <div class='p-5 aboutImage' id='about'>
    <div class='row'>
      <div class='col'>
        <h1 class='text-white'>This is <img src='media/LogoLight.png' alt='Lovejoy Logo' class='img-fluid' width='150' height='auto'></h1>
          <div class='row'>
            <div class='col col-lg-5'>
              <p class='text-white indent'>Lovejoy is an indie rock band formed in Brighton, England. Lovejoy consists of William Gold as lead vocalist and rhythm guitarist, Joe Goldsmith as lead guitarist, Mark Boardman as drummer, and Ash Kabosu as bassist, with all of them sharing the songwriting. Are You Alright?, Lovejoys debut EP, was released on 8 May 2021. Pebble Brain, Lovejoys second EP, released on 14 October 2021. And Lovejoys latest single, Call Me What You Like, released on 10 February 2023</p><br>
            </div>
            <div class='w-100'></div>
            <div class='col d-lg-none'>
              <div class='row d-lg-none'>
                <div class='col'>
                  <img src='media/members/Wilbur.png' alt='Wiliam Gold' class='img-fluid rounded-circle band-img-sm'>
                </div>
                <div class='col'>
                  <img src='media/members/Joe.png' alt='Joe Goldmith' class='img-fluid rounded-circle band-img-sm'>
                </div>
                <div class='col'>
                  <img src='media/members/Mark.png' alt='Mark Boardman' class='img-fluid rounded-circle band-img-sm'>
                </div>
                <div class='col'>
                  <img src='media/members/Ash.png' alt='Ash Kabosu' class='img-fluid rounded-circle band-img-sm'>
                </div>
              </div>
            </div>
            <img src='media/members/Wilbur.png' alt='Wiliam Gold' class='img-fluid rounded-circle band-img-lg d-none d-lg-block'>
            <img src='media/members/Joe.png' alt='Joe Goldmith' class='img-fluid rounded-circle band-img-lg d-none d-lg-block'>
            <img src='media/members/Mark.png' alt='Mark Boardman' class='img-fluid rounded-circle band-img-lg d-none d-lg-block'>
            <img src='media/members/Ash.png' alt='Ash Kabosu' class='img-fluid rounded-circle band-img-lg d-none d-lg-block'>
          </div>
      </div>
    </div>
  </div>

  <div class='p-5 container-fluid' id='concerts'>
  <h1>Upcoming <img src='media/LogoDark.png' alt='Lovejoy Logo' class='img-fluid' width='150' height='auto'> concerts</h1>";
  if(isset($auth)){
    if($auth == "Admin"){
      echo"<a href='tourdates.php' type='button' class='btn btn-dark my-2'>Edit concert list</a>";
    }
  }else{}
  echo "<hr>";

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

ksort($data_by_id);
foreach($data_by_id as $id => $val){
        echo "<tr>
                <div class='col albumDisplay m-2'>
                  <td width='20%'>".$val['date']."</td>
                  <br>
                  <td>".$val['country'].", </td>
              </tr>
                <tr>
                  <td>".$val['town']."</td><br>
                  <td>".$val['center']."</td><br>
                  <td>Tickets available: ".$val['tickets']."</td>
                </tr><br>";
                if($val['tickets'] > "0") { echo"<a href='redirect.php?id=$id&tickets=".$val['tickets']."' type='button' class='btn btn-dark my-2'>To booking</a>";}
                else {
                  echo"<div class='btn btn-danger my-2' role='alert'> Sold out </div>";
                }
                echo"</div>
             </tr>";
    }
echo"
  </div>
    <div class='footer'>
      <footer class='py-3 footer'>
        <ul class='nav justify-content-center border-bottom pb-3 mb-3>
          <li class='nav-item'><a href='#' class='nav-link px-2 text-muted'>Top</a></li>
          <li class='nav-item'><a href='#albums' class='nav-link px-2 text-muted'>Music</a></li>
          <li class='nav-item'><a href='#about' class='nav-link px-2 text-muted'>This is Lovejoy</a></li>
          <li class='nav-item'><a href='#concerts' class='nav-link px-2 text-muted'>Concerts</a></li>
        </ul>
      <span class='mb-3 ms-5 mb-md-0 text-muted'>© 2023 Violet Karlsson</span>
    </div>
  </footer>
</div>
</body>
</html>";
?>
