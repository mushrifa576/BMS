<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Admin</title>
    <style>
        body {
            background-image: url('img/img1.jpg'); /* Keeping your background */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Arial', sans-serif;
            color:rgb(255, 0, 0); /* Dark blue for text */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            flex-direction: column;
        }

        h2 {
            font-size: 3rem;
            text-shadow: 3px 3px 6px rgba(245, 21, 21, 0.93); /* 3D effect for the header text */
            margin-bottom: 20px;
            color:rgb(255, 1, 1); /* Dark blue */
        }

        p {
            font-size: 1.5rem;
            text-shadow: 2px 2px 4px rgb(255, 0, 0); /* 3D effect for the paragraph text */
            margin-bottom: 20px;
            color: #4F6C8B; /* Lighter shade of blue */
        }

        a {
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
            margin-top: 20px;
            display: inline-block;
            padding: 12px 24px;
            border: 2px solid #003366; /* Dark blue for the border */
            border-radius: 10px;
            background: linear-gradient(145deg, #1E3A5F, #003366); /* Gradient for buttons */
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); /* 3D effect for the button */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        a:hover {
            background: linear-gradient(145deg, #003366, #1E3A5F); /* Reverse the gradient on hover */
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.4); /* Stronger shadow for hover */
            transform: translateY(-3px); /* Lift effect when hovered */
        }

        .buttons {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Adjusts the buttons dynamically */
            gap: 20px;
            width: 100%;
            margin-top: 20px;
        }

        .buttons a {
            text-align: center;
        }

        .logout {
            margin-top: 30px;
            font-size: 1.2rem;
            padding: 10px 20px;
            border-radius: 10px;
            background: linear-gradient(145deg, #1E3A5F, #003366);
            color: white;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .logout:hover {
            background: linear-gradient(145deg, #003366, #1E3A5F);
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.4);
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <div>
        <h2>Welcome to the Building Management System</h2>
        <p>You are logged in as an admin.</p>
        <div class="buttons">
            <a href="user_details.php">User Details</a>
            <a href="registered_buildings.php">Registered Buildings</a>
            <a href="rejected_buildings.php">Rejected Buildings</a>
            <a href="manage_users.php">Manage Users</a>
            <a href="manage_reg.php">Manage Registrations</a>
            <a href="admin_manage_updates.php">Manage Updations</a>
            <a href="manage_payments.php">Manage Payments</a>
        </div>
        <a href="logout1.php" class="logout">Logout</a>
    </div>
</body>
</html>

