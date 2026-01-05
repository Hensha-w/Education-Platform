<?php
session_start();

// Only allow admin access
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin-login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "learning_platform");

// Approve Volunteer
if (isset($_GET['approve_volunteer'])) {
    $volunteer_id = intval($_GET['approve_volunteer']);
    $conn->query("UPDATE users SET is_approved=1 WHERE id=$volunteer_id AND role='volunteer'");
    header("Location: admin-dashboard.php");
    exit;
}

// Delete User
if (isset($_GET['delete_user'])) {
    $user_id = intval($_GET['delete_user']);
    $conn->query("DELETE FROM users WHERE id=$user_id");
    $conn->query("DELETE FROM resources WHERE volunteer_id=$user_id");
    header("Location: admin-dashboard.php");
    exit;
}

// Approve Resource
if (isset($_GET['approve_resource'])) {
    $resource_id = intval($_GET['approve_resource']);
    $conn->query("UPDATE resources SET is_approved=1 WHERE id=$resource_id");
    header("Location: admin-dashboard.php");
    exit;
}

// Delete Resource
if (isset($_GET['delete_resource'])) {
    $resource_id = intval($_GET['delete_resource']);
    $conn->query("DELETE FROM resources WHERE id=$resource_id");
    header("Location: admin-dashboard.php");
    exit;
}

// Fetch all users
$users = $conn->query("SELECT * FROM users ORDER BY id DESC");

// Fetch pending volunteers
$pendingVolunteers = $conn->query("SELECT * FROM users WHERE role='volunteer' AND is_approved=0 ORDER BY id DESC");

// Fetch pending resources
$pendingResources = $conn->query("
    SELECT resources.*, users.full_name AS volunteer_name 
    FROM resources
    JOIN users ON resources.volunteer_id = users.id
    WHERE resources.is_approved=0
    ORDER BY resources.date_posted DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard - EduConnect NG</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="bg-gray-900 p-4 shadow text-white">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <h1 class="font-bold text-xl">EduConnect NG - Admin Dashboard</h1>
        <a href="login.php" class="bg-red-600 px-4 py-2 rounded hover:bg-red-700">Logout</a>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-4 mt-10">

    <!-- ALL USERS SECTION -->
    <div class="mb-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">All Users</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while ($user = $users->fetch_assoc()): ?>
                <div class="bg-white p-5 rounded-xl shadow hover:shadow-lg transition">
                    
                    <div class="flex gap-4 items-center">
                        <img src="<?php echo $user['photo']; ?>" class="w-14 h-14 rounded-full object-cover border">
                        <div>
                            <h3 class="font-bold text-lg"><?php echo htmlspecialchars($user['full_name']); ?></h3>
                            <p class="text-gray-500 text-sm"><?php echo htmlspecialchars($user['email']); ?></p>

                            <!-- Role Badge -->
                            <span class="inline-block mt-1 px-2 py-1 text-xs rounded-full 
                                <?php echo $user['role'] == 'volunteer' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700'; ?>">
                                <?php echo ucfirst($user['role']); ?>
                            </span>

                            <!-- Approval Badge -->
                            <span class="inline-block mt-1 ml-2 px-2 py-1 text-xs rounded-full 
                                <?php echo $user['is_approved'] ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'; ?>">
                                <?php echo $user['is_approved'] ? 'Approved' : 'Pending'; ?>
                            </span>

                        </div>
                    </div>

                    <div class="mt-4 flex gap-3">
                        <?php if ($user['role'] == 'volunteer' && !$user['is_approved']): ?>
                            <a href="?approve_volunteer=<?php echo $user['id']; ?>" 
                               class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                Approve
                            </a>
                        <?php endif; ?>

                        <a href="?delete_user=<?php echo $user['id']; ?>" 
                           class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700"
                           onclick="return confirm('Delete this user?');">
                           Delete
                        </a>
                    </div>

                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- PENDING RESOURCES SECTION -->
    <div class="mb-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Pending Volunteer Uploads</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while ($res = $pendingResources->fetch_assoc()): ?>
                <div class="bg-white p-5 rounded-xl shadow hover:shadow-lg transition">

                    <h3 class="font-bold text-xl text-blue-700"><?php echo htmlspecialchars($res['title']); ?></h3>
                    <p class="text-gray-500 mt-2">Uploaded by: <strong><?php echo htmlspecialchars($res['volunteer_name']); ?></strong></p>
                    <p class="text-gray-500">Category: <?php echo htmlspecialchars($res['category']); ?></p>
                    <p class="text-gray-500">Posted: <?php echo date("M d, Y", strtotime($res['date_posted'])); ?></p>
                    <p class="inline-block mt-2 px-2 py-1 text-sm font-semibold text-yellow-800 bg-yellow-200 rounded">Pending Approval</p>

                    <?php if (!empty($res['file_path']) && file_exists($res['file_path'])): ?>
                        <a href="<?php echo $res['file_path']; ?>" target="_blank" class="block mt-2 text-blue-700 underline">View Document</a>
                    <?php endif; ?>

                    <div class="mt-4 flex gap-3">
                        <a href="?approve_resource=<?php echo $res['id']; ?>" 
                           class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                           Approve
                        </a>
                        <a href="?delete_resource=<?php echo $res['id']; ?>" 
                           class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700"
                           onclick="return confirm('Delete this resource?');">
                           Delete
                        </a>
                    </div>

                </div>
            <?php endwhile; ?>
        </div>
    </div>

</div>

</body>
</html>
