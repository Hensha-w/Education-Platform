<?php
session_start();
$conn = new mysqli("localhost", "root", "", "learning_platform");

$error = "";
$success = "";

// Get email from GET (first visit) or POST (on form submit)
$email = $_GET["email"] ?? ($_POST["email"] ?? "");

if (!$email) {
    $error = "Email was not received. Please restart signup.";
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && $email) {

    $phone_number = $_POST["number"];

    // Ensure directory exists
    $folder = "uploads/";
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $allowed = ["pdf", "jpg", "jpeg", "png"];

    // Check if files were uploaded
    if (
        empty($_FILES["university_certificate"]["name"]) ||
        empty($_FILES["teaching_certificate"]["name"]) ||
        empty($_FILES["photo"]["name"])
    ) {
        $error = "All files are required.";
    } else {

        // Get file extensions
        $uniExt = strtolower(pathinfo($_FILES["university_certificate"]["name"], PATHINFO_EXTENSION));
        $teachExt = strtolower(pathinfo($_FILES["teaching_certificate"]["name"], PATHINFO_EXTENSION));
        $photoExt = strtolower(pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION));

        // Validate allowed types
        if (!in_array($uniExt, $allowed) || !in_array($teachExt, $allowed) || !in_array($photoExt, $allowed)) {
            $error = "Only PDF, JPG, JPEG, or PNG files are allowed.";
        } else {

            // New safe unique file names
            $uniNewName = uniqid("uni_", true) . "." . $uniExt;
            $teachNewName = uniqid("teach_", true) . "." . $teachExt;
            $photoNewName = uniqid("photo_", true) . "." . $photoExt;

            // File paths
            $uniPath = $folder . $uniNewName;
            $teachPath = $folder . $teachNewName;
            $photoPath = $folder . $photoNewName;

            // Move files
            $move1 = move_uploaded_file($_FILES["university_certificate"]["tmp_name"], $uniPath);
            $move2 = move_uploaded_file($_FILES["teaching_certificate"]["tmp_name"], $teachPath);
            $move3 = move_uploaded_file($_FILES["photo"]["tmp_name"], $photoPath);

            if ($move1 && $move2 && $move3) {

                // Update volunteer info
                $stmt = $conn->prepare("
                    UPDATE users 
                    SET phone_number=?, university_certificate=?, teaching_certificate=?, photo=?, verification_status='submitted'
                    WHERE email=?
                ");
                $stmt->bind_param("sssss", $phone_number, $uniPath, $teachPath, $photoPath, $email);

                if ($stmt->execute()) {
                    header("Location: login.php?upload=success");
                    exit();
                } else {
                    $error = "Database Error: " . $stmt->error;
                }

            } else {
                $error = "File upload failed. Check folder permissions.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Verification - EduConnect NG</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">

        <h2 class="text-2xl font-bold text-center text-blue-600 mb-4">
            Volunteer Verification
        </h2>

        <p class="text-center text-gray-600 mb-6">
            Upload the required documents to complete your volunteer profile.
        </p>

        <?php if($error): ?>
            <p class="bg-red-100 text-red-600 p-3 rounded mb-4"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" action="" enctype="multipart/form-data">

            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">

            <div class="mb-4">
                <label class="block mb-1 font-medium">Phone Number</label>
                <input type="text" name="number" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">University Certificate</label>
                <input type="file" name="university_certificate" class="w-full" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Teaching Certificate</label>
                <input type="file" name="teaching_certificate" class="w-full" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Photo</label>
                <input type="file" name="photo" class="w-full" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
                Submit Documents
            </button>

        </form>

        <p class="text-center text-sm mt-4 text-gray-500">
            Your documents will be reviewed within 24–48 hours.
        </p>
    </div>
</div>

</body>
</html>