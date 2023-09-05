<?php
    $hostName = "localhost";
    $dbName = "misc";
    $userName = "rohan";
    $password = "rohan";

    try {
        $pdo = new PDO("mysql:host=$hostName;dbname=$dbName",$userName,$password);
        // set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "connection Successfully";
        
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>