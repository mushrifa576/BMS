
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection (replace with your actual credentials)
    $servername = "localhost";
    $username = "root";
    $password = "mushri@2003"; // Update with your actual password
    $dbname = "buildingms"; // Replace with your actual database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Collect and sanitize form data
    $building_name = mysqli_real_escape_string($conn, $_POST['building_name']);
    $building_address = mysqli_real_escape_string($conn, $_POST['building_address']);
    $owner_name = mysqli_real_escape_string($conn, $_POST['owner_name']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $building_type = mysqli_real_escape_string($conn, $_POST['building_type']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // File upload handling
    $target_dir = "files/";  // Directory to save files
    $uploaded_files = [];

    // Function to handle file upload and return the file path
    function uploadFile($file, $target_dir) {
        $target_file = $target_dir . basename($file["name"]);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is a valid type (you can extend this list as needed)
        $allowed_types = ["jpg", "jpeg", "png", "pdf"];
        if (!in_array($file_type, $allowed_types)) {
            return "Invalid file type.";
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            return "File already exists.";
        }

        // Attempt to upload the file
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $target_file;  // Return file path if successful
        } else {
            return "Error uploading file.";
        }
    }

    // Handle file uploads and get their paths
    $aadhar_card = isset($_FILES['aadhar_card']) ? uploadFile($_FILES['aadhar_card'], $target_dir) : "";
    $permit_certificate = isset($_FILES['permit_certificate']) ? uploadFile($_FILES['permit_certificate'], $target_dir) : "";
    $completion_certificate = isset($_FILES['completion_certificate']) ? uploadFile($_FILES['completion_certificate'], $target_dir) : "";

    // Check if any file upload failed
    if (strpos($aadhar_card, 'Error') !== false || strpos($permit_certificate, 'Error') !== false || strpos($completion_certificate, 'Error') !== false) {
        $message = "Error in file upload. Please try again.";
        $messageType = "error";
    } else {
        // Prepare SQL statement with placeholders (using prepared statements to prevent SQL injection)
        $stmt = $conn->prepare("INSERT INTO buildings (building_name, building_address, owner_name, contact_number, building_type, email, description, aadhar_card, permit_certificate, completion_certificate)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind parameters (add file paths to the parameters)
        $stmt->bind_param("ssssssssss", $building_name, $building_address, $owner_name, $contact_number, $building_type, $email, $description, $aadhar_card, $permit_certificate, $completion_certificate);

        // Execute the statement and check for success
        if ($stmt->execute()) {
            $message = "Request submitted successfully!";
            $messageType = "success";
        } else {
            $message = "Error: " . $stmt->error;
            $messageType = "error";
        }

        // Close the statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
} else {
    $message = "Invalid request method.";
    $messageType = "error";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Building Registration Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            color: #333;
        }

        .message {
            font-size: 1.2rem;
            padding: 15px;
            margin-top: 20px;
            border-radius: 4px;
            text-align: center;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        button {
            background-color: #FF0000;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 20px;
            width: 100%;
            transition: background-color 0.3s ease;
            border-radius: 4px;
        }

        button:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Building Registration Status</h2>

        <div class="message <?php echo $messageType; ?>">
            <?php echo $message; ?>
        </div>

        <button onclick="window.location.href='user_dashboard.php'">Go Back to Form</button>
    </div>

</body>
</html>
