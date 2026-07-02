

    

<?php
// profile.php

// Start the session to get the current user information
session_start();

// Database credentials
$host = 'localhost';  // Change if needed
$username = 'root';   // Change if needed
$password = 'mushri@2003';       // Change if needed
$dbname = 'buildingms';

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in and has a valid session
if (!isset($_SESSION['username'])) {
    die("Error: User not logged in.");
}

// Get the logged-in user's username from the session
$user_username = $_SESSION['username'];

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get the form data
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $mob = mysqli_real_escape_string($conn, $_POST['mob']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    
    // Query to get the user id based on the username
    $sql = "SELECT id FROM users WHERE username = '$user_username' LIMIT 1";
    $result = $conn->query($sql);

    
    if ($result->num_rows > 0) {
        // Fetch the user id from the result
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
        
        // Insert the profile data into the profiles table using the user's id
       /* $query = "INSERT INTO profiles (id, fullname, address, dob, mob, email,username,) 
                       VALUES ('$user_id', '$fullname', '$address', '$dob', '$mob', '$email','$username')";
    */
    $query = "INSERT INTO profiles (id, fullname, address, dob, mob, email, username, profile_completed) 
          VALUES ('$user_id', '$fullname', '$address', '$dob', '$mob', '$email', '$username', true)";



        if ($conn->query($query) === TRUE) {
            // Redirect to user_dashboard.php after successful insertion
            header("Location: user_dashboard.php");
            exit(); // Ensure no further code is executed
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    } else {
        echo "Error: User not found in the database.";
    }
}

// Close the connection
$conn->close();
?>