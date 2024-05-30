<?php
#სესიების გამოყენება
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verify username and password (dummy validation for example)
    #ეს ამ მაგალითისთვის ლოგინი და პაროლი
    if ($username === 'luka' && $password === 'secret') {
        // Set session variables
        $_SESSION['username'] = $username;

        // Redirect to a welcome page after successful login
        header("Location: welcome.html");
        exit();
    } else {
        // Display error message
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
</head>
<body>
    <h2>Login Form</h2>
    <?php if(isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
