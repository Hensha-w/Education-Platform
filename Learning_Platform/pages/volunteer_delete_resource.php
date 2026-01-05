<?php
session_start();

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "learning_platform");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$volunteerId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resource_id'])) {

    $resourceId = intval($_POST['resource_id']);

    // Fetch resource belonging to this volunteer
    $query = $conn->query("
        SELECT file_path 
        FROM resources 
        WHERE id = $resourceId AND volunteer_id = $volunteerId
    ");

    if ($query && $query->num_rows > 0) {

        $resource = $query->fetch_assoc();
        $filePath = $resource['file_path'];

        // Delete file from server
        if (!empty($filePath) && file_exists($filePath)) {
            unlink($filePath);
        }

        // Delete record from database
        $conn->query("
            DELETE FROM resources 
            WHERE id = $resourceId AND volunteer_id = $volunteerId
        ");
    }

    $conn->close();

    // Redirect back to volunteer profile
    header("Location: volunteer-profile.php?delete=success");
    exit;
}

// If accessed directly
header("Location: volunteer-profile.php");
exit;
?>