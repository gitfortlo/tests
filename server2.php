<?php

session_start();

global $client_name, $client_surname;
// Retrieve form data
$clientID = "";
$client_name = "";
$client_surname = "";
$issue_reported = "";
$descript_of_issue = "";
$date_time_of_issue = "";
$errors = array();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "issue_reports";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement
$sql = "INSERT INTO issue_reports (Client_ID, Client_name, Client_surname, Issue_reported, descript_of_issue, Date_time_of_issue) 
        VALUES ('$clientID', '$clientName', '$clientSurname', '$issue', '$description', '$date_time_of_issue')";

if ($conn->query($sql) === TRUE) {
    echo "Ticket submitted successfully!<br>";
    echo "Client ID: " . $clientID . "<br>";
    echo "Client Name: " . $clientName . "<br>";
    echo "Issue: " . $issue . "<br>";
    echo "Description: " . $description . "<br>";
    echo "Date/Time: " . $date_time_of_issue . "<br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
