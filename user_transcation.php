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
session_start();

// if (isset($_SESSION['role'])) {
//     $enteredUsername = $_SESSION['role'];
// }
   $id = $_SESSION['username'];







?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <style>
    /* Extra styling for table */
  {
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
    <div class="container">
    
        <h1>Statement of account
        <p class="desc"></p>

        <!-- Stats Cards -->
        <div class="cards">
        <div class="card">
            <table>
                
<?php
    if ($id) {
    // Fetch specific user’s data from DB
    $sql = "SELECT id, username, area, date, eletricity_con, water_con, total_con, total_emmision, credit FROM consumption WHERE username ='$id'";
        
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
         //$row = mysqli_fetch_assoc($result);
          while ($row = mysqli_fetch_assoc($result)) {

             $supplyBelows = htmlspecialchars($row['username']);

             $area = htmlspecialchars($row['area']);

            // 2️⃣ Overall supply inventory

            $inventorys = htmlspecialchars($row['eletricity_con']);

            // 3️⃣ Open supply order value

            $orderValues = htmlspecialchars($row['water_con']);

            // 4️⃣ Average purchase order (per day)

            $avgOrders = htmlspecialchars($row['total_con']);

            $emissio = htmlspecialchars($row['total_emmision']);

            $credit = htmlspecialchars($row['credit']);
                    }
            
        }

        echo"<tr>
            <td><small>Representative</small></td> 
            <td>" . htmlspecialchars($supplyBelows) . "</td>
          </tr>";   
         echo"<tr>
            <td><small>Area</small></td> 
            <td>" . htmlspecialchars($area) . "</td>
          </tr>";    
          echo"<tr>
            <td><small>Electricity Consumption</small></td> 
            <td>" . htmlspecialchars($inventorys) . "</td>
        </tr>";
        echo"<tr>
            <td><small>Water Consumption</small></td> 
            <td>" . htmlspecialchars($orderValues) . "</td>
        </tr>";
         echo"<tr>
            <td><small>Total Consumption</small></td> 
            <td>" . htmlspecialchars($avgOrders) . "</td>
        </tr>";
         echo"<tr>
            <td><small>Total Emission</small></td> 
            <td>" . htmlspecialchars($orderValues) . "</td>
        </tr>";
         echo"<tr>
            <td><small>Credit</small></td> 
            <td>" . htmlspecialchars($credit) . "</td>
        </tr>";
}
?>
                
            
        </div>

        
        </div>   
</div>
<br
      

  <?php include 'splash_cursor.php'; ?>

  </body>
  </html>
  