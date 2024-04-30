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
$Date = $_REQUEST['Date'];

$sql = "SELECT * FROM savings WHERE Acct_no='$Acct_no' AND Date='$Date'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "Account Number: " . $row["Acct_no"]. "<br>Date: " . $row["Date"]. " ---- Balance: " . $row["Balance"]. "<br>";
  }
} else {
  echo "0 results";
}

$conn->close();
?>