<?php
// Assuming you have a connection to your database
include('db1.php');

// Fetch the pending building registration requests, including the uploaded file names
$sql = "SELECT * FROM buildings WHERE status = 'pending'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Pending Registration Requests</h2>";
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<tr>
            <th>Building Name</th>
            <th>Owner Name</th>
            <th>Building Type</th>
            <th>Description</th>
            <th>Registration date</th>
            <th>Address</th>
            <th>Email</th>
            <th>Aadhar Card</th>
            <th>Permit Certificate</th>
            <th>Completion Certificate</th>
            <th>Action</th>
          </tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['building_name'] . "</td>";
        echo "<td>" . $row['owner_name'] . "</td>";
        echo "<td>" . $row['building_type'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['registration_date'] . "</td>";
        echo "<td>" . $row['building_address'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        
        // Check if the uploaded files exist and display them
        echo "<td>";
        if (!empty($row['aadhar_card'])) {
            // Correct the file path by using a relative URL for the 'files' folder
            echo "<a href='" . $row['aadhar_card'] . "' target='_blank'>View Aadhar Card</a>";
        } else {
            echo "Not uploaded";
        }
        echo "</td>";

        echo "<td>";
        if (!empty($row['permit_certificate'])) {
            // Correct the file path for the permit certificate
            echo "<a href='" . $row['permit_certificate'] . "' target='_blank'>View Permit Certificate</a>";
        } else {
            echo "Not uploaded";
        }
        echo "</td>";

        echo "<td>";
        if (!empty($row['completion_certificate'])) {
            // Correct the file path for the completion certificate
            echo "<a href='" . $row['completion_certificate'] . "' target='_blank'>View Completion Certificate</a>";
        } else {
            echo "Not uploaded";
        }
        echo "</td>";
        
        // Action buttons to approve or reject
        echo "<td>";
        echo "<a href='update_status.php?id=" . $row['building_id'] . "&status=approved'>Approve</a> | ";
        echo "<a href='update_status.php?id=" . $row['building_id'] . "&status=rejected'>Reject</a>";
        echo "</td>";

        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "<p>No pending requests.</p>";
}

$conn->close();
?>








