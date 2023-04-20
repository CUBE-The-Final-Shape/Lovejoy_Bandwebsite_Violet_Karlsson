<?php

session_start();
$page = $_SESSION['page'];
unset($_SESSION['errors']);
session_write_close();

if($page == "index"){


  $id = $_GET['id'];

  $xml = simplexml_load_file('concerts.xml');

  $concert = $xml->xpath("//concert[@id='$id']")[0];

  if ($concert) {
      // Extract the data from the concert element
      $tickets = (string)$concert->tickets;
      $date = (string)$concert->date;
      $country = (string)$concert->country;
      $town = (string)$concert->town;
      $center = (string)$concert->center;

      // Store the variables in $_SESSION
      session_start();
      $_SESSION['tickets'] = $tickets;
      $_SESSION['date'] = $date;
      $_SESSION['country'] = $country;
      $_SESSION['town'] = $town;
      $_SESSION['center'] = $center;
      $_SESSION['id'] = $id;
      session_write_close();

      // Redirect to the order page
      header('Location: order.php');
      exit();
      } else {
      // If the ID is not found, redirect to an error page
      header('Location: error.php');
      exit();
  }


} elseif($page == "order"){

  // Store errors in session
  session_start();

  // Connect to the database
  $host = "localhost";
  $username = "root";
  $password = "";
  $database = "tickets";
  $conn = mysqli_connect($host, $username, $password, $database);
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  // Get the form data
  $date = $_POST['date'];
  $town = $_POST['town'];
  $center = $_POST['center'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $card = $_POST['payment'];

  // Define regular expressions for validation
  $name_regex = '/^[a-zA-Z ]+$/';
  $email_regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
  $phone_regex = '/^\d{10}$/';
  $card_regex = '/^\d{16}$/';

  $errors = array();

  // Validate the form data using regular expressions
  if (!preg_match($name_regex, $name)) {
      $errors['name'] = "Name should contain only alphabets and space";
  }
  if (!preg_match($email_regex, $email)) {
      $errors['email'] = "Invalid email format";
  }
  if (!preg_match($phone_regex, $phone)) {
      $errors['phone'] = "Phone number should contain 10 digits";
  }
  if (!preg_match($card_regex, $card)) {
      $errors['payment'] = "Card number should contain 16 digits";
  }

  if (count($errors) > 0) {

      $_SESSION['errors'] = $errors;
      // Redirect back to order.php
      header('Location: order.php');
      exit();
  }

  if (empty($nameErr) && empty($emailErr) && empty($phoneErr) && empty($cardErr)) {
      // Insert the data into the database
      $sql = "INSERT INTO contacts (timeofday, town, center, name, mail, phone_number) VALUES ('$date', '$town', '$center', '$name', '$email', '$phone')";
      if (mysqli_query($conn, $sql)) {
          header('Location: thanks.php');
          exit();
      } else {
          echo "Error adding record: " . mysqli_error($conn);
      }
  }
  // Close the database connection
  mysqli_close($conn);

  session_write_close();


} elseif($page == "edit") {


  $id = $_GET['id'];
  var_dump($_GET['id']);

  $xml = simplexml_load_file('concerts.xml');
  var_dump($xml);

  $concert = $xml->xpath("//concert[@id='$id']")[0];

  if ($concert) {
      // Extract the data from the concert element
      $tickets = (string)$concert->tickets;
      $date = (string)$concert->date;
      $country = (string)$concert->country;
      $town = (string)$concert->town;
      $center = (string)$concert->center;

      // Store the variables in $_SESSION
      session_start();
      $_SESSION['tickets'] = $tickets;
      $_SESSION['date'] = $date;
      $_SESSION['country'] = $country;
      $_SESSION['town'] = $town;
      $_SESSION['center'] = $center;
      $_SESSION['id'] = $id;
      session_write_close();

      // Redirect to the order page
      header('Location: update.php');
      exit();
      } else {
      // If the ID is not found, redirect to an error page
      header('Location: error.php');
      exit();
  }


} elseif($page == "update") {

  session_start();

  include('xml_class.php');
  include('constant.php');

  //creat a object og class xml_opration
  $xml = new xml_opration;

  $tickets = $xml->formatXmlString($_POST['tickets']);
  $date = $xml->formatXmlString($_POST['date']);
  $country = $xml->formatXmlString($_POST['country']);
  $town = $xml->formatXmlString($_POST['town']);
  $center = $xml->formatXmlString($_POST['center']);
  $id = $_POST['id'];

  $errors = array();

  if ($_POST['tickets'] < 0) {
    $errors['tickets'] = "An amount of available tickets must be set and can't be negative";
  }
  if (empty($_POST['date'])) {
    $errors['date'] = "Date can't be left empty";
  }
  if (empty($_POST['country'])) {
    $errors['country'] = "Country can't be left empty";
  }
  if (empty($_POST['town'])) {
    $errors['town'] = "Town can't be left empty";
  }
  if (empty($_POST['center'])) {
    $errors['center'] = "Center can't be left empty";
  }

  if (count($errors) > 0) {

      $_SESSION['errors'] = $errors;
      // Redirect back to order.php
      session_write_close();
      header('Location: update.php');
      exit();
  } elseif (empty($dateErr) && empty($ticketErr) && empty($countryErr) && empty($townErr) && empty($centerErr)){
  $xml->updateXmlFile($id, $tickets, $date, $country, $town, $center);
  $xml->writeXmlFile();
  session_write_close();

  header("location:tourdates.php");
  exit();
}


} elseif($page == "insert") {

  session_start();

  include('xml_class.php');
  include('constant.php');

  //creat a object og class xml_opration
  $xml = new xml_opration;

  $tickets = $xml->formatXmlString($_POST['tickets']);
  $date = $xml->formatXmlString($_POST['date']);
  $country = $xml->formatXmlString($_POST['country']);
  $town = $xml->formatXmlString($_POST['town']);
  $center = $xml->formatXmlString($_POST['center']);
  $id = (int)$_POST['id'] + 1;
  /* $idInt = 1;
  $id = "$_POST['id']-$idInt"; */

  $errors = array();

  if ($_POST['tickets'] < 0) {
    $errors['tickets'] = "An amount of available tickets must be set and can't be negative";
  }
  if (empty($_POST['date'])) {
    $errors['date'] = "Date can't be left empty";
  }
  if (empty($_POST['country'])) {
    $errors['country'] = "Country can't be left empty";
  }
  if (empty($_POST['town'])) {
    $errors['town'] = "Town can't be left empty";
  }
  if (empty($_POST['center'])) {
    $errors['center'] = "Center can't be left empty";
  }

  if (count($errors) > 0) {

      $_SESSION['errors'] = $errors;
      $id--;
      // Redirect back to order.php
      session_write_close();
      header('Location: newtour.php?id='.$id);
      exit();

  } elseif (empty($dateErr) && empty($ticketErr) && empty($countryErr) && empty($townErr) && empty($centerErr)){

  $xml->insertXmlFile($id, $tickets, $date, $country, $town, $center);
  $xml->writeXmlFile();
  session_write_close();
  header("location:tourdates.php");

  }

} else {

  header('Location: error.php');
  exit();
}

 ?>
