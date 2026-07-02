<?php
include('db1.php');
session_start();

// Ensure session_start() is successful
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Ensure the session variable 'user_id' is set
if (!isset($_SESSION['user_id'])) {
    die("User ID not found in session.");
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];  

// Ensure database connection is successful before using it
if (!$conn) {
    die("Database connection failed.");
}

// Retrieve building_id from the database based on user_id
$sql = "SELECT building_id FROM buildings WHERE building_id = ?";
$stmt = $conn->prepare($sql);

// Check if prepare was successful
if ($stmt === false) {
    die("Error preparing SQL statement.");
}

$stmt->bind_param("i", $user_id);  // "i" stands for integer

// Execute the statement
if (!$stmt->execute()) {
    die("Error executing SQL statement.");
}

$result = $stmt->get_result();

// Check if a result is found
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $building_id = $row['building_id'];
} else {
    die("No building ID found for this user ID.");
}

$stmt->close();

// Check if building_id is valid (integer)
if (!is_numeric($building_id)) {
    die("Invalid building ID.");
}

// Use a prepared statement to get the registration status for the building
$sql = "SELECT status,remarks FROM buildings WHERE building_id = ?";
$stmt = $conn->prepare($sql);

// Check if prepare was successful
if ($stmt === false) {
    die("Error preparing SQL statement.");
}

$stmt->bind_param("i", $building_id);  // "i" stands for integer

// Execute the statement for the building status
if (!$stmt->execute()) {
    die("Error executing SQL statement.");
}

$result = $stmt->get_result();

// Check if a result is found
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h2>Your Registration Status: </h2>";
    echo "<p>Status: " . htmlspecialchars($row['status']) . "</p>";  // Prevent XSS by using htmlspecialchars
    echo "<p>Remarks: " . htmlspecialchars($row['remarks']) . "</p>"; // Sanitize output to prevent XSS

} else {
    die("No registration found for this building ID.");
}

$stmt->close();  // Close the prepared statement
$conn->close();  // Close the database connection
?>
