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
$address = $_REQUEST['address'];

// Check if the record already exists
$sql_select = "SELECT * FROM Investment WHERE Acct_no='$Acct_no'";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    // Record exists, perform UPDATE
    $sql = "UPDATE Investment SET address='$address' WHERE Acct_no='$Acct_no'";
    if ($conn->query($sql) === TRUE) {
        echo "Address updated successfully";
        echo "<a href='dashboard.html'>Back To Dashboard</a><br>";
    } else {
        echo "Error updating address: " . $conn->error;
    }
} else {
    // Record doesn't exist
    echo "Investment Account does not exist";
}

$conn->close();
?>