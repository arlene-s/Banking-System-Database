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
$firstname = $_REQUEST['firstname'];
$lastname = $_REQUEST['lastname'];

// check whether account has any of the following accounts (checking, savings, investment)

$checksavings = "SELECT * FROM savings WHERE Acct_no='$Acct_no' AND firstname='$firstname'";
$checkchecking = "SELECT * FROM checking WHERE Acct_no='$Acct_no' AND firstname='$firstname'";
$checkinvestment = "SELECT * FROM Investment WHERE Acct_no='$Acct_no' AND firstname='$firstname'";

if ($conn->query($checksavings)->num_rows > 0) {
    echo $firstname . " " . $lastname . " has logged in.";
} else if ($conn->query($checkchecking)->num_rows > 0) {
    echo $firstname . " " . $lastname . " has logged in.";
} else if ($conn->query($checkinvestment)->num_rows > 0) {
    echo $firstname . " " . $lastname . " has logged in.";
} else {
    echo "Error: cannot log in". "<br>" . $conn->error;
}

$conn->close();
?>
</body>
</html>
