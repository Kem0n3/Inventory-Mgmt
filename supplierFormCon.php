<?php
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $supplierId = $_POST['supplierId'];
    $supplierName = $_POST['supplierName'];
    $supplierAddress = $_POST['supplierAddress'];
    $supplierPhone = $_POST['supplierPhone'];
    
    // Determine if this is an add or update operation
    if (isset($_POST['add_supplier'])) {
        // Add new supplier
        $stmt = $conn->prepare("INSERT INTO suppliers (supplier_name, address, phone_number) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $supplierName, $supplierAddress, $supplierPhone);

        if ($stmt->execute()) {
            echo "New supplier added successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } elseif (isset($_POST['update_supplier'])) {
        // Update existing supplier
        $stmt = $conn->prepare("UPDATE suppliers SET supplier_name=?, address=?, phone_number=? WHERE supplier_id=?");
        $stmt->bind_param("sssi", $supplierName, $supplierAddress, $supplierPhone, $supplierId);

        if ($stmt->execute()) {
            echo "Supplier updated successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Close the connection
$conn->close();

// Redirect back to the suppliers page (or wherever needed)
header("Location: supplier.php");
exit();
?>
