<?php
    // Database connection parameters
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "dynamic_project";

    // Establish database connection
    $connection = mysqli_connect($hostname, $username, $password, $database);

    // Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
// 1️⃣ Supply below safety stock
$sql1 = "SELECT COUNT(*) AS below_count FROM users";
$result1 = $connection->query($sql1);
$row1 = $result1->fetch_assoc();
$supplyBelow = $row1['below_count'];

// 2️⃣ Overall supply inventory
$sql2 = "SELECT SUM(stock) AS total_stock FROM inventory";
$result2 = $connection->query($sql2);
$row2 = $result2->fetch_assoc();
$inventory = $row2['total_stock'];

// 3️⃣ Open supply order value
$sql3 = "SELECT SUM(order_value) AS total_value FROM inventory";
$result3 = $connection->query($sql3);
$row3 = $result3->fetch_assoc();
$orderValue = $row3['total_value'];

// 4️⃣ Average purchase order (per day)
$sql4 = "SELECT AVG(daily_purchase) AS avg_purchase FROM inventory";
$result4 = $connection->query($sql4);
$row4 = $result4->fetch_assoc();
$avgOrder = round($row4['avg_purchase']);
?>