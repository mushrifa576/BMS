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

// SQL query to fetch registered users
$sql = "SELECT id, username FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            flex-direction: column;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            color: #FF0000;
            text-decoration: none;
            font-size: 1.1rem;
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            border: 2px solid #FF0000;
            border-radius: 5px;
            background-color: transparent;
        }

        a:hover {
            background-color: #FF0000;
            color: white;
        }

        .actions {
            display: flex;
            justify-content: space-around;
        }
    </style>
</head>
<body>

    <h2>Manage Registered Users</h2>

    <?php
    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>";

        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["username"] . "</td>
                    
                    <td class='actions'>
                        <a href='view_user.php?id=" . $row["id"] . "'>View</a>
                        <a href='edit_user.php?id=" . $row["id"] . "'>Edit</a>
                        <a href='delete_user.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                    </td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No users found.</p>";
    }

    $conn->close();
    ?>

    <a href="admin_dashboard.php">Back to Dashboard</a>

</body>
</html>
