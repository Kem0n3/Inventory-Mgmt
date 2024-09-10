<?php include 'navbar.php'; ?>
<?php include 'session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Products</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="products.css">
</head>
<body>
    <main class="main">
        <div class="card">
            <div class="container">
                <h2 id="formTitle">Add New Product</h2>
                <form action="productFormCon.php" method="POST">
                    <input type="hidden" id="productId" name="productId">
                    <div class="form-group">
                        <label for="productName">Product Name:</label>
                        <input type="text" id="productName" name="productName" required>
                    </div>
                    <div class="form-group">
                        <label for="productType">Product Type:</label>
                        <input type="text" id="productType" name="productType" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" required></textarea>
                    </div>
                    <button type="submit" id="submitButton" name="add_product">Add Product</button>
                </form>
            </div>
        </div>

        <div class="card">
            <h2 style="text-align: center;">Product Details</h2>
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Product Type</th>
                        <th>Description</th>
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


                    $sql = "SELECT product_id, product_name, product_type, description FROM product_details";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["product_id"] . "</td>";
                            echo "<td>" . $row["product_name"] . "</td>";
                            echo "<td>" . $row["product_type"] . "</td>";
                            echo "<td>" . $row["description"] . "</td>";
                            echo "<td>
                                    <button class='button edit-button' onclick=\"editProduct('" . $row["product_id"] . "', '" . $row["product_name"] . "', '" . $row["product_type"] . "', '" . $row["description"] . "')\">Edit</button>
                                    <a href='deleteproduct.php?id=" . $row["product_id"] . "' class='button delete-button'>Delete</a>
                                </td>";
                    
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No products found</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        function editProduct(id, name, type, description) {
            document.getElementById('productId').value = id;
            document.getElementById('productName').value = name;
            document.getElementById('productType').value = type;
            document.getElementById('description').value = description;
            document.getElementById('formTitle').innerText = 'Edit Product';
            document.getElementById('submitButton').innerText = 'Update Product';
            document.getElementById('submitButton').name = 'update_product';
        }
    </script>
</body>
</html>
