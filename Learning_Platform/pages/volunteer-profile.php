<?php
session_start();

// Volunteer must be logged in
$volunteerId = $_SESSION['user_id'] ?? null;
if (!$volunteerId) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "learning_platform");

// Fetch volunteer details
$volQuery = $conn->query("
    SELECT full_name, phone_number, photo, is_approved 
    FROM users 
    WHERE id = $volunteerId AND role = 'volunteer'
");
$volunteer = $volQuery->fetch_assoc();

// If the volunteer is not approved, block access
if (!$volunteer || $volunteer['is_approved'] == 0) {
    echo "<script>alert('Your account is not approved yet. Please wait for admin approval.'); 
    window.location.href='login.php';</script>";
    exit;
}

// Handle upload form submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['upload_resource'])) {

    $title = $_POST['title'] ?? '';
    $category = $_POST['category'] ?? '';
    $volunteer_id = $volunteerId;

    if (!empty($_FILES['file']['name'])) {
        $folder = "uploads/";
        if (!file_exists($folder)) mkdir($folder, 0777, true);

        $file = $_FILES['file'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['pdf','jpg','jpeg','png'];

        if (!in_array($ext, $allowed)) {
            $upload_error = "Invalid file type. Only PDF, JPG, JPEG, PNG allowed.";
        } else {
            $newName = uniqid("res_", true).".".$ext;
            $filePath = $folder.$newName;

            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                $stmt = $conn->prepare("INSERT INTO resources (volunteer_id, title, category, file_path, is_approved, date_posted, views) VALUES (?, ?, ?, ?, 0, NOW(), 0)");
                $stmt->bind_param("isss", $volunteer_id, $title, $category, $filePath);
                $stmt->execute();
                $stmt->close();

                // Refresh page to show the new pending resource
                header("Location: ".$_SERVER['PHP_SELF']);
                exit;
            } else {
                $upload_error = "Error uploading file.";
            }
        }
    } else {
        $upload_error = "Please select a file to upload.";
    }
}

// Search filter
$search = $_GET['search'] ?? '';

