<?php
session_start();
if(isset($_SESSION['auth'])){
  $username = $_SESSION['username'];
  $auth = $_SESSION['auth'];
  if(isset($_GET['id'])){
    $id = $_GET['id'];
  }
} else {
  unset($auth);
}
$_SESSION['page'] = "insert";
session_write_close();

$ticketErr = "";
$dateErr = "";
$countryErr = "";
$townErr = "";
$centerErr = "";
unset($errors);

if (isset($_SESSION['errors'])) {
  $errors = $_SESSION['errors'];
unset($_SESSION['errors']);
}

if (isset($errors)) {
    if (isset($errors['tickets'])) {
        $ticketErr = $errors['tickets'];
    }
    if (isset($errors['date'])) {
        $dateErr = $errors['date'];
    }
    if (isset($errors['country'])) {
        $countryErr = $errors['country'];
    }
    if (isset($errors['town'])) {
        $townErr = $errors['town'];
    }
    if (isset($errors['center'])) {
        $centerErr = $errors['center'];
    }
}

include ('constant.php');

if(isset($id)){
  if($auth == "Admin"){
    include('components/head.php');
    include('components/navbar.php');

    echo "<div class='px-5'>";
    echo "<div class='row'>
        <div class='col albumDisplay m-2'>
        <br>
        <h1>Insert new concert info</h1><hr><br>
        <form method='post' name='form1' action='redirect.php'>
            <input type='hidden' name='id' value='$id'>
            <tr><td>Tickets: <span style='color: #bd001c;'>*$ticketErr</span></td></tr>
            <input type='text' name='tickets' class='form-control'><br>
            <tr><td>Date: (Format: MMM. DD, YYYY) <span style='color: #bd001c;'>*$dateErr</span></td></tr>
            <input type='text' name='date' class='form-control'><br>
            <tr><td>Country: <span style='color: #bd001c;'>*$countryErr</span></td></tr>
            <input type='text' name='country' class='form-control'><br>
            <tr><td>Town: <span style='color: #bd001c;'>*$townErr</span></td></tr>
            <input type='text' name='town' class='form-control'><br>
            <tr><td>Center: <span style='color: #bd001c;'>*$centerErr</span></td></tr>
            <input type='text' name='center' class='form-control'>
            <br><input type='submit' class='btn btn-dark my-2' value='Submit'>
            <a href='tourdates.php' class='btn btn-dark my-2'>Cancel</a>
            <hr><br>
        </form>
      </div>
    ";
    echo "</div>";
    echo "</table></div>
        </div></body>";
    echo "</html>";}
  } else {
    include("noentry.php");
  }

?>
