<?php
// Include the database connection file (pdo.php)
include("pdo.php");

try {
    // SQL query to create the "autos" table if it doesn't already exist
    $sql = "CREATE TABLE IF NOT EXISTS autos (
        auto_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        make VARCHAR(128),
        year INTEGER,
        mileage INTEGER,
        seat_cap INTEGER,
        car_type VARCHAR(128),
        
        PRIMARY KEY (auto_id)
    ) ENGINE=InnoDB CHARSET=utf8";

    // Execute the SQL query to create the "autos" table
    $pdo->exec($sql);

    // Check if the "users" table exists and create it if needed
    $sql2 = "CREATE TABLE IF NOT EXISTS users (
        user_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        name VARCHAR(128),
        email VARCHAR(128),
        password VARCHAR(128),
        PRIMARY KEY (user_id)
    ) ENGINE=InnoDB CHARSET=utf8";

    // Execute the SQL query to create the "users" table
    $pdo->exec($sql2);

    // Insert a user into the "users" table
    $sql3 = "INSERT INTO users (name, email, password) VALUES ('rohan', 'rohanhoval007@gmail.com', 'rohan123')";
    
    // Execute the SQL query to insert the user
    $pdo->exec($sql3);

    // Display success message
    echo "<h2>Tables created successfully</h2>";
} catch (PDOException $error) {
    // Display an error message if an exception is thrown
    echo "<h2>Error has occurred:</h2>";
    echo "<p>" . $error->getMessage() . "</p>";
}
?>
