<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
    <h2>User Registration Form</h2>
    <?php
    #რეგისტრაცია სტუდენტის მონაცემთა ბაზაში
    $host = "localhost";
    $db = "students";
    $user = "root";
    $pass = "";
    $conn = mysqli_connect($host, $user, $pass, $db);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate and sanitize input data
        $name = validate_input($_POST['name']);
        $age = validate_input($_POST['age']);
        $city = validate_input($_POST['city']);
        $password = validate_input($_POST['password']);

        // Check if username already exists
        $sql_check = "SELECT * FROM students WHERE name = '$name'";
        $result_check = mysqli_query($conn, $sql_check);

        if (mysqli_num_rows($result_check) > 0) {
            $error = "Username already exists.";
        } else {
            // Insert new user into the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql_insert = "INSERT INTO students (name, age, city, password) VALUES ('$name', $age, '$city', '$hashed_password')";
            
            if (mysqli_query($conn, $sql_insert)) {
                $success = "Registration successful!";
            } else {
                $error = "Error: " . mysqli_error($conn);
            }
        }
    }

    // Function to validate and sanitize input data
    function validate_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php endif; ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required><br><br>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
