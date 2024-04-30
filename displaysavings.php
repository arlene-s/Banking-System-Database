<html>
<body>
Results of ABC Bank Database<br><br>
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
$Balance = $_REQUEST['Balance'];

$sql = "SELECT * FROM savings WHERE Acct_no='$Acct_no'";
$result = $conn->query($sql);

if ($result === false) {
  echo "Error: " . $conn->error;
} else {
  echo "Savings Account<br>";

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "Account Number: " . $row["Acct_no"] . "<br>";
      echo "Date: " . $row["Date"]. " ---- Balance: " . $row["Balance"]. "<br>";
    }
  } else {
    echo "0 results";
  }
}

$conn->close();
?>
</body>
</html>
