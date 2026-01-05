<?php
$conn = new mysqli("localhost", "root", "", "learning_platform");

// Check connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

// Fetch WAEC resources with volunteer info
$query = "
 SELECT resources.*, users.full_name AS volunteer_name, users.photo AS volunteer_photo, users.phone_number AS volunteer_phone
 FROM resources
 JOIN users ON resources.volunteer_id = users.id
 WHERE resources.category = 'WAEC' AND resources.is_approved = 1
 ORDER BY resources.date_posted DESC
";

$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>WAEC Resources - EduConnect NG</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- Top Bar -->
<nav class="bg-blue-600 p-4 shadow-md">
 <div class="max-w-6xl mx-auto flex justify-between items-center">
     <h1 class="text-white text-xl font-bold">EduConnect NG</h1>
     <span class="text-white">WAEC Resources</span>
 </div>
</nav>

<div class="max-w-6xl mx-auto mt-10 px-4">

 <h2 class="text-2xl font-bold text-gray-800 mb-6">WAEC Study Materials</h2>

 <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

     <?php if ($result && $result->num_rows > 0): ?>
         <?php while ($row = $result->fetch_assoc()): ?>
             <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">

                 <h3 class="text-lg font-bold text-blue-700">
                     <?php echo htmlspecialchars($row['title']); ?>
                 </h3>

                 <p class="text-gray-600 mt-2">
                     <?php echo nl2br(htmlspecialchars($row['description'])); ?>
                 </p>

                 <!-- Volunteer Info -->
                 <div class="mt-4 flex items-center gap-3">
                     <img src="<?php echo $row['volunteer_photo']; ?>" class="w-10 h-10 rounded-full object-cover border">
                     <div class="text-sm text-gray-500">
                         Posted by <span class="font-semibold text-gray-700"><?php echo htmlspecialchars($row['volunteer_name']); ?></span><br>
                         📞 <?php echo htmlspecialchars($row['volunteer_phone']); ?>
                     </div>
                 </div>

                 <p class="text-sm text-gray-500 mt-2">
                     On <?php echo date("M d, Y", strtotime($row['date_posted'])); ?>
                 </p>

                 <?php if (!empty($row['file_path'])): ?>
                     <a href="<?php echo $row['file_path']; ?>" 
                        class="block mt-4 text-center bg-blue-600 text-white p-2 rounded hover:bg-blue-700"
                        target="_blank">
                        View / Download
                     </a>
                 <?php else: ?>
                     <p class="mt-4 text-center italic text-gray-500">No file uploaded</p>
                 <?php endif; ?>

             </div>
         <?php endwhile; ?>
     <?php else: ?>
         <div class="col-span-3 bg-white p-8 rounded-lg shadow text-center">
             <p class="text-gray-600">No WAEC resources have been uploaded yet.</p>
         </div>
     <?php endif; ?>

 </div>
</div>

</body>
</html>