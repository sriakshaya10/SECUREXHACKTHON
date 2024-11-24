<?php
// Include database configuration
include('config.php');

// Check database connection
if (!$conn) {
    die("Error: Unable to connect to the database. " . mysqli_connect_error());
}

// SQL query to create the users table
$createTableQuery = "
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    );
";

// Execute the query
if ($conn->query($createTableQuery) === TRUE) {
    echo "Table 'users' created successfully or already exists.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Optional: Add a default user for testing
$defaultPassword = password_hash('testpassword', PASSWORD_DEFAULT);
$insertUserQuery = "
    INSERT INTO users (username, email, password) 
    VALUES ('testuser', 'testuser@example.com', '$defaultPassword')
    ON DUPLICATE KEY UPDATE email=email;
";

if ($conn->query($insertUserQuery) === TRUE) {
    echo "Default user added successfully or already exists.<br>";
} else {
    echo "Error adding default user: " . $conn->error . "<br>";
}

// Close the database connection
$conn->close();
?>
