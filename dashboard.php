<?php
    // Database connection parameters
    include 'authentication.php';
    session_start();

if (isset($_SESSION['username'])) {
    $enteredUsername = $_SESSION['username'];
    //echo "Welcome, " . htmlspecialchars($enteredUsername);
}
// 1️⃣ Supply below safety stock
$sql1 = "SELECT COUNT(*) AS below_count FROM consumption";
$result1 = $connection->query($sql1);
$row1 = $result1->fetch_assoc();
$supplyBelow = $row1['below_count'];

// 2️⃣ Overall supply inventory
$sql2 = "SELECT SUM(eletricity_con) AS total_stock FROM consumption";
$result2 = $connection->query($sql2);
$row2 = $result2->fetch_assoc();
$inventory = $row2['total_stock'];

// 3️⃣ Open supply order value
$sql3 = "SELECT SUM(water_con) AS total_value FROM consumption";
$result3 = $connection->query($sql3);
$row3 = $result3->fetch_assoc();
$orderValue = $row3['total_value'];

// 4️⃣ Average purchase order (per day)
$sql4 = "SELECT AVG(total_emmision) AS avg_purchase FROM consumption";
$result4 = $connection->query($sql4);
$row4 = $result4->fetch_assoc();
$avgOrder = round($row4['avg_purchase']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      background-color: #75748bff;
      color: #ddd;
      min-height: 100vh;
      justify-content: center;
    }

    /* Top Navbar */
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #1b1b1f;
      padding: 10px 20px;
    }

    .logo {
      font-weight: 600;
      color: #fff;
      font-size: 18px;
    }

    nav a {
      color: #ccc;
      text-decoration: none;
      margin: 0 50px;
      font-size: 14px;
      align-items: center;
    }

    nav a:hover {
      color: #fff;
    }

    .user-info {
      display: flex;
      align-items: center;
      gap: 10px;
      color: #ccc;
      font-size: 14px;
    }

    /* Dashboard section */
    .container {
      padding: 20px;
    }

    .breadcrumbs {
      font-size: 14px;
      color: #888;
      margin-bottom: 8px;
    }

    h1 {
      font-size: 24px;
      margin-bottom: 6px;
    }

    p.desc {
      color: #aaa;
      margin-bottom: 25px;
    }

    /* Stats cards */
    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 15px;
    }

    .card {
      background: #1c1c21;
      border-radius: 6px;
      padding: 20px;
      position: relative;
      justify-content: center;
    }

    .card small {
      color: #999;
      font-size: 13px;
    }

    .card h2 {
      margin-top: 10px;
      font-size: 28px;
      color: #fff;
    }

    /* Table section */
    .table-section {
      margin-top: 40px;
      background: #1b1b1f;
      border-radius: 6px;
      padding: 20px;
      justify-content: center;
    }

    .table-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
    }

    .table-header h3 {
      font-size: 18px;
    }

    .table-header button {
      background: #0078ff;
      color: #fff;
      border: none;
      border-radius: 4px;
      padding: 8px 16px;
      cursor: pointer;
      font-weight: 500;
    }

    .table-header button:hover {
      background: #005fcc;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      text-align: left;
      padding: 10px;
      border-bottom: 1px solid #2a2a2f;
    }

    th {
      color: #aaa;
      font-weight: 500;
    }

    td a {
      color: #4da6ff;
      text-decoration: none;
    }

    td a:hover {
      text-decoration: underline;
    }

    td.on {
      color: #00ff88;
    }

    td.off {
      color: #ff3c3c;
    }

    @media (max-width: 768px) {
      .cards { grid-template-columns: 1fr; }
    }
  </style>
</head>

<body>

  <header>
    <div class="logo">EcoVision</div>
    <nav>

      <a href="#">Menu</a>
      <a href="#">More</a>
    </nav>
    <div class="user-info">
      <span><?php echo htmlspecialchars("$enteredUsername"); ?></span>
    </div>
  </header>

  <div class="container">
    
    <h1>Dashboard</h1>
    <p class="desc">Description of dashboard view goes here.</p>

    <!-- Stats Cards -->
 

    <!-- Orders Table -->
    <div class="table-section">
      <div class="table-header">
        <h3>Orders</h3>
       
      </div>

      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Area </th>
          </tr>
        </thead>
<?php

   
    // Check if the form is submitted
    
        $sql = "SELECT id, username, area FROM consumption WHERE username ='$enteredUsername'";
        
        $results = mysqli_query($connection, $sql);
        if (mysqli_num_rows($results) > 0) {
         //$row = mysqli_fetch_assoc($result);
          while ($row = mysqli_fetch_assoc($results)) {

             echo "<tr onclick=\"window.location.href='transcation.php?id=" . htmlspecialchars(urlencode($row['id'])) . "'\">;
                      <td>" . $row['id'] . "</td>
                      <td>" . htmlspecialchars($row['username']) . " </td>
                      
                        <td>" . htmlspecialchars($row['area']) . "</td>
                    </tr>";
          }
      } else {
          //echo "<tr><td colspan='3'>No users found</td></tr>";
      }

    

    // Close connection
    mysqli_close($connection);
    ?>
      </table>
    </div>
  </div>

    <?php include 'splash_cursor.php'; ?>

</body>
</html>
