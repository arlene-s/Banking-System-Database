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

// checking if account exists
$sql = "SELECT * FROM Investment WHERE Acct_no='$Acct_no'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // if account exists, output data 
  while($row = $result->fetch_assoc()) {
    echo "Account Number: " . $row["Acct_no"] . "<br>Name: " . $row["firstname"] . " " . $row["lastname"]. "<br>Email: " . $row["email"]. "<br>Phone: " . $row["phone"] . "<br>Address: " . $row["address"] . " ------ Balance: $" . $row["Balance"]. "<br>";

    echo "<a href='updateinvest.html'>Update Investments Info</a><br>";
    echo "<a href='deleteinvest.html'>Delete Investments Info</a><br><br>";
    
    echo "<a href='dashboard.html'>Back To Dashboard</a><br>";
  }
} else {
  // if account does not exist
  echo "0 results";
}

$conn->close();
?>