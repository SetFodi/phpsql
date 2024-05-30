<?php
# ეს კოდი არის იმისთვის რომ გამოიტანოს სტუდენტების ბაზა
$host = "localhost";
$db = "students";
$user = "root";
$pass = "";

// Create connection
$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize an array to store student data
$students = array();

// Fetch data from students table
$sql = "SELECT studentsID, name, age, city FROM students";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Store each row of data in the $students array
    while($row = mysqli_fetch_assoc($result)) {
        $students[] = $row;
    }
} else {
    echo "No records found.";
}

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Students List</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 18px;
            text-align: left;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>List of Students</h2>
    <?php if (!empty($students)): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>City</th>
            </tr>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo htmlspecialchars($student['studentsID']); ?></td>
                    <td><?php echo htmlspecialchars($student['name']); ?></td>
                    <td><?php echo htmlspecialchars($student['age']); ?></td>
                    <td><?php echo htmlspecialchars($student['city']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No students found.</p>
    <?php endif; ?>
</body>
</html>
