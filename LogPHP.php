<?php
session_start();

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establishing a connection to MySQL database
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "inventory"; 

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetching username and password from the login form
    $username_entered = $_POST['username'] ?? null;
    $password_entered = $_POST['password'] ?? null;

    // Validate form input
    if ($username_entered && $password_entered) {
        // Query to fetch user data based on username
        $sql = "SELECT * FROM login WHERE user_name='$username_entered'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // User found, check password
            $row = $result->fetch_assoc();
            $stored_password = $row['user_password']; // Fetching plain-text password from the database
            if ($password_entered === $stored_password) {
                // Password matches, login successful
                $_SESSION['username'] = $username_entered;
                header("Location: dashboard.php"); // Redirects to dashboard page
                exit();
            } else {
                // Password does not match
                echo "Invalid password";
            }
        } else {
            // Username not found
            echo "Username not found";
        }
    } else {
        echo "Both username and password are required.";
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
