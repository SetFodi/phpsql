<!DOCTYPE html>
<html>
<head>
    <title>Create and Write to Text File</title>
</head>
<body>
    <h2>Create and Write to Text File</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="fileName">File Name:</label>
        <input type="text" id="fileName" name="fileName" required><br><br>

        <label for="content">Content:</label><br>
        <textarea id="content" name="content" rows="5" cols="40" required></textarea><br><br>

        <input type="submit" value="Create File">
    </form>

    <?php
    #აკეთებს საიტზე txt ფაილს და შიგნით წერ რასაც გინდა
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fileName = $_POST['fileName'];
        $content = $_POST['content'];

        $file = fopen($fileName . ".txt", "w");

        if ($file) {
            fwrite($file, $content);
            fclose($file);
            echo "File '$fileName.txt' created and content written successfully.";
        } else {
            echo "Error opening file or file could not be created.";
        }
    }
    ?>
</body>
</html>
