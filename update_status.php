<?php
include('db1.php');

// Check if id and status are passed via GET
if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = (int) $_GET['id'];
    $status = $_GET['status'];

    // Handle the "approve" status
    if ($status === 'approved') {
        // Fetch necessary information from the buildings table
        $sql = "SELECT building_name, building_address, owner_name, contact_number, building_type, registration_date FROM buildings WHERE building_id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($building_name, $building_address, $owner_name, $contact_number, $building_type, $registration_date);
            $stmt->fetch();
            $stmt->close();

            // Generate a unique registration ID
            $registration_id = strtoupper(uniqid("KERALA_"));

            // Create a certificate content
            $certificate_content = "
            <html>
            <head>
                <title>Registration Certificate</title>
                <style>
                    body {
                        background-image: url('backg.png');
                        background-size: cover;
                        background-repeat: no-repeat;
                        background-attachment: fixed;
                        font-family: Arial, sans-serif;
                        padding: 100px;
                    }
                    .certificate {
                        /* Removed border */
                        padding: 100px;
                        background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white */
                        margin-top: 50px; /* Adjusted margin to push content down */
                    }
                    .header {
                        text-align: center;
                        margin-bottom: 20px;
                    }
                    .content p {
                        margin: 5px 0;
                    }
                </style>
            </head>
            <body>
                <div class='certificate'>
                    <div class='header'>
                        <h3>Government of Kerala</h3>
                        <h4>Building Registration Certificate</h4>
                    </div>
                    <div class='content'>
                        <p><strong>Registration ID:</strong> $registration_id</p>
                        <p><strong>Building Name:</strong> $building_name</p>
                        <p><strong>Building Address:</strong> $building_address</p>
                        <p><strong>Owner Name:</strong> $owner_name</p>
                        <p><strong>Contact Number:</strong> $contact_number</p>
                        <p><strong>Building Type:</strong> $building_type</p>
                        <p><strong>Registration Date:</strong> $registration_date</p>
                    </div>
                </div>
            </body>
            </html>";

            // Save the certificate as an HTML file in the 'certificates' folder
            $certificates_folder = 'certificates/';
            if (!is_dir($certificates_folder)) {
                mkdir($certificates_folder, 0777, true); // Create the folder if it doesn't exist
            }
            $certificate_file = $certificates_folder . $registration_id . ".html";
            file_put_contents($certificate_file, $certificate_content);

            // Store the certificate information in the certificates database
            $insert_sql = "INSERT INTO certificates (registration_id, building_id, file_path) VALUES (?, ?, ?)";
            if ($insert_stmt = $conn->prepare($insert_sql)) {
                $insert_stmt->bind_param("sis", $registration_id, $id, $certificate_file);
                $insert_stmt->execute();
                $insert_stmt->close();
            }

            // Update the building's status to "approved"
            $update_sql = "UPDATE buildings SET status = ? WHERE building_id = ? AND status = 'pending'";
            if ($update_stmt = $conn->prepare($update_sql)) {
                $update_stmt->bind_param("si", $status, $id);
                $update_stmt->execute();
                $update_stmt->close();
            }

            // Generate the download link for the certificate
            $download_link = $certificate_file;

            echo "Approved and certificate generated! <br>";
            echo "Click <a href='$download_link' download>here</a> to download the certificate.";
        }
    }

    // Handle the "reject" status
    elseif ($status === 'rejected') {
        header("Location: rejection_remarks.php?id=$id");
        exit;
    }
}

$conn->close();
?>






