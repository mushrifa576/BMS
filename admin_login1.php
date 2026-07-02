
<?php
session_start();
include('db1.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepare the SQL query to fetch the admin by username
    $sql = "SELECT * FROM admins WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    // Debugging: Check if the admin was found
    if ($admin) {
        echo "Admin found: " . $admin['username'] . "<br>";
    } else {
        echo "No admin found with this username.<br>";
    }

    // Debugging: Check the entered password and the stored hashed password
    if ($admin) {
        echo "Entered password: " . $password . "<br>";
        echo "Stored hashed password: " . $admin['password'] . "<br>";

        if ($password == $admin['password']) {
            echo "Password verification successful.<br>";
            $_SESSION['admin'] = $admin['username'];
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Password verification failed.<br>";
        }
        
    } else {
        echo "Admin not found, can't verify password.<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            background-image: url('img/abt.jpg'); /* Keeping your background */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        h2 {
            color: #ffffff;
            font-size: 2.5rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
        }

        form {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.6);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        label {
            font-size: 1.2rem;
            margin-bottom: 10px;
            display: block;
            text-align: left;
            color: #ffffff;
            font-weight: bold;
        }

        input[type="text"], input[type="password"] {
            width: 90%;
            padding: 8px 12px; /* Reduced padding for compact fields */
            margin: 10px 0;
            border-radius: 20px; /* Slightly smaller curves */
            border: 1px solid rgba(255, 255, 255, 0.7);
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            font-size: 0.9rem; /* Reduced font size */
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            border: 1px solid #4caf50;
            box-shadow: 0 0 10px rgba(76, 175, 80, 0.8);
            outline: none;
        }

        input[type="submit"] {
            background: linear-gradient(90deg, #4caf50, #388e3c);
            color: #ffffff;
            padding: 12px 15px; /* Reduced padding for smaller button */
            border-radius: 20px;
            border: none;
            font-size: 1rem; /* Slightly smaller font size */
            font-weight: bold;
            cursor: pointer;
            width: 90%; /* Matches text fields' width */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="submit"]:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(76, 175, 80, 0.6);
        }

        p.error-message {
            color: red;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div>
        <h2>Admin Login</h2>
        <?php
        // Display error message only if login fails
        if (!empty($error_message)) {
            echo "<p class='error-message'>$error_message</p>";
        }
        ?>
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
