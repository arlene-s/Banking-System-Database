<html>
<body>
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
   // get the variables from the URL request string
   $Acct_no = $_REQUEST['Acct_no'];
   $Date = $_REQUEST['Date'];
   $Balance = $_REQUEST['Balance'];

   $sql = "INSERT INTO savings (Acct_no, Date, Balance)
VALUES ('$Acct_no', '$Date', '$Balance')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

</body>
</html>
