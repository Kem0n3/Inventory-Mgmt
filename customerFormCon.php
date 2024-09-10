<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerName = $_POST["customerName"];
    $customerAddress = $_POST["customerAddress"];
    $customerPhone = $_POST["customerPhone"];

    if (isset($_POST["add_customer"])) {
        $sql = "INSERT INTO customers (customer_name, address, phone_number) VALUES ('$customerName', '$customerAddress', '$customerPhone')";
        if ($conn->query($sql) === TRUE) {
            echo "New customer added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST["update_customer"])) {
        $customerId = $_POST["customerId"];
        $sql = "UPDATE customers SET customer_name='$customerName', address='$customerAddress', phone_number='$customerPhone' WHERE customer_id='$customerId'";
        if ($conn->query($sql) === TRUE) {
            echo "Customer updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    header("Location: customer.php");
    exit();
}

$conn->close();
?>
