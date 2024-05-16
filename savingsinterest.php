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

// getting variables from table
$Acct_no = $_POST['Acct_no'];
$date_calc = $_POST['date'];

// checking if account number exists using a prepared statement
$sql = "SELECT * FROM savings WHERE Acct_no = '$Acct_no'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // account exists
    $row = $result->fetch_assoc();
    echo "Account Number: " . $row['Acct_no'] . " ------ Account Created: " . $row['Date'] . "<br>Interest Rate: " . $row['interest_rate'] . " ------ Current Balance: " . $row['Balance'] . "<br>";
    
    $savingsBalance = $row['Balance'];
    $savingsInterest = $row['interest_rate'];
    $savingsDate = $row['Date'];

    // finding difference between dates
    $sql_date = "SELECT DATEDIFF('$date_calc', '$savingsDate') AS date_diff";
    $date_result = $conn->query($sql_date);
    $date_row = $date_result->fetch_assoc();
    $days_diff = $date_row['date_diff'];

    if ($days_diff >= 30) {
        // calculating interest for every 30 days
        while ($days_diff >= 30) {
            $newBalance = $savingsBalance + $savingsBalance * $savingsInterest;
            $days_diff -= 30;
        }

        // output calculation
        echo "<br>Total Balance after Interest Calculation: $" . $newBalance;
    } else {
        echo "<br>Could not calculate interest: Must be calculated for at least one month<br>";
    }
    echo "<a href='dashboard.html'>Back To Dashboard</a><br>";
} else {
    echo "Account not found";
}

$conn->close();
?>
