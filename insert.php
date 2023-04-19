<?php
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
?>
