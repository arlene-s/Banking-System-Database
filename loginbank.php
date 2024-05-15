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
$userid = $_REQUEST['userid'];
$pssword = $_REQUEST['pssword'];

// check whether userid and password exist in login tbl

$checklogintbl = "SELECT * FROM login_tbl WHERE userid='$userid' AND pssword='$pssword'";
$result = $conn->query($checklogintbl);

/*
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
*/


$firstname_query = "SELECT firstname from login_tbl where userid='$userid' and pssword='$pssword'";
$lastname_query = "SELECT lastname from login_tbl where userid='$userid' and pssword='$pssword'";

$firstname_result = $conn->query($firstname_query);
$lastname_result = $conn->query($lastname_query);

if ($result->num_rows > 0) {

    if ($firstname_result->num_rows > 0 && $lastname_result->num_rows > 0) {
        // Fetching the first row from each result
        $firstname_row = $firstname_result->fetch_assoc();
        $lastname_row = $lastname_result->fetch_assoc();
    
        $firstname = $firstname_row['firstname'];
        $lastname = $lastname_row['lastname'];
    
        echo "Welcome $firstname $lastname !<br>";
    
        echo "<a href='dashboard.html'>Go To Dashboard</a><br>";
    
    } else {
        echo "Error: cannot retrieve info" . "<br>" . $conn->error;
    }
    
} else {
    echo "Error" . $conn->error;
}


$conn->close();
?>
</body>
</html>
