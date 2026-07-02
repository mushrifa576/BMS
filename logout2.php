<?php
// Start the session
session_start();

// Destroy session variables
session_unset();
session_destroy();

// Optionally, also remove the session cookie by setting its expiry time to past
setcookie(session_name(), '', time() - 3600, '/');

// Redirect to login or dashboard page
header("Location: user_dashboard.php");
exit();
?>
