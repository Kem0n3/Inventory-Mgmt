<?php
// Database connection parameters
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

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Begin a transaction
    $conn->begin_transaction();

    try {
        // Delete related records from inventory_details
        $sql = "DELETE FROM inventory_details WHERE product_id = $product_id";
        if ($conn->query($sql) !== TRUE) {
            throw new Exception("Error deleting from inventory_details: " . $conn->error);
        }

        // Delete the product
        $sql = "DELETE FROM product_details WHERE product_id = $product_id";
        if ($conn->query($sql) !== TRUE) {
            throw new Exception("Error deleting from product_details: " . $conn->error);
        }

        // Commit transaction
        $conn->commit();
        echo "Product and related inventory details deleted successfully";
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo "Failed to delete product: " . $e->getMessage();
    }
}

$conn->close();
?>
