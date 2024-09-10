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
    $supplierId = $_POST["supplierId"];
    $purchaseDate = $_POST["date"]; // Get the purchase date from the form
    $purchaseCost = $quantity * $pricePerUnit; // Calculate purchase cost

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Insert into purchase_transactions
        $sql = "INSERT INTO purchase_transactions (product_id, size, color, quantity, price_per_unit, purchase_cost, supplier_id, purchase_date) 
                VALUES ('$productId', '$size', '$color', '$quantity', '$pricePerUnit', '$purchaseCost', '$supplierId', '$purchaseDate')";

        if ($conn->query($sql) === TRUE) {
            // Check if the product variant exists in inventory_details
            $sql = "SELECT quantity FROM inventory_details WHERE product_id='$productId' AND size='$size' AND color='$color'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Update existing inventory
                $row = $result->fetch_assoc();
                $newQuantity = $row['quantity'] + $quantity;
                $sql = "UPDATE inventory_details SET quantity='$newQuantity' WHERE product_id='$productId' AND size='$size' AND color='$color'";
            } else {
                // Insert new inventory record
                $sql = "INSERT INTO inventory_details (product_id, size, color, quantity) VALUES ('$productId', '$size', '$color', '$quantity')";
            }

            if ($conn->query($sql) === TRUE) {
                // Commit transaction
                $conn->commit();
                echo "<script>alert('Purchase and inventory updated successfully.'); window.location.href = 'purchase.php';</script>";
            } else {
                throw new Exception("Error updating inventory: " . $conn->error);
            }
        } else {
            throw new Exception("Error inserting purchase transaction: " . $conn->error);
        }
    } catch (Exception $e) {
        // Rollback transaction
        $conn->rollback();
        echo "<script>alert('Failed to update purchase: " . $e->getMessage() . "'); window.history.back();</script>";
    }
}

$conn->close();
?>
