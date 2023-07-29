<?php

include 'db_connect.php';
require_once "file_upload.php";


$name = $breed = $age = $size = $vaccinated = $photo = $description = $location = '';
$status = 'Available'; 
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
    $breed = mysqli_real_escape_string($conn, $_POST['breed']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $size = mysqli_real_escape_string($conn, $_POST['size']);
    $vaccinated = isset($_POST['vaccinated']) ? 1 : 0;
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $status = isset($_POST['status']) ? $_POST['status'] : 'Available';
    $photo = fileUpload($_FILES["photo"]);

    
    // if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    //     $photo = $_FILES['photo']['tmp_name'];
    //     $photo = file_get_contents($photo);
    //     $photo = base64_encode($photo);
    // }
    //echo $photo;

    $sql = "INSERT INTO animal (name, breed, age, size, vaccinated, photo, description, location, status) 
            VALUES ('$name', '$breed', '$age', '$size', '$vaccinated', '{$photo[0]}', '$description', '$location', '$status')";

    if ($conn->query($sql) === TRUE) {
      
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Error: " . $conn->error;
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Animal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center">Create New Animal</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label for="breed">Breed</label>
                <input type="text" class="form-control" name="breed" required>
            </div>
            <div class="form-group">
                <label for="age">Age (years)</label>
                <input type="number" class="form-control" name="age" required>
            </div>
            <div class="form-group">
                <label for="size">Size</label>
                <input type="text" class="form-control" name="size" required>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="vaccinated">
                <label class="form-check-label" for="vaccinated">Vaccinated</label>
            </div>
            <div class="form-group mt-3">
                <label for="photo">Photo</label>
                <input type="file" class="form-control-file" name="photo">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control" name="location" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status">
                    <option value="Available">Available</option>
                    <option value="Adopted">Adopted</option>
                </select>
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
        <?php if ($error_message): ?>
            <p class="text-danger mt-3"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
</body>

</html>
