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
$transid = $conn->real_escape_string($_POST['transid']);
$trans_date = $conn->real_escape_string($_POST['trans_date']);
$trans_amount = $conn->real_escape_string($_POST['trans_amount']);
$destination = $conn->real_escape_string($_POST['destination']);
$dest_acct = $conn->real_escape_string($_POST['dest']);
$trans_type = 'transfer';

// checking if account number exists
$sql = "SELECT * FROM savings WHERE Acct_no='$transid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // account exists
    $row = $result->fetch_assoc();
    $savingsBalance = $row['Balance'];

    // check if savings has enough for transfer
    if ($trans_amount > $savingsBalance) {
        echo "Insufficient balance";
        exit;
    } else {
        $conn->begin_transaction();

        // insert transaction data into table
        $sql_insert = "INSERT INTO savings_transactions (trans_date, trans_type, trans_amount) VALUES ('$trans_date', '$trans_type', '$trans_amount')";
        if (!$conn->query($sql_insert)) {
            echo "Error with transaction: " . $conn->error;
            $conn->rollback();
            exit;
        }

        // update balance in destination account
        $update_query = "";
        if ($destination == 'checking') {
            $update_query = "UPDATE checking SET Balance = Balance + $trans_amount WHERE Acct_no = '$dest_acct'";
        } elseif ($destination == 'investment') {
            $update_query = "UPDATE Investment SET Balance = Balance + $trans_amount WHERE Acct_no = '$dest_acct'";
        } else {
            echo "Invalid transaction type";
            $conn->rollback();
            exit;
        }

        if (!$conn->query($update_query)) {
            echo "Error with transaction: " . $conn->error;
            $conn->rollback();
            exit;
        }

        // update balance in savings account
        $update_savings = "UPDATE savings SET Balance = Balance - $trans_amount WHERE Acct_no = '$transid'";
        if (!$conn->query($update_savings)) {
            echo "Error with transaction: " . $conn->error;
            $conn->rollback();
            exit;
        }
        $conn->commit();
        
        echo "Transaction successful";
        echo "<a href='dashboard.html'>Back To Dashboard</a><br>";
    }
} else {
    echo "Account not found";
}

$conn->close();
?>
