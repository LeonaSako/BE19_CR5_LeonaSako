<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Animals</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <?php
            session_start();
            if (isset($_SESSION['adm'])) {
                echo "<a href='dashboard.php' class='navbar-brand'> Dashboard Page</a>";
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
        <h1 class="text-center">Senior Animals</h1>
        <div class="text-center mb-3">
            <a href="senior.php" class="btn btn-pink mr-2">Show Seniors</a>
            <?php

            if (isset($_SESSION['adm'])) {
                echo "<a href='dashboard.php' class='btn btn-pink'>Show All</a>";
            } else if (isset($_SESSION['user'])) {
                echo "<a href='home.php' class='btn btn-pink'>Show All</a>";
            }
            ?>
           
        <div class="row">
            <?php
            include 'db_connect.php';

            $sql = "SELECT name, photo, breed, age, size, vaccinated,id,status FROM animal WHERE age > 8";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $photo = $row['photo'];
                    $photo_path = 'pictures/' . $photo;
                    $breed = $row['breed'];
                    $age = $row['age'];
                    $size = $row['size'];
                    $vaccinated = ($row['vaccinated'] == 1) ? 'Yes' : 'No';
                    $status = $row['status'];
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="<?php echo $photo_path; ?>" class="card-img-top"style='max-width: 100%; max-height:300px; min-height:300px'  alt="Animal Photo">

                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $name; ?>
                                </h5>
                                <p class="card-text">Breed:
                                    <?php echo $breed; ?>
                                </p>
                                <p class="card-text">Age:
                                    <?php echo $age; ?> years
                                </p>
                                <p class="card-text">Size:
                                    <?php echo $size; ?>
                                </p>
                                <p class="card-text">Vaccinated:
                                    <?php echo $vaccinated; ?>
                                </p>
                                <p class="card-text">Status:
                                    <?php echo $status; ?>
                                </p>
                                <a href="details.php?id=<?php echo $id; ?>" class="btn btn-primary">Show Details</a>

                                <?php
                                if (isset($_SESSION['adm'])) {
                                    echo "<a href=delete.php?id=$id class='btn btn-danger'>Delete</a>";
                                    echo "<a href=update.php?id=$id class='btn btn-secondary m-2'>Update</a>";
                                }
                                else if($status === "Available" && isset($_SESSION['user'])){
                                    echo "<a href='adopt.php?id=$id&userID=$_SESSION[user]'
                                    class='btn btn-warning'>Take me home</a>";

                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='text-center'>No senior animals found.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>

</html>