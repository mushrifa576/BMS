<?php
// Include the database connection file (adjust path as needed)
include('db1.php');  // You'll need a file with your DB connection details

// Create the SQL query to fetch data from 'users' and 'profiles' tables
$query = "
   SELECT  u.username,  p.fullname, p.address, p.mob, p.dob, p.email 
    FROM users u
    JOIN profiles p ON u.id = p.id
";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query was successful
if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

// Fetch the data as an associative array
$userDetails = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #FF0000;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .container {
            width: 100%;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        a {
            color: #FF0000;
            text-decoration: none;
            font-size: 1.1rem;
            display: inline-block;
            margin-top: 20px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Details</h2>

        <?php if (empty($userDetails)): ?>
            <p>No user details found.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>DOB</th>
                        <th>Phone Number</th>
                        <th>Username</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userDetails as $user): ?>
                        <tr>
                            <td><?php echo $user['fullname']; ?></td>
                            <td><?php echo $user['address']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['dob']; ?></td>
                            <td><?php echo $user['mob']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <a href="admin_dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>