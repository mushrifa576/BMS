<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: user_login.php');
    exit();
}

require_once 'db1.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $user_id = $_POST['user_id'];
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $mob = $_POST['mob'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL query to update user details
    $query = "UPDATE users SET fullname = ?, address = ?, dob = ?, mob = ?, email = ?, username = ?";

    // If a new password is provided, hash it and include it in the query
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query .= ", password = ?";
        $stmt = $conn->prepare($query . " WHERE id = ?");
        $stmt->bind_param("sssssssi", $fullname, $address, $dob, $mob, $email, $username, $hashed_password, $user_id);
    } else {
        $stmt = $conn->prepare($query . " WHERE id = ?");
        $stmt->bind_param("ssssssi", $fullname, $address, $dob, $mob, $email, $username, $user_id);
    }

    // Execute the update query
    if ($stmt->execute()) {
        // Redirect back to profile page with success message
        $_SESSION['message'] = "Profile updated successfully!";
        header('Location: profile.php');
    } else {
        // Error handling
        $_SESSION['error'] = "Error updating profile.";
        header('Location: profile_management.php');
    }
}
?>
