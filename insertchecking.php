<html>
<body>
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
$date = $_REQUEST['date'];

$sql = "INSERT INTO checking (Acct_no, lastname, firstname, address, email, phone, date) VALUES ('$Acct_no', '$lastname', '$firstname', '$address', '$email', '$phone', '$date')";

if ($conn->query($sql) === TRUE) {
   echo "New Checking Account created successfully<br><br>";
   echo "<a href='displaychecking.php'>Go to Checking Account</a><br><br>";
   echo "<a href='dashboard.html'>Back to Dashboard</a><br>";
} else {
   echo "Error: " . $sql . "<br>" . $conn->error;
}
   
$conn->close();
?>
</body>
</html>