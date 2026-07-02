<?php
include('db1.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['remarks'])) {
    $id = (int) $_POST['id'];
    $remarks = htmlspecialchars($_POST['remarks'], ENT_QUOTES, 'UTF-8'); // Sanitize input

    // Update the database with rejection remarks
    $sql = "UPDATE buildings SET status = 'rejected', remarks = ? WHERE building_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("si", $remarks, $id);

        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Building rejected with remarks: " . $remarks;
        }

        $stmt->close();
    }

    $conn->close();
} else {
    // Display the remarks form
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        echo "
        <form method='POST' action=''>
            <input type='hidden' name='id' value='$id'>
            <label for='remarks'>Enter Remarks:</label>
            <textarea name='remarks' id='remarks' required></textarea>
            <button type='submit'>Submit</button>
        </form>
        ";
    }
}
?>
