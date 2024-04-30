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
$newBalance = $_REQUEST['Balance'];

// Check if the record already exists
$sql_select = "SELECT * FROM savings WHERE Acct_no='$Acct_no' AND Date='$Date'";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    // Record exists, perform UPDATE
    $sql = "UPDATE savings SET Balance='$newBalance' WHERE Acct_no='$Acct_no' AND Date='$Date'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    // Record doesn't exist
    echo "Error updating grade: No previous grade found";
}

$conn->close();
?>