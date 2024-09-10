<?php include 'navbar.php'; ?>
<?php include 'session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sales Form</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="sales.css">
    <style>
        /* Popup styles */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        .popup.show {
            display: block;
        }
        .popup button {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <main class="main">
        <div class="card">
            <h2>Sales Form</h2>
            <form action="salesFormCon.php" method="POST" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="productId">Product:</label>
                    <select id="productId" name="productId" required>
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
                    <select id="size" name="size" required>
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
                    <label for="customerId">Customer:</label>
                    <select id="customerId" name="customerId" required>
                        <?php
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT customer_id, customer_name FROM customers";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["customer_id"] . "'>" . $row["customer_name"] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No customers available</option>";
                        }

                        $conn->close();
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date">Sale Date:</label>
                    <input type="date" id="date" name="date" required>
                </div>

                <button type="submit" name="add_sale">Add Sale</button>
            </form>
        </div>
    </main>

    <div id="popup" class="popup">
        <p id="popupMessage">Operation successful!</p>
        <button onclick="closePopup()">OK</button>
    </div>

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

        function showPopup(message) {
            document.getElementById('popupMessage').innerText = message;
            document.getElementById('popup').classList.add('show');
        }

        function closePopup() {
            document.getElementById('popup').classList.remove('show');
        }

        // Check if there's a message in URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('message')) {
            showPopup(urlParams.get('message'));
        }
    </script>
</body>
</html>
