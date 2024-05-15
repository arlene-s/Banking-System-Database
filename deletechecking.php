<?php

$servername = "localhost";
$username = "quickme1_4211";
$password = "csci4211";
$dbname = "dbvpny1qngaxgp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$Acct_no = $_REQUEST['Acct_no'];

// Corrected DELETE queries
$sql = "DELETE FROM checking WHERE Acct_no='$Acct_no'";
//$sql1 = "DELETE FROM savings_transactions WHERE lastname='$lastname'";

if ($conn->query($sql) === TRUE) {
  echo "Account deleted successfully";
} else {
  echo "Error deleting account: <br>" . $conn->error;
}

$conn->close();
?>
