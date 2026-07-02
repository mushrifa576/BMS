<?php
session_start();
include('db1.php');

$error_message = ''; // Variable to store error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $profile_completed = $_POST['profile_completed'];
    
    // Query to fetch user details from users table
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $sql1 = "SELECT * FROM profiles WHERE username = ?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("s", $username);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    $user1 = $result1->fetch_assoc();


    // Check if user exists and the password is correct
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];  // Store user ID in session
        $_SESSION['username'] = $user['username'];  // Store username in session

        // Check if the user's profile is completed
        if ($user1['profile_completed'] == 0) {
            // If not, redirect to the profile completion page
            header("Location: profile.php");
            exit();  // Don't execute further code after redirect
        } else {
            // If profile is completed, redirect to the user dashboard
            header("Location: user_dashboard.php");
            exit();
        }
    } else {
        $error_message = "Invalid username or password."; // Set the error message
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
        body {

            background-image: url('img/abt.jpg'); /* Keeping your background */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;


            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            
        }

        h2 {
            color: #ffffff;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        form {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 1rem;
        }

        input[type="submit"] {
            background-color:rgb(24, 12, 199); /* Dark Blue */
            color: white;
            border: none;
            padding: 15px;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color:rgb(29, 17, 207); /* Darker Blue */
        }

        .error-message {
            color: red;
            font-size: 1.1rem;
            margin-top: 15px;
        }

        a {
            color:rgb(211, 201, 201);
            text-decoration: none;
            font-size: 1.1rem;
            margin-top: 20px;
            display: inline-block;
        }

        a:hover {
            text-decoration: underline;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

    </style>
</head>
<body>

    <div class="container">
        <h2>User Login</h2>
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>
            <input type="submit" value="Login">
            
            <?php if ($error_message): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
        </form>
        <a href="user_registration.php">Register as a new user</a>
    </div>

</body>
</html>
