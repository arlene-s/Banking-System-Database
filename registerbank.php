<!DOCTYPE html>
<html>

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
$userid = $_POST['userid'];
$pssword = $_POST['pssword'];
$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$address = $_POST['address'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$Testquestion = $_POST['Testquestion'];
$Testanswer= $_POST['Testanswer'];
$usertype = $_POST['usertype'];

$sql_login_tbl = "INSERT INTO login_tbl (userid, pssword, lastname, firstname, address, phone, email, Testquestion, Testanswer, usertype) VALUES ('$userid', '$pssword', '$lastname', '$firstname', '$address', '$phone', '$email', '$Testquestion', '$Testanswer', '$usertype')";

if ($conn->query($sql_login_tbl) === TRUE) {
   echo "Bank Account created successfully\n";
   echo "<a href='loginbank.html'>Login</a>";
} else {
   echo "Error: " . $sql_login_tbl . "<br>" . $conn->error;
}
   
$conn->close();
?>
</html>