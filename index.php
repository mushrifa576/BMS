<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Building Management System</title>
    <style>
        body {
            background-image: url('img/img3.jpg'); /* Keeping your background */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* More modern font */
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative; /* Added for overlay positioning */
        }
        
        /* Overlay to dull the background */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4); /* Semi-transparent black */
            z-index: -1; /* Ensure overlay stays behind content */
        }

        h2 {
            color: rgb(21, 6, 226); /* Darker shade of purple for better contrast */
            font-size: 3rem; /* Larger font size */
            font-weight: 700; /* Bold text */
            margin-bottom: 30px;
            text-align: center;
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.4), 0 0 25px rgba(255, 0, 255, 0.5); /* 3D effect with text shadow */
            letter-spacing: 2px; /* Slightly increase letter spacing for a more impactful look */
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        button {
            background-color: rgb(8, 6, 109); /* Dark Purple color */
            color: white;
            border: none;
            border-radius: 8px;
            padding: 15px 30px;
            font-size: 1.2rem;
            font-weight: 600; /* Slightly bolder text */
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        button:hover {
            background-color: rgb(43, 8, 126); /* Darker purple shade */
            transform: translateY(-3px); /* Adds a subtle lift effect */
        }

        button:active {
            transform: translateY(1px); /* Button pressed effect */
        }
    </style>
</head>
<body>
    <div>
        <h2>Building Management System</h2>

        <div class="button-container">
            <button onclick="window.location.href='user_login1.php'">User Login</button>
            <button onclick="window.location.href='admin_login1.php'">Admin Login</button>
        </div>
    </div>
</body>
</html>
