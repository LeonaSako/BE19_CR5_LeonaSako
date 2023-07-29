<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
        <?php
            session_start();
            if (isset($_SESSION['adm'])) {
                echo "<a href='dashboard.php' class='navbar-brand'> Dashboard Page</a>";
                echo "<a href='create.php' class=' navbar-brand'>Create</a>";
            } else if (isset($_SESSION['user'])) {
                echo "<a href='home.php' class='navbar-brand'>Home Page</a>";
            }
            ?>
            
        </div>
        <li class="nav-item">
                    <a class="nav-link" href="logout.php?logout">Logout</a>
                </li>
    </nav>

    <div class="container mt-4">
        <a onclick="history.back()">GO BACK </a>
        <h1 class="text-center">Animal Details</h1>
        <div class="row justify-content-center">
            <?php
            include 'db_connect.php';

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM animal WHERE id = $id";
                $result = $conn->query($sql);

                if ($result->num_rows === 1) {
                    $row = $result->fetch_assoc();
                    $name = $row['name'];
                    $photo = $row['photo'];
                    $photo_path = 'pictures/' .$photo;
                    $location = $row['location'];
                    $description = $row['description'];
                    $breed = $row['breed'];
                    $age = $row['age'];
                    $size = $row['size'];
                    $vaccinated = ($row['vaccinated'] == 1) ? 'Yes' : 'No';
            ?>
                    <div class="col-md-6">
                        <div class="card">
                        <img src="<?php echo $photo_path; ?>" class="card-img-top"style='max-width: 100%; max-height:400px; min-height:400px'  alt="Animal Photo">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $name; ?></h5>
                                <p class="card-text">Breed: <?php echo $breed; ?></p>
                                <p class="card-text">Age: <?php echo $age; ?> years</p>
                                <p class="card-text">Size: <?php echo $size; ?></p>
                                <p class="card-text">Vaccinated: <?php echo $vaccinated; ?></p>
                                <p class="card-text">Location: <?php echo $location; ?></p>
                                <p class="card-text">Description: <?php echo $description; ?></p>
                            </div>
                        </div>
                    </div>
            <?php
                } else {
                    echo "<p class='text-center'>Animal not found.</p>";
                }
            } else {
                echo "<p class='text-center'>Invalid request.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>

</html>
