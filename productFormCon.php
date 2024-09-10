<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = isset($_POST["productId"]) ? $conn->real_escape_string($_POST["productId"]) : '';
    $productName = $conn->real_escape_string($_POST["productName"]);
    $productType = $conn->real_escape_string($_POST["productType"]);
    $description = $conn->real_escape_string($_POST["description"]);

    if (empty($productId)) {
        // Insert new product
        $sql = "INSERT INTO product_details (product_name, product_type, description) VALUES ('$productName', '$productType', '$description')";
    } else {
        // Update existing product
        $sql = "UPDATE product_details SET product_name='$productName', product_type='$productType', description='$description' WHERE product_id='$productId'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Operation successful.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    header("Location: products.php");
    exit();
}

$conn->close();
?>
