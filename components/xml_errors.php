<?php
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
?>
