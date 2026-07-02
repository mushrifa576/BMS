<?php
// payment_processing.php

// Get the form data
$building_id = $_POST['building_id'];
$card_number = $_POST['card_number'];
$expiry_date = $_POST['expiry_date'];
$cvv = $_POST['cvv'];

// Simulate payment processing (You could add real payment logic here)
$payment_success = true; // Assuming payment is always successful in this demo

if ($payment_success) {
    // Update the building status to "paid" or "certificate generated"
    include('db1.php');
    
    $sql = "UPDATE buildings SET status = 'paid' WHERE building_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $building_id);
    $stmt->execute();
    
    // Generate certificate download link
    $certificate_url = "certificates/{$building_id}_certificate.html"; // Update with correct certificate path

    echo "<h2>Payment Successful!</h2>";
    echo "<p>Your payment was successful. You can download your certificate now:</p>";
    echo "<a href='$certificate_url' download>Download Certificate</a>";
    
    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "<h2>Payment Failed</h2>";
    echo "<p>There was an error processing your payment. Please try again later.</p>";
}
?>






