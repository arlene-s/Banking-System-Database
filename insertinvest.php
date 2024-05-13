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

// get the variables from the URL request string
$Acct_no = $_REQUEST['Acct_no'];
$lastname = $_REQUEST['lastname'];
$firstname = $_REQUEST['firstname'];
$address = $_REQUEST['address'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];

$sql_invest = "INSERT INTO Investment (Acct_no, lastname, firstname, address, email, phone) VALUES ('$Acct_no', '$lastname', '$firstname', '$address', '$email', '$phone')";

$sql_insert = "INSERT INTO investment_transactions (transid, lastname, firstname, phone) VALUES ('$Acct_no', '$lastname', '$firstname', '$phone')";

if ($conn->query($sql_invest) === TRUE) {
   echo "Investment Account created successfully";
} else {
   echo "Error: " . $conn->error;
}
   
$conn->close();
?>