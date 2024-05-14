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

$Acct_no = $_POST['Acct_no'];

$sql = "SELECT * FROM savings WHERE Acct_no='$Acct_no'";
$result = $conn->query($sql);

//================
$first1 = "SELECT firstname FROM savings WHERE Acct_no='$Acct_no'";
$fname1 = $conn->query($first1);
$firstname1 = $fname1->fetch_assoc()['firstname']; // Fetch the firstname from the result

$firstname2 = "SELECT firstname FROM savings_transactions WHERE firstname='$firstname1'";
$fname2 = $conn->query($firstname2);
$firstname2 = $fname2->fetch_assoc()['firstname']; // Fetch the firstname from the result

echo "savings: " . $firstname1 . "<br>savings transactions: " . $firstname2;
//================


if ($result == false) {
    echo "Error: Account not found" . $conn->error;
} else {
  while($row = $result->fetch_assoc()){
    echo "Savings Account: " . $Acct_no . " ---- Balance: $" . $row['Balance'] . "<br>";

    // getting transaction info from table
    $sql1 = "SELECT savings_transactions.* FROM savings_transactions JOIN savings ON savings_transactions.firstname = savings.firstname ORDER BY trans_date DESC";
    $result1 = $conn->query($sql1);
  
    if ($result1->num_rows > 0) {
        while ($row1 = $result1->fetch_assoc()) {
            // check transaction type & display transactions
            if ($row1["trans_type"] == 'deposit') {
                echo "Date: " . $row1["trans_date"] . " ------------ Amount: + $" . $row1["trans_amount"] . "<br>";
            } elseif ($row1["trans_type"] == 'withdraw') {
                echo "Date: " . $row1["trans_date"] . " ------------ Amount: - $" . $row1["trans_amount"] . "<br>";
            }
        }
    } else {
        echo "0 results";
    }
  }
}

$conn->close();
?>
