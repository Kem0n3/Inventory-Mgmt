<?php include 'navbar.php'; ?>
<?php include 'session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Purchase Form</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="purchase.css">
</head>
<body>
    <main class="main">
        <div class="card">
            <h2>Purchase Form</h2>
            <form action="purchaseFormCon.php" method="POST" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="productId">Product:</label>
                    <select id="productId" name="productId" placeholder="Select product" required>
                        <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "inventory";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT product_id, product_name FROM product_details";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["product_id"] . "'>" . $row["product_name"] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No products available</option>";
                        }

                        $conn->close();
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="size">Size:</label>
                    <select id="size" name="size">
                        <option value="38">38</option>
                        <option value="39">39</option>
                        <option value="40">40</option>
                        <option value="41">41</option>
                        <option value="42">42</option>
                        <option value="43">43</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="color">Color:</label>
                    <input type="text" id="color" name="color" required>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" min="1" step="1" required>
                </div>
                
                <div class="form-group">
                    <label for="pricePerUnit">Price per Unit:</label>
                    <input type="number" id="pricePerUnit" name="pricePerUnit" min="0.01" step="0.01" required>
                </div>
                
                <div class="form-group">
                    <label for="supplierId">Supplier:</label>
                    <select id="supplierId" name="supplierId" required>
                        <?php
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT supplier_id, supplier_name FROM suppliers";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["supplier_id"] . "'>" . $row["supplier_name"] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No suppliers available</option>";
                        }

                        $conn->close();
                        ?>
                    </select>
                </div>

                <!-- Date field -->
                <div class="form-group">
                    <label for="date">Purchase Date:</label>
                    <input type="date" id="date" name="date" required>
                </div>

                <button type="submit" name="add_purchase">Add Purchase</button>
            </form>
        </div>
    </main>

    <script>
        function validateForm() {
            let quantity = document.getElementById('quantity').value;
            let pricePerUnit = document.getElementById('pricePerUnit').value;

            if (quantity <= 0 || pricePerUnit <= 0) {
                alert('Quantity and Price per Unit must be positive values.');
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }
    </script>
</body>
</html>
