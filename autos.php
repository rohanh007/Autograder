
<html>

<head>
    <title>Rohan Hoval</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 1300px; 
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <?php
        // Include the database connection file (pdo.php)
        include("pdo.php");

        // Check if the 'name' parameter is provided in the URL
        if (isset($_GET['name'])) {
            echo '<h1>Tracking Autos for ' . $_GET['name'] . '</h1>';
        } else {
            // If 'name' parameter is missing, display an error message and stop script execution
            die("Name parameter missing");
        }

        // Check if the 'logout' button is clicked
        if(isset($_POST['logout'])) {
            // Redirect to the index.php page upon logout
            header('Location: index.php');
        } else {
            // Check if the 'make', 'year', and 'mileage' fields are provided via POST
            if(isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage']) && isset($_POST['seat_cap'])  && isset($_POST['car_type'])) {
                // Check if 'make' is empty
                if ($_POST['make'] == "") {
                    echo "<p style='color: red'>Make is required</p>";
                } elseif (is_numeric($_POST['year']) && is_numeric($_POST['mileage'])) {
                    // Prepare and execute an SQL INSERT query to add a new automobile record
                    $stmt = $pdo->prepare('INSERT INTO autos (make, year, mileage , seat_cap ,car_type) VALUES (:mk, :yr, :mi , :sc, :ct)');
                    $stmt->execute(array(
                        ':mk' => $_POST['make'],
                        ':yr' => $_POST['year'],
                        ':mi' => $_POST['mileage'],
                        ':sc' => $_POST['seat_cap'],
                        ':ct' => $_POST['car_type'])
                    );

                    // Display a success message
                    echo "<p style='color: green'>Record inserted</p>";
                } else {
                    // Display an error if 'mileage' or 'year' is not numeric
                    echo "<p style='color: red'>Mileage and year must be numeric</p>";   
                }
            }   
        }
    ?>

    <!-- HTML form for adding automobiles -->
    <form method="post" class="form" style="margin-top: 50px">
        <p>Model_Name:
            <input type="text" size="45" name="make" placeholder="xyz...">
        </p>
        <p>Year :
            <input type="text" size="45" name="year" placeholder="yyyy">
        </p>
        <p>Mileage:
            <input type="text" size="45" name="mileage" placeholder="nn">
        </p>
        <p>seating_capacity:
            <input type="text" size="45" name="seat_cap" placeholder="nn">
        </p>
        <p>car_type:
            <input type="text" size="45" name="car_type" placeholder=" ">
        </p>
        <p>
            <input type="submit" value="Add" name="Add" class="button" />
            <input type="submit" value="logout" name="logout" class="button" />
        </p>
    </form>

    <h2>Automobiles</h2>
    <table>
    <thead>
        <tr>
            <th>Year</th>
            <th>Make</th>
            <th>Mileage</th>
            <th>seating_capacity</th>
            <th>Car_type</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Retrieve and display automobile records from the database
        $statement = $pdo->query("SELECT auto_id, make, year, mileage ,seat_cap,car_type FROM autos");

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['year'] . "</td>";
            echo "<td>" . htmlentities($row['make']) . "</td>";
            echo "<td>" . $row['mileage'] . "</td>";
            echo "<td>" . htmlentities($row['seat_cap'] ). "</td>";
            echo "<td>" .htmlentities($row['car_type']) . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

</body>

</html>
