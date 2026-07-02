<?php
// submit_payment.php
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    // Database connection
    $conn = new mysqli("localhost", "username", "password", "database");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $owner_name = $conn->real_escape_string($data['owner_name']);
    $building_name = $conn->real_escape_string($data['building_name']);
    $building_type = $conn->real_escape_string($data['building_type']);
    $payment_status = $conn->real_escape_string($data['payment_status']);
    $registration_fee = $conn->real_escape_string($data['registration_fee']);
    $payment_data = $conn->real_escape_string($data['payment_data']);

    $sql = "INSERT INTO payments (owner_name, building_name, building_type, payment_status, registration_fee, payment_data)
            VALUES ('$owner_name', '$building_name', '$building_type', '$payment_status', '$registration_fee', '$payment_data')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Payment data saved successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error saving payment data: " . $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid data received"]);
}
?>
