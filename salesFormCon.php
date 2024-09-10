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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST["productId"];
    $size = $_POST["size"];
    $color = $_POST["color"];
    $quantity = $_POST["quantity"];
    $pricePerUnit = $_POST["pricePerUnit"];
    $customerId = $_POST["customerId"];
    $saleDate = $_POST["date"]; // Get the sale date from the form
    $saleTotal = $quantity * $pricePerUnit; // Calculate sale total

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Debug: Check received inputs
        // echo "Received: ProductID=$productId, Size=$size, Color=$color, Quantity=$quantity, PricePerUnit=$pricePerUnit, CustomerID=$customerId, SaleDate=$saleDate";

        // Check if the product variant exists in inventory_details
        $sql = "SELECT quantity FROM inventory_details WHERE product_id='$productId' AND size='$size' AND color='$color'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $newQuantity = $row['quantity'] - $quantity;

            if ($newQuantity < 0) {
                throw new Exception("Insufficient stock for the selected product variant.");
            }

            // Update existing inventory
            $sql = "UPDATE inventory_details SET quantity='$newQuantity' WHERE product_id='$productId' AND size='$size' AND color='$color'";
            if (!$conn->query($sql)) {
                throw new Exception("Error updating inventory: " . $conn->error);
            }

            // Insert into sales_transactions
            $sql = "INSERT INTO sales_transactions (product_id, size, color, quantity, price_per_unit, sale_total, customer_id, sale_date) 
                    VALUES ('$productId', '$size', '$color', '$quantity', '$pricePerUnit', '$saleTotal', '$customerId', '$saleDate')";

            if ($conn->query($sql) === TRUE) {
                // Commit transaction
                $conn->commit();
                echo "<script>alert('Sale and inventory updated successfully.'); window.location.href = 'sales.php';</script>";
            } else {
                throw new Exception("Error inserting sale transaction: " . $conn->error);
            }
        } else {
            throw new Exception("Product variant not found in inventory.");
        }
    } catch (Exception $e) {
        // Rollback transaction
        $conn->rollback();
        // Debug: Output the exact error
        echo "<script>alert('Failed to process sale: " . $e->getMessage() . "'); window.history.back();</script>";
    }
}

$conn->close();
?>
