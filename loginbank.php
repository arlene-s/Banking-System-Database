<html>
<body>
<?php

// Database connection
$servername = "localhost";
$username = "quickme1_4211";
$password = "csci4211";
$dbname = "bank";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// get the variables from the URL request string
$firstname = $_REQUEST['firstname'];
$lastname = $_REQUEST['lastname'];
$Acct_no = $_REQUEST['Acct_no'];
$email = $_REQUEST['email'];
$pass = $_REQUEST['pass'];

$sql = "INSERT INTO bank (firstname, lastname, Acct_no, email, pass)
VALUES ('$firstname', '$lastname', '$Acct_no', '$email', '$pass')";


echo "<div class="links">
        <a href="savings.html">View Savings</a>
        <a href="checking.html">View Checking</a>
    </div>";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
</body>
</html>
