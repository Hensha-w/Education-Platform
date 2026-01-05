<?php
session_start();

// Clear previous sessions
session_unset();
session_destroy();
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "learning_platform");

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        $error = "All fields are required.";
    } else {

        // Fetch user and approval status
        $stmt = $conn->prepare(
            "SELECT id, full_name, email, password, role, is_approved 
             FROM users WHERE email = ?"
        );
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {

            $stmt->bind_result($id, $full_name, $db_email, $db_password, $role, $is_approved);
            $stmt->fetch();

            // Verify password
            if (password_verify($password, $db_password)) {

                // Save session
                $_SESSION["user_id"]   = $id;
                $_SESSION["user_name"] = $full_name;
                $_SESSION["role"]      = $role;
                $_SESSION["approved"]  = $is_approved;

                // Redirect based on role
                if ($role === "student") {
                    header("Location: student-dashboard.php");
                    exit();
                } elseif ($role === "volunteer") {

                    // Check approval
                    if ($is_approved == 1) {
                        header("Location: volunteer-profile.php");
                        exit();
                    } else {
                        header("Location: volunteer-pending.php");
                        exit();
                    }

                } elseif ($role === "admin") {
                    header("Location: admin-dashboard.php");
                    exit();
                }

            } else {
                $error = "Invalid email or password.";
            }

        } else {
            $error = "Invalid email or password.";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EduConnect NG</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<div class="flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">

        <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">Welcome Back</h2>

        <?php if($error): ?>
            <p class="bg-red-100 text-red-600 p-3 rounded mb-4"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-4">
                <label class="block mb-1 font-medium">Email</label>
                <input type="email" name="email" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-6">
                <label class="block mb-1 font-medium">Password</label>
                <input type="password" name="password" class="w-full p-2 border rounded" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
                Login
            </button>
        </form>

        <p class="text-center text-sm mt-4">
            Don’t have an account?
            <a href="signup.php" class="text-blue-600 font-semibold">Create one</a>
        </p>
    </div>
</div>

</body>
</html>