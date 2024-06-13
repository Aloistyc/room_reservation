<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "Room";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("SELECT id, name, email, phone, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);

    // Set parameters and execute
    $email = $_POST["email"];
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if (password_verify($_POST["password"], $row["password"])) {
            // Password correct, login successful
            echo "<p>Login successful! Welcome, " . $row["name"] . "!</p>";
        } else {
            // Password incorrect
            echo "<p>Incorrect password. Please try again.</p>";
        }
    } else {
        // User not found
        echo "<p>User not found. Please check your email and try again.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
