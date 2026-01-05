<?php
session_start();

$role = $_SESSION['role'] ?? null;
if (!$role || $role !== "volunteer") {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Approval Pending</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow text-center">
        <h1 class="text-2xl font-bold text-blue-700 mb-4">Volunteer Account Pending Approval</h1>
        <p class="text-gray-700">Your documents have been submitted. An admin will review and approve your account shortly.</p>
        <p class="mt-4 text-gray-500 text-sm">Please check back later. Thank you for your patience.</p>
    </div>
</body>
</html>