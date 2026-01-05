<?php
session_start();
$conn = new mysqli("localhost","root","","learning_platform");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$volunteerId = $_POST['volunteer_id'];
$title = $_POST['title'];
$category = $_POST['category'];
$file = $_FILES['file'];

// Validate file
$allowed = ['pdf','jpg','jpeg','png'];
$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

if(!in_array($ext, $allowed)){
    die("Invalid file type");
}

// Upload folder
$folder = "uploads/resources/";
if(!file_exists($folder)) mkdir($folder,0777,true);

$newName = uniqid("res_",true).".".$ext;
$path = $folder.$newName;

if(move_uploaded_file($file['tmp_name'],$path)){

    // Prepare statement
    $stmt = $conn->prepare("
        INSERT INTO resources (volunteer_id, title, category, file_name, file_path) 
        VALUES (?, ?, ?, ?, ?)
    ");

    if(!$stmt){
        die("Prepare failed: " . $conn->error); // <-- Shows exact SQL error
    }

    $stmt->bind_param("issss",$volunteerId,$title,$category,$file['name'],$path);

    if($stmt->execute()){
        $stmt->close();
        header("Location: volunteer-profile.php?upload=success");
        exit;
    }else{
        die("Execute failed: " . $stmt->error);
    }

}else{
    die("File upload failed");
}
?>