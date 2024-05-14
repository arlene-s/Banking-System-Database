<?php

// Database connection
$servername = "localhost";
$username = "quickme1_4211";
$password = "csci4211";
$dbname = "dbvpny1qngaxgp";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the variables from the URL request string
$Acct_no = $_POST['Acct_no'];
$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$address = $_POST['address'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$interest_rate = $_POST['interest_rate'];
$TRansID = $_POST['TRansID'];

$sql_savings = "INSERT INTO savings (Acct_no, lastname, firstname, address, email, phone, interest_rate, TRansID) VALUES ('$Acct_no', '$lastname', '$firstname', '$address', '$email', '$phone', '$interest_rate', '$TRansID')";

if ($conn->query($sql_savings) === TRUE) {
   echo "Savings Account created successfully";
} else {
   echo "Error: " . $sql_savings . "<br>" . $conn->error;
}

$sql_insert = "INSERT INTO savings_transactions (transid, lastname, firstname, phone) VALUES ('$TRansID', '$lastname', '$firstname', '$phone')";

if ($conn->query($sql_insert) === TRUE) {
   echo "";
} else {
   echo "Error: " . $sql_insert . "<br>" . $conn->error;
}
   
$conn->close();
?>
