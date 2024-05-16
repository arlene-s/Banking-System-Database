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
$Date = $_POST['Date'];

$sql_savings = "INSERT INTO savings (Acct_no, lastname, firstname, address, email, phone, interest_rate, Date) VALUES ('$Acct_no', '$lastname', '$firstname', '$address', '$email', '$phone', '$interest_rate', '$Date')";

if ($conn->query($sql_savings) === TRUE) {
   echo "Savings Account created successfully<br>";
   echo "<a href='displaysavings.php'>Go to Savings Account</a><br>";
   echo "<a href='dashboard.html'>Back to Dashboard</a><br>";
} else {
   echo "Error: " . $sql_savings . "<br>" . $conn->error;
}
   
$conn->close();
?>
