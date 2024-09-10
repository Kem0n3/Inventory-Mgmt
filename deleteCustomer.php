<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventory";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["id"])) {
    $customerId = $_GET["id"];
    $sql = "DELETE FROM customers WHERE customer_id='$customerId'";
    if ($conn->query($sql) === TRUE) {
        echo "Customer deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header("Location: customer.php");
    exit();
}

$conn->close();
?>
