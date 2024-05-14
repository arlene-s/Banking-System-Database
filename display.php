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

// SQL query to select all data from the 'savings_transactions' table
$sql = "SELECT * FROM savings_transactions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    echo "<table border='1'><tr><th>trans_id</th><th>trans_date</th><th>trans_type</th><th>trans_amount</th><th>lastname</th><th>firstname</th><th>phone</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["trans_id"] . "</td><td>" . $row["trans_date"] . "</td><td>" . $row["trans_type"] . "</td><td>" . $row["trans_amount"] . "</td><td>" . $row["lastname"] . "</td><td>" . $row["firstname"] . "</td><td>" . $row["phone"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// SQL query to get column names from the 'savings_transactions' table
$sql_columns = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'savings'";
$result_columns = $conn->query($sql_columns);

if ($result_columns->num_rows > 0) {
    // Output data of each column name
    echo "<table border='1'><tr>";
    while ($row_columns = $result_columns->fetch_assoc()) {
        echo "<th>" . $row_columns["COLUMN_NAME"] . "</th>";
    }
    echo "</tr>";

    // SQL query to select all data from the 'savings_transactions' table
    $sql_data = "SELECT * FROM savings";
    $result_data = $conn->query($sql_data);

    if ($result_data->num_rows > 0) {
        // Output data of each row
        while ($row_data = $result_data->fetch_assoc()) {
            echo "<tr>";
            foreach ($row_data as $key => $value) {
                echo "<td>" . $value . "</td>";
            }
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='" . $result_columns->num_rows . "'>0 results</td></tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
