<?php
// Include the database connection file
include 'db_connect.php';

// Define variables to store the form input
$id = $name = $breed = $age = $size = $vaccinated = $photo = $description = $location = $status = '';
$error_message = '';

// Check if the ID parameter is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the animal record based on the provided ID
    $sql = "SELECT * FROM animal WHERE id = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $breed = $row['breed'];
        $age = $row['age'];
        $size = $row['size'];
        $vaccinated = $row['vaccinated'];
        $photo = $row['photo'];
        $description = $row['description'];
        $location = $row['location'];
        $status = $row['status'];
    } else {
        // If the animal with the provided ID is not found, redirect back to the main page
        header("Location: index.php");
        exit();
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $breed = mysqli_real_escape_string($conn, $_POST['breed']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $size = mysqli_real_escape_string($conn, $_POST['size']);
    $vaccinated = isset($_POST['vaccinated']) ? 1 : 0;
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $status = isset($_POST['status']) ? $_POST['status'] : 'Available';

    // Update the data in the 'animal' table
    $sql = "UPDATE animal SET 
            name = '$name', 
            breed = '$breed', 
            age = '$age', 
            size = '$size', 
            vaccinated = '$vaccinated', 
            description = '$description', 
            location = '$location', 
            status = '$status'
            WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the main page if successful
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Error: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Animal Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
    <a onclick="history.back()">GO BACK </a>
        <h1 class="text-center">Update Animal Details</h1>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="form-group">
                <label for="breed">Breed</label>
                <input type="text" class="form-control" name="breed" value="<?php echo $breed; ?>" required>
            </div>
            <div class="form-group">
                <label for="age">Age (years)</label>
                <input type="number" class="form-control" name="age" value="<?php echo $age; ?>" required>
            </div>
            <div class="form-group">
                <label for="size">Size</label>
                <input type="text" class="form-control" name="size" value="<?php echo $size; ?>" required>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="vaccinated" <?php if ($vaccinated) echo 'checked'; ?>>
                <label class="form-check-label" for="vaccinated">Vaccinated</label>
            </div>
            <div class="form-group mt-3">
                <label for="photo">Photo</label>
                <input type="file" class="form-control-file" name="photo">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" rows="3" required><?php echo $description; ?></textarea>
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control" name="location" value="<?php echo $location; ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status">
                    <option value="Available" <?php if ($status == 'Available') echo 'selected'; ?>>Available</option>
                    <option value="Adopted" <?php if ($status == 'Adopted') echo 'selected'; ?>>Adopted</option>
                </select>
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
        <?php if ($error_message): ?>
            <p class="text-danger mt-3"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
</body>

</html>
