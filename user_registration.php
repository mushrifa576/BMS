<?php
include('db1.php');

$registration_message = ''; // Variable to store the registration message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing password for security

    $sql = "INSERT INTO users (name, username, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $username, $password);
    $stmt->execute();

    $registration_message = "Registration successful! <a href='user_login1.php'>Login here</a>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #800080; /* Purple font color */
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            flex-direction: column; /* Align elements in column */
        }

        h2 {
            font-size: 2.5rem;
        }

        form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin-bottom: 20px; /* Adds space between form and message */
        }

        label {
            font-size: 1.1rem;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 1rem;
        }

        input[type="submit"] {
            background-color: #800080; /* Purple button */
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
            background-color: #6a006a; /* Darker purple on hover */
        }

        a {
            color: #800080; /* Purple link color */
            text-decoration: none;
            font-size: 1.1rem;
            margin-top: 20px;
            display: inline-block;
        }

        a:hover {
            text-decoration: underline;
        }

        .registration-message {
            font-size: 1.2rem;
            color: #800080;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div>
        <h2>Register</h2>
        <form method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required><br>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>
            <input type="submit" value="Register">
        </form>

        <?php if ($registration_message): ?>
            <div class="registration-message">
                <?php echo $registration_message; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
