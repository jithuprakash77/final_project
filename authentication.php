
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

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve username and password from the form
        $enteredUsername = $_POST["user"];
        $enteredPassword = $_POST["pass"];

        // Perform a simple query to check if the username and password match
        $querys = "SELECT * FROM users WHERE username = '$enteredUsername' AND password = '$enteredPassword'";
       
        $results = mysqli_query($connection, $querys);

        if ($results) {
            // Check if a row was returned (login successful)
            if (mysqli_num_rows($results) > 0) {
               //echo "<script>alert('Login successfull');</script>";
            } else {
                echo "<script>alert('Login failed. Please check your username and password.'); window.location='login_phpsql.html';</script>";
            }

            // Free result set
            mysqli_free_result($results);
        } else {
            echo "Query failed: " . mysqli_error($connection);
        }
        session_start();
        $_SESSION['username'] = $enteredUsername; 
        if($enteredUsername == "admin") {
        //$sql = "SELECT id, username, date, eletricity_con, water_con, total_con, total_emmision, credit FROM consumption ";
        //$_SESSION['username'] = $enteredUsername; 
        echo"<script> window.location='dashboard1.php';</script>";
        }
        else {
        //$sql = "SELECT id, username, date, eletricity_con, water_con, total_con, total_emmision, credit FROM consumption WHERE username ='$enteredUsername'";
          // Always start the session first

            //$_SESSION['username'] = $enteredUsername; // Store in session
           // $_SESSION['role'] = $enteredUsername;
        echo"<script> window.location='user_transcation.php';</script>";
    }
 

    }

    // Close connection
    //mysqli_close($connection);
    ?>

  
    