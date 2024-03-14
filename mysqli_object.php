<?php
$server = 'Localhost';
$username = 'root';
$password = '';
$dbname = 'oop_php';

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM students";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Id: {$row['id']} - Name: {$row['student_name']} - Age: {$row['age']} - City: {$row['city']}";
        echo "<br>";
    }
} else {
    echo "no result found";
}
$conn->close();
