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

  include('components/head.php');
  include('components/navbar.php');

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
        echo "<a href='index.php' type='button' class='btn btn-dark my-2 float-end'>Index</a>";
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
                  <a href='components/delete.php?id=$id' type='button' class='btn btn-dark my-2'>Delete entry</a>
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
