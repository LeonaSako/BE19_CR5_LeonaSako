<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "be19_cr5_animal_adoption_leonasako";


$conn = mysqli_connect($hostname, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
