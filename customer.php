<?php include 'navbar.php'; ?>
<?php include 'session_check.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Customers</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="customer.css">
</head>
<body>
    <main class="main">
        <div class="card">
            <div class="container">
                <h2 id="formTitle">Add New Customer</h2>
                <form action="customerFormCon.php" method="POST">
                    <input type="hidden" id="customerId" name="customerId">
                    <div class="form-group">
                        <label for="customerName">Customer Name:</label>
                        <input type="text" id="customerName" name="customerName" required>
                    </div>
                    <div class="form-group">
                        <label for="customerAddress">Address:</label>
                        <input type="text" id="customerAddress" name="customerAddress" required>
                    </div>
                    <div class="form-group">
                        <label for="customerPhone">Phone Number:</label>
                        <input type="text" id="customerPhone" name="customerPhone" required>
                    </div>
                    <button type="submit" id="submitButton" name="add_customer">Add Customer</button>
                </form>
            </div>
        </div>

        <div class="card">
            <h2 style="text-align: center;">Customer Details</h2>
            <table>
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "inventory";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT customer_id, customer_name, address, phone_number FROM customers";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["customer_id"] . "</td>";
                            echo "<td>" . $row["customer_name"] . "</td>";
                            echo "<td>" . $row["address"] . "</td>";
                            echo "<td>" . $row["phone_number"] . "</td>";
                            echo "<td>
                                    <button class='button edit-button' onclick=\"editCustomer('" . $row["customer_id"] . "', '" . $row["customer_name"] . "', '" . $row["address"] . "', '" . $row["phone_number"] . "')\">Edit</button>
                                    <a href='deleteCustomer.php?id=" . $row["customer_id"] . "' class='button delete-btn'>Delete</a>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No customers found</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        function editCustomer(id, name, address, phone) {
            document.getElementById('customerId').value = id;
            document.getElementById('customerName').value = name;
            document.getElementById('customerAddress').value = address;
            document.getElementById('customerPhone').value = phone;
            document.getElementById('formTitle').innerText = 'Edit Customer';
            document.getElementById('submitButton').innerText = 'Update Customer';
            document.getElementById('submitButton').name = 'update_customer';
        }
    </script>
</body>
</html>
