





<?php
session_start(); // Start the session

// Database connection
$servername = "localhost";
$username = "root";
$password = "mushri@2003"; 
$dbname = "buildingms"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$building_id = $building_name = $owner_name = $email = $contact_number = "";

// Check if user is logged in and 'user_id' is set in the session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Query to fetch building_id based on logged-in user's user_id
    $sql = "SELECT id FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Failed to prepare statement - " . $conn->error);
    }

    $stmt->bind_param("i", $user_id); // Assuming 'user_id' is an integer
    $stmt->execute();
    $stmt->bind_result($building_id);
    $stmt->fetch();
    $stmt->close(); // Close the prepared statement

    // If no building_id found, show message and exit
    if (!$building_id) {
        echo "No building found for the logged-in user!";
        exit;
    }

    // Query to fetch building details based on 'building_id'
    $sql = "SELECT * FROM buildings WHERE building_id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Failed to prepare statement - " . $conn->error);
    }

    $stmt->bind_param("i", $building_id); // Assuming 'building_id' is an integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch data from the result
        $row = $result->fetch_assoc();
        $building_name = $row['building_name'];
        $owner_name = $row['owner_name'];
        $email = $row['email'];
        $contact_number = $row['contact_number'];
    } else {
        // Show message if no building found
        echo "No building found with that ID!";
        exit;
    }

    $stmt->close(); // Close the prepared statement
} else {
    echo "User not logged in! Please log in to continue.";
    exit;  // Stop execution if user is not logged in
}

// Check if form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $building_name = mysqli_real_escape_string($conn, $_POST['building_name']);
    $owner_name = mysqli_real_escape_string($conn, $_POST['owner_name']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Prepare SQL to update building data
    $update_sql = "UPDATE buildings SET building_name = ?, owner_name = ?, contact_number = ?, email = ? WHERE building_id = ?";
    $stmt = $conn->prepare($update_sql);

    if (!$stmt) {
        die("Failed to prepare update statement - " . $conn->error);
    }

    $stmt->bind_param("sssss", $building_name, $owner_name, $contact_number, $email, $building_id);

    if ($stmt->execute()) {
        $message = "Building information updated successfully!";
        $messageType = "success";

        // Insert updated information into update_requests table
        $insert_sql = "INSERT INTO update_requests (building_id, building_name, owner_name, contact_number, email, updated_at) VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($insert_sql);

        if (!$stmt) {
            die("Failed to prepare insert statement - " . $conn->error);
        }

        $stmt->bind_param("sssss", $building_id, $building_name, $owner_name, $contact_number, $email);

        if (!$stmt->execute()) {
            $message = "Error: " . $stmt->error;
            $messageType = "error";
        }
    } else {
        $message = "Error: " . $stmt->error;
        $messageType = "error";
    }

    $stmt->close(); // Close the prepared statement
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Building Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        .message {
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 4px;
        }
        .success {
            background-color: #dff0d8;
            color: #3c763d;
        }
        .error {
            background-color: #f2dede;
            color: #a94442;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Update Building Information</h1>

        <?php if (isset($message)) { ?>
            <div class="message <?php echo $messageType; ?>">
                <?php echo $message; ?>
            </div>
        <?php } ?>

        <!-- Form to update building information -->
        <form action="user_reg_update.php" method="POST">
            <input type="hidden" name="building_id" value="<?php echo $building_id; ?>" required readonly>
            <div class="form-group">
                <label for="building_name">Building Name:</label>
                <input type="text" name="building_name" value="<?php echo $building_name; ?>" required>
            </div>
            <div class="form-group">
                <label for="owner_name">Owner Name:</label>
                <input type="text" name="owner_name" value="<?php echo $owner_name; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="form-group">
                <label for="contact_number">Contact Number:</label>
                <input type="text" name="contact_number" value="<?php echo $contact_number; ?>" required>
            </div>
            <button type="submit">Submit Update Request</button>
        </form>
    </div>

</body>
</html>

