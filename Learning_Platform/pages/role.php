<?php
$conn = new mysqli("localhost", "root", "", "learning_platform");

// If the form is submitted
if($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $role = $_POST["role"];

    // Update role in DB
    $stmt = $conn->prepare("UPDATE users SET role = ? WHERE email = ?");
    $stmt->bind_param("ss", $role, $email);

    if($stmt->execute()){
        if($role === "student") {
            header("Location: student-dashboard.php");
        } else {
            header("Location: volunteer.php?email=" . urlencode($email));
        }
        exit();
    }
}

$email = isset($_GET["email"]) ? $_GET["email"] : "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Role - EduConnect NG</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">

        <h2 class="text-2xl text-center font-bold text-blue-600 mb-6">
            Welcome to EduConnect NG
        </h2>

        <p class="text-center mb-4 text-gray-700">
            Choose how you want to use the platform
        </p>

        <form method="POST" action="">
            <input type="hidden" name="email" value="<?php echo $email; ?>">

            <div class="grid grid-cols-1 gap-4">

                <label class="border rounded-lg p-4 flex items-center justify-between cursor-pointer hover:bg-blue-50">
                    <span class="font-medium text-lg">I am a Student</span>
                    <input type="radio" name="role" value="student" required>
                </label>

                <label class="border rounded-lg p-4 flex items-center justify-between cursor-pointer hover:bg-blue-50">
                    <span class="font-medium text-lg">I am a Volunteer</span>
                    <input type="radio" name="role" value="volunteer" required>
                </label>

            </div>

            <button class="w-full mt-6 bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
                Continue
            </button>

        </form>

    </div>
</div>

</body>
</html>