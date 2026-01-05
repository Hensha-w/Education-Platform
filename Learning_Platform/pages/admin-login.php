<?php
session_start();
$conn = new mysqli("localhost", "root", "", "learning_platform");

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password']; // assume plain password, can hash in DB

    // Check credentials
    $query = $conn->query("SELECT * FROM admins WHERE email='$email' AND password='$password' LIMIT 1");

    if ($query->num_rows > 0) {
        $admin = $query->fetch_assoc();
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['name'];
        header("Location: admin-dashboard.php");
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login - EduConnect NG</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Admin Login</h2>

    <?php if($error): ?>
        <p class="bg-red-100 text-red-700 p-2 mb-4 rounded text-center"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" class="flex flex-col gap-4">
        <input 
            type="email" 
            name="email" 
            placeholder="Email" 
            required 
            class="p-3 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600"
        >
        <input 
            type="password" 
            name="password" 
            placeholder="Password" 
            required 
            class="p-3 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600"
        >
        <button type="submit" class="bg-blue-700 text-white p-3 rounded hover:bg-blue-800">Login</button>
    </form>
</div>

</body>
</html>