// Fetch volunteer resources
$resourceQuery = $conn->query("
    SELECT * FROM resources
    WHERE volunteer_id = $volunteerId
    AND title LIKE '%$search%'
    ORDER BY date_posted DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Volunteer Profile - EduConnect NG</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- NAVBAR -->
<!-- NAVBAR -->
<nav class="bg-blue-700 p-4 shadow">
    <div class="max-w-6xl mx-auto flex justify-between items-center text-white">

        <h1 class="font-bold text-xl">EduConnect NG</h1>

        <!-- DROPDOWN -->
        <div class="relative inline-block text-left">
            <button onclick="toggleDropdown()" class="flex items-center gap-2 font-semibold hover:text-gray-200">
                Volunteer Dashboard
            </button>

            <!-- Dropdown menu -->
            <div id="dashboardDropdown"
                class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg text-gray-700 overflow-hidden">

                <a href="login.php"
                    class="block px-4 py-2 hover:bg-gray-100">
                    Logout
                </a>

            </div>
        </div>

    </div>
</nav>

    <!-- PROFILE SECTION -->
    <div class="bg-white p-6 rounded-xl shadow flex items-center gap-6">

        <img src="<?php echo $volunteer['photo']; ?>" class="w-28 h-28 rounded-full object-cover border-4 border-blue-700">

        <div>
            <h2 class="text-2xl font-bold text-gray-800"><?php echo htmlspecialchars($volunteer['full_name']); ?></h2>
            <p class="text-gray-600 text-lg">📞 <?php echo htmlspecialchars($volunteer['phone_number']); ?></p>
            <p class="text-gray-500 text-sm mt-1">✔ Approved Volunteer</p>
        </div>
    </div>

    <!-- UPLOAD RESOURCE BUTTON -->
    <div class="mt-6 text-right">
        <button onclick="openModal()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Upload New Resource</button>
    </div>

    <!-- SEARCH BAR -->
    <div class="mt-8">
        <form method="GET">
            <div class="flex">
                <input type="text" name="search" placeholder="Search your uploaded resources..." value="<?php echo htmlspecialchars($search); ?>" class="w-full p-3 rounded-l-lg border border-gray-300 focus:outline-none">
                <button class="bg-blue-700 text-white px-6 rounded-r-lg hover:bg-blue-800">Search</button>
            </div>
        </form>
    </div>

    <!-- RESOURCES -->
    <h3 class="text-xl font-bold mt-10 mb-4 text-gray-800">Your Uploaded Resources</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <?php if ($resourceQuery->num_rows > 0): ?>
            <?php while ($res = $resourceQuery->fetch_assoc()): ?>
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h4 class="text-lg font-semibold text-blue-700"><?php echo htmlspecialchars($res['title']); ?></h4>
                    <p class="text-gray-600 mt-1">Category: <span class="font-medium text-gray-800"><?php echo $res['category']; ?></span></p>
                    <p class="mt-2 text-sm text-gray-500">Views: <strong><?php echo $res['views']; ?></strong></p>
                    <p class="text-sm text-gray-500">Posted: <?php echo date("M d, Y", strtotime($res['date_posted'])); ?></p>

                    <?php if($res['is_approved'] == 1): ?>
                        <a href="<?php echo $res['file_path']; ?>" class="block mt-4 text-center bg-blue-700 text-white p-2 rounded hover:bg-blue-800" target="_blank">View Resource</a>
                    <?php else: ?>
                        <span class="inline-block mt-2 px-2 py-1 text-sm font-semibold text-yellow-800 bg-yellow-200 rounded">Pending Approval</span>
                    <?php endif; ?>

                    <form method="POST" action="volunteer_delete_resource.php" class="mt-3">
                        <input type="hidden" name="resource_id" value="<?php echo $res['id']; ?>">
                        <button class="w-full bg-red-600 text-white p-2 rounded hover:bg-red-700" onclick="return confirm('Are you sure you want to delete this resource?');">Delete</button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-span-3 bg-white p-8 rounded-lg shadow text-center">
                <p class="text-gray-600">You have not uploaded any resources yet.</p>
            </div>
        <?php endif; ?>

    </div>
</div>

<!-- MODAL FOR UPLOAD -->
<div id="uploadModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">

        <!-- Close Button -->
        <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>

        <h2 class="text-2xl font-bold text-blue-700 mb-4 text-center">Upload Resource</h2>

        <?php if(!empty($upload_error)): ?>
            <p class="bg-red-100 text-red-600 p-2 rounded mb-4"><?php echo $upload_error; ?></p>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="upload_resource" value="1">

            <div class="mb-4">
                <label class="block mb-1 font-medium">Resource Title</label>
                <input type="text" name="title" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Category / Exam Type</label>
                <select name="category" class="w-full p-2 border rounded" required>
                    <option value="WAEC">WAEC</option>
                    <option value="NECO">NECO</option>
                    <option value="JAMB">JAMB</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Upload File (PDF/JPG/PNG)</label>
                <input type="file" name="file" accept=".pdf,.jpg,.jpeg,.png" class="w-full" required>
            </div>

            <button type="submit" class="w-full bg-blue-700 text-white p-2 rounded hover:bg-blue-800">Upload Resource</button>
        </form>
    </div>
</div>

<script>
// Dropdown toggle<script>
function toggleDropdown() {
    document.getElementById('dashboardDropdown').classList.toggle('hidden');
}

// Close dropdown if clicked outside
document.addEventListener('click', function(e){
    const dropdown = document.getElementById('dashboardDropdown');
    const button = e.target.closest('button');

    if (!button) dropdown.classList.add('hidden');
});

function openModal() {
    document.getElementById('uploadModal').classList.remove('hidden');
    document.getElementById('uploadModal').classList.add('flex');
}
function closeModal() {
    document.getElementById('uploadModal').classList.remove('flex');
    document.getElementById('uploadModal').classList.add('hidden');
}
</script>

</body>
</html>
