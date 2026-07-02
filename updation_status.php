<?php
include('db1.php'); // Ensure you have the correct database connection

// Check if id and status are passed via GET
if (isset($_GET['id']) && isset($_GET['status'])) {
    // Sanitize inputs
    $id = (int) $_GET['id'];  // Ensure it's an integer to prevent SQL injection
    $status = $_GET['status'];

    // Validate the status (make sure it’s either 'approved' or 'rejected')
    if ($status === 'approved' || $status === 'rejected') {

        // Prepare the SQL query to update the building status
        $sql = "UPDATE update_requests SET status = ? WHERE building_id = ? AND status = 'pending'";

        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind the parameters ('s' for string, 'i' for integer)
            $stmt->bind_param("si", $status, $id);

            // Execute the query
            $stmt->execute();

            // Check if the update was successful
            if ($stmt->affected_rows > 0) {
                echo ucfirst($status) . " request successfully.";
            } else {
                // This will handle when no rows are updated (could be due to an incorrect 'pending' status)
                echo "No request found or status was already updated.";
            }

            // Close the prepared statement
            $stmt->close();
        } else {
            // If there is an issue with the SQL query
            echo "Error preparing query: " . $conn->error;
        }
    } else {
        echo "Invalid status.";
    }
} else {
    echo "Missing parameters (id or status).";
}

// Close the database connection
$conn->close();
?>
