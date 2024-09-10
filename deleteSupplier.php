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
    $supplierId = $_GET["id"];

    $sql = "DELETE FROM suppliers WHERE supplier_id = $supplierId";

    if ($conn->query($sql) === TRUE) {
        echo "Supplier deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
header("Location: supplier.php");
exit();
?>
