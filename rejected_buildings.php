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

// SQL query to fetch approved buildings
$sql = "SELECT * FROM buildings WHERE status = 'rejected'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Buildings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
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
    </style>
</head>
<body>

    <h2>Registered Buildings - Rejected</h2>

    <?php
    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Building Name</th>
                    <th>Address</th>
                    <th>Owner name</th>
                    <th>Contact number</th>
                    <th>Building type</th>
                    <th>Registration date</th>
                </tr>";

        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["building_id"] . "</td>
                    <td>" . $row["building_name"] . "</td>
                    <td>" . $row["building_address"] . "</td>
                    <td>" . $row["owner_name"] . "</td>
                    <td>" . $row["contact_number"] . "</td>
                    <td>" . $row["building_type"] . "</td>
                    <td>" . $row["registration_date"] . "</td>
                    
                    

                   
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No rejected buildings found.</p>";
    }

    $conn->close();
    ?>

    <a href="admin_dashboard.php">Back to Dashboard</a>

</body>
</html>
