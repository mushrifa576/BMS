<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome User</title>
    <style>
        body {
            background-image: url('img/img1.jpg'); /* Keeping your background */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Modern font */
            color: #FF0000; /* Red font color */
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
            font-size: 3rem; /* Larger font size */
            font-weight: 700; /* Bold text */
            text-shadow: 5px 5px 10px rgba(0, 0, 0, 0.6), 0 0 25px rgba(255, 0, 0, 0.7); /* 3D text shadow */
            color: #fff; /* White text color for contrast */
            letter-spacing: 3px; /* Added space between letters for a more impactful effect */
            margin-bottom: 20px;
        }

        p {
            font-size: 1.5rem;
            font-weight: 500;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.4); /* Light shadow for readability */
            color: #fff; /* White text for better contrast */
        }

        a {
            color: #FF0000; /* Red link color */
            text-decoration: none;
            font-size: 1.2rem;
            margin-top: 20px;
            display: inline-block;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        a:hover {
            text-decoration: underline;
            color: #cc0000; /* Darker red when hovering */
        }

        button {
            background-color: #FF0000;
            color: white;
            font-size: 1.3rem; /* Larger button text */
            border: none;
            padding: 15px 30px;
            margin: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            border-radius: 8px;
            font-weight: 600;
        }

        button:hover {
            background-color: #cc0000;
            transform: translateY(-3px); /* Subtle lift effect on hover */
        }

        button:active {
            transform: translateY(1px); /* Button pressed effect */
        }

        .button-container {
            margin-top: 30px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

    </style>
</head>
<body>
    <div>
        <h2>Welcome to the Building Management System</h2>
        <p>You are logged in as a user.</p>
        
        <div class="button-container">
            <button onclick="window.location.href='register_build.php'">Register Building</button>
            <button onclick="window.location.href='user_reg_update.php'">Update Registration</button>
            <button onclick="window.location.href='user_details1.php'">Profile Management</button>
            <button onclick="window.location.href='view_status.php'">Status</button>
        </div>

        <a href="logout1.php">Logout</a>
    </div>
</body>
</html>

