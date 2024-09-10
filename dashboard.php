<?php include 'session_check.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="dash.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

<header class="header">
    <div class="left-txt"><h1>Dashboard</h1></div>
    <div class="logout">
        <a href="logout.php"><i class='bx bx-log-out'></i> Log out</a>
    </div>
</header>

<section class="sidebar">
    <div>
        <a href="" class="logo-link">
            <img src="logo.svg" alt="logo">
        </a>
    </div>

    <div class="menu">
        <a href="dashboard.php"><i class='bx bxs-dashboard'></i>Dashboard</a>
        <a href="products.php"><i class='bx bxs-package'></i>Products</a>
        <a href="customer.php"><i class='bx bxs-phone-outgoing'></i>Customers</a>
        <a href="supplier.php"><i class='bx bxs-phone-incoming'></i>Suppliers</a>
        <a href="purchase.php"><i class='bx bxs-purchase-tag'></i>Purchase</a>
        <a href="sales.php"><i class='bx bxs-dollar-circle'></i>Sales</a>
        <a href="inventory.php"><i class='bx bxs-box'></i>Inventory</a>
    </div>
</section>

<main class="main">
    <div class="card">
        <h2>Recent Purchase Transactions</h2>
        <div class="transactions">
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Quantity</th>
                        <th>Price per Unit</th>
                        <th>Supplier ID</th>
                        <th>Purchase Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
            
                    $conn = new mysqli('localhost', 'root', '', 'inventory');

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    
                    $sql = "SELECT * FROM purchase_transactions";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["product_id"] . "</td>
                                    <td>" . $row["size"] . "</td>
                                    <td>" . $row["color"] . "</td>
                                    <td>" . $row["quantity"] . "</td>
                                    <td>" . $row["price_per_unit"] . "</td>
                                    <td>" . $row["supplier_id"] . "</td>
                                    <td>" . $row["purchase_date"] . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No purchase transactions found</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <h2>Recent Sales Transactions</h2>
        <div class="transactions">
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Quantity</th>
                        <th>Price per Unit</th>
                        <th>Customer ID</th>
                        <th>Sale Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $conn = new mysqli('localhost', 'root', '', 'inventory');

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    
                    $sql = "SELECT * FROM sales_transactions";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["product_id"] . "</td>
                                    <td>" . $row["size"] . "</td>
                                    <td>" . $row["color"] . "</td>
                                    <td>" . $row["quantity"] . "</td>
                                    <td>" . $row["price_per_unit"] . "</td>
                                    <td>" . $row["customer_id"] . "</td>
                                    <td>" . $row["sale_date"] . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No sales transactions found</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>


</body>
</html>
