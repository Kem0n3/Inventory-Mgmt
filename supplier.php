<?php include 'navbar.php'; ?>
<?php include 'session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Suppliers</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="supplier.css">
</head>
<body>
    <main class="main">
        <div class="card">
            <div class="container">
                <h2 id="formTitle">Add New Supplier</h2>
                <form action="supplierFormCon.php" method="POST">
                    <input type="hidden" id="supplierId" name="supplierId">
                    <div class="form-group">
                        <label for="supplierName">Supplier Name:</label>
                        <input type="text" id="supplierName" name="supplierName" required>
                    </div>
                    <div class="form-group">
                        <label for="supplierAddress">Address:</label>
                        <input type="text" id="supplierAddress" name="supplierAddress" required>
                    </div>
                    <div class="form-group">
                        <label for="supplierPhone">Phone Number:</label>
                        <input type="text" id="supplierPhone" name="supplierPhone" required>
                    </div>
                    <button type="submit" id="submitButton" name="add_supplier">Add Supplier</button>
                </form>
            </div>
        </div>

        <div class="card">
            <h2 style="text-align: center;">Supplier Details</h2>
            <table>
                <thead>
                    <tr>
                        <th>Supplier ID</th>
                        <th>Supplier Name</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
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

                    // Fetch supplier details
                    $sql = "SELECT supplier_id, supplier_name, address, phone_number FROM suppliers";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["supplier_id"] . "</td>";
                            echo "<td>" . $row["supplier_name"] . "</td>";
                            echo "<td>" . $row["address"] . "</td>";
                            echo "<td>" . $row["phone_number"] . "</td>";
                            echo "<td>
                                    <button class='button edit-button' onclick=\"editSupplier('" . $row["supplier_id"] . "', '" . $row["supplier_name"] . "', '" . $row["address"] . "', '" . $row["phone_number"] . "')\">Edit</button> 
                                    <a href='deleteSupplier.php?id=" . $row["supplier_id"] . "' class='delete-btn'>Delete</a>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No suppliers found</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        function editSupplier(id, name, address, phone) {
            document.getElementById('supplierId').value = id;
            document.getElementById('supplierName').value = name;
            document.getElementById('supplierAddress').value = address;
            document.getElementById('supplierPhone').value = phone;
            document.getElementById('formTitle').innerText = 'Edit Supplier';
            document.getElementById('submitButton').innerText = 'Update Supplier';
            document.getElementById('submitButton').name = 'update_supplier';
        }
    </script>
</body>
</html>
