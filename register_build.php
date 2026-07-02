
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Building Registration</title>
   
    <style>
    /* Your existing styles */
    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    input[type="text"], input[type="email"], input[type="tel"], input[type="number"], textarea, select, input[type="file"] {
        width: 80%;
        padding: 6px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 1rem;
    }

    /* Optional: Style for file input */
    input[type="file"] {
        padding: 5px;
    }

    /* Add background image styling */
    .container {
        background-image: url('img/.jpg'); /* Add your background image */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        padding: 20px;
        border-radius: 10px; /* Optional: to make it look stylish */
    }
</style>

</head>
<body>

    <div class="container">
        <h2>Register Building</h2>
            
        <form action="submit_building_registration.php" method="POST" id="building-registration-form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="building_name">Building Name:</label>
                <input type="text" id="building_name" name="building_name" required>
            </div>
            <div class="form-group">
                <label for="building_address">Building Address:</label>
                <input type="text" id="building_address" name="building_address" required>
            </div>
            <div class="form-group">
                <label for="owner_name">Owner Name:</label>
                <input type="text" id="owner_name" name="owner_name" required>
            </div>
            <div class="form-group">
                <label for="contact_number">Contact Number:</label>
                <input type="tel" id="contact_number" name="contact_number" required>
            </div>
            <div class="form-group">
                <label for="building_type">Building Type:</label>
                <select id="building_type" name="building_type" required>
                    <option value="" disabled selected>Select Building Type</option>
                    <option value="residential">Residential</option>
                    <option value="commercial">Commercial</option>
                    <option value="industrial">Industrial</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="description">Description of the Building:</label>
                <textarea id="description" name="description" required></textarea>
            </div>


            <!-- New document upload fields -->
            <div class="form-group">
                <label for="aadhar_card">Upload Aadhar Card:</label>
                <input type="file" id="aadhar_card" name="aadhar_card" accept=".pdf, .jpg, .jpeg, .png" required>
                <small>Accepted formats: .pdf, .jpg, .jpeg, .png</small>
            </div>

            <div class="form-group">
                <label for="permit_certificate">Upload Permit Certificate:</label>
                <input type="file" id="permit_certificate" name="permit_certificate" accept=".pdf, .jpg, .jpeg, .png" required>
                <small>Accepted formats: .pdf, .jpg, .jpeg, .png</small>
            </div>

            <div class="form-group">
                <label for="completion_certificate">Upload Completion Certificate:</label>
                <input type="file" id="completion_certificate" name="completion_certificate" accept=".pdf, .jpg, .jpeg, .png" required>
                <small>Accepted formats: .pdf, .jpg, .jpeg, .png</small>
            </div>

            <!-- Submit button -->
            <button type="submit" id="submit-button">Apply for Registration</button>
        </form>

        <div class="alert-message" id="alert-message"></div>

        <div class="error-message" id="error-message"></div>
    </div>

    <script>
        // Remove the payment validation or payment-related logic
        document.getElementById('building-registration-form').addEventListener('submit', function(event) {
            // No need for payment checks, just submit the form
            // You can add further form validation here if needed
        });
    </script>

    <a href="user_dashboard.php" id="back-to-dashboard">Back to Dashboard</a>
   

</body>
</html>
