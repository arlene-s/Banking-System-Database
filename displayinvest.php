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

$sql = "SELECT *  FROM Investment where Acct_no=$Acct_no";
$result = $conn->query($sql);

$sql_trans = "SELECT trans_date, trans_type, trans_amount from investment_transactions WHERE transid=$Acct_no";
$result1 = $conn->query($sql_trans);

if ($result->num_rows > 0) {
  // output data
    $row = $result->fetch_assoc();
    echo "Account Number: " . $row["Acct_no"]. "<br>";
    echo "Name: " . $row["firstname"]. " " . $row["lastname"]. "<br><br>";

    echo "Balance: $" . $row["Balance"]."<br><br>";

    if ($result1->num_rows > 0) {
        // check transaction type & display transactions
      while($row = $result1->fetch_assoc()) {
          echo "Date: " . $row["trans_date"]. " - Type: " . $row["trans_type"]. " - Amount: " . $row["trans_amount"]. "<br>";
      }
    } else {
      echo "No transactions to display<br><br>";
    }

    echo "<br><a href='investtrans.html'>Make a Transaction</a><br><br>";

    echo "<a href='searchinvest.html'>Search Investments Info</a><br>";
    echo "<a href='updateinvest.html'>Update Investments Info</a><br>";
    echo "<a href='deleteinvest.html'>Delete Investments Info</a><br><br>";
    
    echo "<a href='dashboard.html'>Back To Dashboard</a><br>";
} else {
  echo "0 results";
}

$conn->close();
?>
