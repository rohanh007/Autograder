<head>
    <title>Rohan Hoval</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
        // Include the database connection file (pdo.php)
        include("pdo.php");

        // Check if the email and password have been submitted
        if ( isset($_POST['email']) && isset($_POST['password'])  ) {

            // Check if either the email or password is empty
            if($_POST['email'] == "" || $_POST['password'] == "") {
                echo '<p style="color: red">Username and password are required</p>';   
            } 
            // Check if the email contains an "@" character
            elseif (strpos($_POST['email'], '@') == false) {
                    echo '<p style="color: red">Email must have an at-sign (@)</p>';  
            } else {
                // SQL query to select the user's name based on email and password
                $sql = "SELECT name FROM users 
                WHERE email = :em AND password = :pw";

                // Prepare and execute the SQL query with placeholders
                $stmt = $pdo->prepare($sql);
                
                $stmt->execute(array(
                    ':em' => $_POST['email'], 
                    ':pw' => $_POST['password']));
                
                // Fetch the result as an associative array
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // If no matching user is found
                if ( $row === FALSE ) {
                    // Log the login failure
                    $hash = hash('sha256', $_POST['password']);
                    error_log("Login fail ".$_POST['email']." $hash");
                    echo "<p style='color: red'>Incorrect password</p>";
                } else { 
                    // Log the login success
                    error_log("Login success ".$_POST['email']);
                    echo "<p>Login successful.</p>\n";
                    // Redirect to another page with the user's email as a parameter
                    header("Location: autos.php?name=".urlencode($_POST['email']));
                }
            }
        }
    ?>

    <form method="post">
     <h1 >Log In</h1>
        <p >Email:
            <input type="text" size="45" name="email" placeholder='xyz@email.com'>
        </p>
        <p>Password:
            <input type="text" size="45" name="password" placeholder="********">
        </p>
        <p>
            <input type="submit" value="Log In" class="button" />
            <br>
            <!-- Refresh the page by linking to itself -->
            <a href="<?php echo($_SERVER['PHP_SELF']);?>">Refresh</a>
        </p>
    </form>
</body>
