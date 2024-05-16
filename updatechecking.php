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
$phone = $_REQUEST['phone'];
$email = $_REQUEST['email'];

// Check if the record already exists
$sql_select = "SELECT * FROM checking WHERE Acct_no='$Acct_no'";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    // Record exists, perform UPDATE
    $sql = "UPDATE checking SET address='$address', phone='$phone', email='$email' WHERE Acct_no='$Acct_no'";
    if ($conn->query($sql) === TRUE) {
        echo "Info updated successfully<br><br>";
        echo "<a href='displaychecking.html'>Go To Checking Account</a><br>";
        echo "<br><a href='dashboard.html'>Go To Dashboard</a><br>";
    } else {
        echo "Error updating Info: " . $conn->error;
    }
} else {
    // Record doesn't exist
    echo "Checking Account does not exist";
}

$conn->close();
?>