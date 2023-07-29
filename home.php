<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Adoption</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

<?php

 session_start();
 $email = $_SESSION['email'];
$userPhoto = $_SESSION['userPhoto'];


?>

   
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark d-flex">
        <div class="container">
            <a class="navbar-brand" href="home.php">Home Page</a>
        </div>
        <div class="d-flex flex-column-reverse">
        <h5 class="card-title text-white"><?php echo $email; ?></h5>
        <img style= "height:60px; width:60px; margin:auto"src="pictures/<?php echo $userPhoto; ?>" class="card-img-top" alt="User Photo">
        </div>
        <li class="nav-item">
                    <a class="nav-link" href="logout.php?logout">Logout</a>
                </li>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center">Animal Adoption</h1>
        <div class="text-center mb-3">
            <a href="senior.php" class="btn btn-pink mr-2">Show Seniors</a>
            <a href="home.php" class="btn btn-pink">Show All</a>
        </div>
        <div class="row">
            <?php
            include 'db_connect.php';

            $sql = "SELECT id, name, photo, breed, age, size, vaccinated, status FROM animal";
            $result = $conn->query($sql);
            $user = $_SESSION['userID'];
            


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $photo = $row['photo'];
                    $photo_path = 'pictures/' .$photo;
                    $breed = $row['breed'];
                    $age = $row['age'];
                    $size = $row['size'];
                    $vaccinated = ($row['vaccinated'] == 1) ? 'Yes' : 'No';
                    $status = $row['status'];

            ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                        <img src="<?php echo $photo_path; ?>" class="card-img-top" style='max-width: 100%; max-height:300px; min-height:300px' alt="Animal Photo">

                            <div class="card-body">
                                
                                <h5 class="card-title"><?php echo $name; ?></h5>
                                <p class="card-text">Breed: <?php echo $breed; ?></p>
                                <p class="card-text">Age: <?php echo $age; ?> years</p>
                                <p class="card-text">Size: <?php echo $size; ?></p>
                                <p class="card-text">Vaccinated: <?php echo $vaccinated; ?></p>
                                <p class="card-text">Status: <?php echo $status; ?></p>
                                <a href="details.php?id=<?php echo $id; ?>" class="btn btn-primary">Show Details</a>
                                <?php 
                                    if($status === "Available"){
                                        echo "<a href=adopt.php?id=$id&userID=$user class='btn btn-warning'>Take me home</a>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p class='text-center'>No animals found.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>

</html>
