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
$transid = $_POST['transid'];
$trans_date = $_POST['trans_date'];
$trans_type = $_POST['trans_type'];
$trans_amount = $_POST['trans_amount'];

// checking if account number exists
$sql = "SELECT * FROM Investment WHERE Acct_no='$transid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // account exists, proceed with transaction
    $row = $result->fetch_assoc();
    $currentBalance = $row['Balance'];

    // inserting transaction data into table
    $sql_insert = "INSERT INTO investment_transactions (trans_date, trans_type, trans_amount) VALUES ('$trans_date', '$trans_type', '$trans_amount')";

    // performing transaction based on transaction type
    if ($trans_type == 'deposit') {
        $newBalance = $currentBalance + $trans_amount;
    } elseif ($trans_type == 'withdraw') {
        if ($trans_amount > $currentBalance) {
            echo "Insufficient balance";
            exit;
        }
        $newBalance = $currentBalance - $trans_amount;
    } else {
        echo "Invalid transaction type";
        exit;
    }

    // updating balance in savings table
    $sql_update = "UPDATE Investment SET Balance='$newBalance' WHERE Acct_no='$transid'";
    if ($conn->query($sql_update) === TRUE) {
        echo "Transaction successful<br>New Balance: $" . $newBalance;
    } else {
        echo "Error with transaction: " . $conn->error;
    }
} else {
    echo "Account not found";
}

$conn->close();
?>