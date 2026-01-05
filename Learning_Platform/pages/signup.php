<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "learning_platform");

$success = "";
$error = "";

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Basic validation
    if(empty($full_name) || empty($email) || empty($password)){
        $error = "All fields are required.";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user
        $stmt = $conn->prepare("INSERT INTO users(full_name, email, password) VALUES(?,?,?)");
        $stmt->bind_param("sss", $full_name, $email, $hashedPassword);

        if($stmt->execute()){
            header("Location: role.php?email=" . urlencode($email));
            exit();
        }
        else {
            $error = "Error creating account. Email may already be in use.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - EduConnect NG</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<div class="flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">

        <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">Create an Account</h2>

        <?php if($error): ?>
            <p class="bg-red-100 text-red-600 p-3 rounded mb-4"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if($success): ?>
            <p class="bg-green-100 text-green-600 p-3 rounded mb-4"><?php echo $success; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-4">
                <label class="block mb-1 font-medium">Full Name</label>
                <input type="text" name="full_name" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Email</label>
                <input type="email" name="email" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Password</label>
                <input type="password" name="password" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-6">
                <label class="block mb-1 font-medium">Confirm Password</label>
                <input type="password" name="confirm_password" class="w-full p-2 border rounded" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
                Sign Up
            </button>
        </form>

        <p class="text-center text-sm mt-4">
            Already have an account?
            <a href="login.php" class="text-blue-600 font-semibold">Log In</a>
        </p>
    </div>
</div>

</body>
</html>
