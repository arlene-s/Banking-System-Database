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
$firstname = $_REQUEST['firstname'];
$lastname = $_REQUEST['lastname'];
$Acct_no = $_REQUEST['Acct_no'];
$email = $_REQUEST['email'];


$sql = "INSERT INTO savings (firstname, lastname, Acct_no, email)
VALUES ('$firstname', '$lastname', '$Acct_no', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully.<br>" . $firstname . " " . $lastname . " has logged in.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
</body>
</html>
