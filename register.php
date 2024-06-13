<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Room";


$conn = new mysqli($servername, $username, $password);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sqlCreateDB) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}


$conn->select_db($dbname);


$sqlCreateTable = "CREATE TABLE IF NOT EXISTS Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phoneNumber VARCHAR (100) NOT NULL,
    password VARCHAR(255) NOT NULL
)";


if ($conn->query($sqlCreateTable) === TRUE) {
    echo "Table Users created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['Phone Number'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sqlInsert = "INSERT INTO Users (firstName, lastName, email, password)
                  VALUES ('$firstName', '$lastName', '$email', '$password')";

    if ($conn->query($sqlInsert) === TRUE) {
        echo "Registration successful";
    } else {
        echo "Error inserting user: " . $conn->error;
    }
}

$conn->close();
?>
