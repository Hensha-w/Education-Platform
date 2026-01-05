<?php
session_start();
$studentName = $_SESSION['user_name'] ?? "Student";

$conn = new mysqli("localhost", "root", "", "learning_platform");

// Handle search
$search = $_GET['search'] ?? '';
$searchEscaped = $conn->real_escape_string($search);

// Fetch latest approved volunteer posts, filtered by category or volunteer name if search is provided
$latestPostsQuery = $conn->query("
    SELECT resources.title, resources.category, resources.date_posted, users.full_name, users.photo, users.phone_number
    FROM resources
    JOIN users ON resources.volunteer_id = users.id
    WHERE resources.is_approved = 1
    " . (!empty($searchEscaped) ? "AND (resources.category LIKE '%$searchEscaped%' OR users.full_name LIKE '%$searchEscaped%')" : "") . "
    ORDER BY resources.date_posted DESC
    LIMIT 10
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Dashboard - EduConnect NG</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- Top Navigation -->
<nav class="bg-blue-600 p-4 shadow-md">
    <div class="max-w-6xl mx-auto flex justify-between items-center">
        <h1 class="text-white text-xl font-bold">EduConnect NG</h1>
            <!-- USER DROPDOWN -->
            <div class="relative text-white font-medium">
                <button onclick="toggleDropdown()" class="flex items-center gap-2 hover:text-gray-300">
                    Welcome, <?php echo htmlspecialchars($studentName); ?>
                </button>

                <!-- Dropdown menu -->
                <div id="userDropdown"
                    class="hidden absolute right-0 mt-2 w-32 bg-white text-gray-700 rounded-lg shadow-lg overflow-hidden">

                    <a href="login.php"
                        class="block px-4 py-2 text-red-600 hover:bg-red-100">
                        Logout
                    </a>

                </div>
            </div>
    </div>
</nav>

<!-- Main Container -->
<div class="max-w-6xl mx-auto mt-8 px-4">

    <!-- Search Section -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-3">Find Learning Resources</h2>
        <form method="GET">
            <div class="flex">
                <input 
                    type="text" 
                    name="search"
                    placeholder="Search by category or volunteer name..." 
                    value="<?php echo htmlspecialchars($search); ?>"
                    class="w-full p-3 rounded-l-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <button class="bg-blue-600 text-white px-6 rounded-r-lg hover:bg-blue-700">
                    Search
                </button>
            </div>
        </form>
    </div>

    <!-- Quick Content Categories -->
<h2 class="text-xl font-semibold text-gray-700 mb-4">Quick Access</h2>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

    <!-- WAEC Card -->
    <div class="bg-white p-6 shadow rounded-xl hover:shadow-lg transition cursor-pointer">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135768.png" class="w-16 mx-auto mb-4">
        <h3 class="text-center text-lg font-bold text-blue-700">WAEC Resources</h3>
        <p class="text-center text-gray-600 mt-2">
            Access learning materials, past questions, and volunteer-created study notes.
        </p>
        <a href="waec-resources.php" class="mt-4 block w-full bg-blue-600 text-white p-2 rounded text-center hover:bg-blue-700">
            Open WAEC
        </a>
    </div>

    <!-- NECO Card -->
    <div class="bg-white p-6 shadow rounded-xl hover:shadow-lg transition cursor-pointer">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135768.png" class="w-16 mx-auto mb-4">
        <h3 class="text-center text-lg font-bold text-green-700">NECO Resources</h3>
        <p class="text-center text-gray-600 mt-2">
            Explore notes, tutorials, guides, and problem-solving materials.
        </p>
        <a href="neco-resources.php" class="mt-4 block w-full bg-green-600 text-white p-2 rounded text-center hover:bg-green-700">
            Open NECO
        </a>
    </div>

    <!-- JAMB Card -->
    <div class="bg-white p-6 shadow rounded-xl hover:shadow-lg transition cursor-pointer">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135768.png" class="w-16 mx-auto mb-4">
        <h3 class="text-center text-lg font-bold text-purple-700">JAMB Resources</h3>
        <p class="text-center text-gray-600 mt-2">
            Get access to mock questions, practice tests, and learning videos.
        </p>
        <a href="jamb-resources.php" class="mt-4 block w-full bg-purple-600 text-white p-2 rounded text-center hover:bg-purple-700">
            Open JAMB
        </a>
    </div>

</div>

    <!-- Latest Posts Section -->
    <div class="mt-10">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Latest Volunteer Posts</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if ($latestPostsQuery->num_rows > 0): ?>
                <?php while ($post = $latestPostsQuery->fetch_assoc()): ?>
                    <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                        <div class="flex items-center gap-4 mb-3">
                            <img src="<?php echo htmlspecialchars($post['photo']); ?>" class="w-12 h-12 rounded-full object-cover border">
                            <div>
                                <h3 class="font-bold text-blue-700"><?php echo htmlspecialchars($post['title']); ?></h3>
                                <p class="text-gray-500 text-sm">
                                    <?php echo htmlspecialchars($post['category']); ?> | 
                                    <?php echo date("M d, Y", strtotime($post['date_posted'])); ?>
                                </p>
                                <p class="text-gray-600 text-sm">
                                    By: <?php echo htmlspecialchars($post['full_name']); ?> | 📞 <?php echo htmlspecialchars($post['phone_number']); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-span-3 bg-white p-6 rounded-lg shadow text-center">
                    <p class="text-gray-600 italic">No posts available yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>

<script>
function toggleDropdown() {
    document.getElementById("userDropdown").classList.toggle("hidden");
}

// Close dropdown when clicking outside
document.addEventListener("click", function(event) {
    const dropdown = document.getElementById("userDropdown");
    const button = event.target.closest("button");

    if (!button) dropdown.classList.add("hidden");
});
</script>

</body>
</html>
