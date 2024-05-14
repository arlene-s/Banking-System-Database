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

$sql = "SELECT * FROM Investment WHERE Acct_no='$Acct_no'";
$result = $conn->query($sql);

if ($result === false) {
    echo "Error: Account not found" . $conn->error;
} else {
  while($row = $result->fetch_assoc()){
    echo "Investment Account: " . $Acct_no . " ---- Balance: $" . $row['Balance'] . "<br>";

    // getting transaction info from table
    $sql_trans = "SELECT * FROM investment_transactions WHERE transid='$Acct_no'";
    $result_trans = $conn->query($sql_trans);
  
    if ($result_trans->num_rows > 0) {
        while ($row_trans = $result_trans->fetch_assoc()) {
            // check transaction type & display transactions
            if ($row_trans["trans_type"] == 'deposit') {
                echo "Date: " . $row_trans["trans_date"] . " ------------ Amount: + $" . $row_trans["trans_amount"] . "<br>";
            } elseif ($row_trans["trans_type"] == 'withdraw') {
                echo "Date: " . $row_trans["trans_date"] . " ------------ Amount: - $" . $row_trans["trans_amount"] . "<br>";
            }
        }
    } else {
        echo "0 results";
    }
  }
}

$conn->close();
?>
