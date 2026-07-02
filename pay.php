<?php
// pay.php

// Get building_id from the URL query string
if (isset($_GET['building_id'])) {
    $building_id = $_GET['building_id'];
} else {
    die("Building ID not provided.");
}

// Show the payment demo
echo "<h2>Online Payment Demo</h2>";
echo "<p>You are about to make a payment for your registration.</p>";

// Assuming a fixed amount for the demo
$amount = 1000; // example amount in currency
echo "<p><strong>Amount to Pay: ₹$amount</strong></p>";

// Form for payment simulation
echo '
<form action="proc_pay.php" method="POST">
    <input type="hidden" name="building_id" value="' . $building_id . '">
    <label for="card_number">Card Number:</label><br>
    <input type="text" id="card_number" name="card_number" required><br><br>
    
    <label for="expiry_date">Expiry Date:</label><br>
    <input type="text" id="expiry_date" name="expiry_date" required><br><br>

    <label for="cvv">CVV:</label><br>
    <input type="text" id="cvv" name="cvv" required><br><br>

    <input type="submit" value="Pay Now">
</form>


';
?>




