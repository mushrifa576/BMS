<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "mushri@2003";
$dbname = "buildingms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_GET['id']; // Get the user ID from the URL

// SQL query to fetch user details
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>
</head>
<body>

    <h2>User Details</h2>

    <?php if ($user): ?>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <p><strong>Password:</strong> <?php echo htmlspecialchars($user['password']); ?></p>
        
        <a href="manage_users.php">Back to User Management</a>
    <?php else: ?>
        <p>User not found.</p>
    <?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>
