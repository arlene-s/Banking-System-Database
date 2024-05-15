<html>
<body>


Checking Account<br><br>

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
  
$sql = "SELECT *  FROM checking where Acct_no=$Acct_no";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data
    $row = $result->fetch_assoc();
    echo "Account Number: " . $row["Acct_no"]. "<br>";
    echo "Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    echo "Address: ". $row["address"]."<br>";
    echo "Email: " . $row["email"]."<br>";
    echo "Phone: " . $row["phone"]."<br>";
    echo "Balance: " . $row["Balance"]."<br>";
    echo "Date: " . $row["date"]."<br>";
    echo "TransID: " . $row["TRansID"]."<br><br>";

    echo "<a href='updatechecking.html'>Update Checking Info</a><br>";
    echo "<a href='deletechecking.html'>Delete Checking Info</a><br><br>";
    
    echo "<a href='dashboard.html'>Back To Dashboard</a><br>";
} else {
  echo "0 results";
}
$conn->close();
?>

</body>
</html>