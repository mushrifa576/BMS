<?php 
session_start();
// Check if the user is logged in (assuming session holds user_id) 
if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    // Redirect to login if not logged in
    exit();
}

// Database connection 
$servername = "localhost";
$username = "root"; // Your database username
$password = "mushri@2003"; // Your database password
$dbname = "buildingms"; // Database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT id, fullname, address, mob, dob, email, username FROM profiles WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $profile = $result->fetch_assoc();
} else {
    echo "No profile found for this user.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        /* Base styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Profile container */
        .profile-container {
            width: 80%;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Header styles */
        h2 {
            text-align: center;
            font-size: 2.5rem;
            color: #5d2f8e;
            margin-bottom: 20px;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px 20px;
            text-align: left;
            font-size: 1.1rem;
        }

        table th {
            background-color: #5d2f8e;
            color: white;
            font-weight: bold;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        table td {
            background-color: #f9f9f9;
            border-bottom: 1px solid #ddd;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        /* Edit Profile Button */
        .edit-btn {
            display: inline-block;
            background-color: #5d2f8e;
            color: white;
            padding: 12px 30px;
            font-size: 1.2rem;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .edit-btn:hover {
            background-color: #451c6a;
        }

        /* Footer styles */
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 0.9rem;
            color: #888;
        }
    </style>
</head>
<body>

    <div class="profile-container">
        <h2>User Profile</h2>
        <table>
            <tr>
                <th>Full Name</th>
                <td><?php echo htmlspecialchars($profile['fullname']); ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?php echo htmlspecialchars($profile['address']); ?></td>
            </tr>
            <tr>
                <th>Mobile</th>
                <td><?php echo htmlspecialchars($profile['mob']); ?></td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td><?php echo htmlspecialchars($profile['dob']); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars($profile['email']); ?></td>
            </tr>
            <tr>
                <th>Username</th>
                <td><?php echo htmlspecialchars($profile['username']); ?></td>
            </tr>
        </table>

        <a href="edit_profile.php" class="edit-btn">Edit Profile</a>
    </div>

    <div class="footer">
        <p>&copy; 2025 Building Management System. All rights reserved.</p>
    </div>

</body>
</html>



