<?php


    session_start();
    require_once "db_connect.php";

    $animalID = $_GET["id"];
    $userID = $_GET['userID'];
    $date = date("Y-m-d h:i:sa");


    $sql = "INSERT INTO pet_adoption (`userID`, `animalID`, `adoption_date`) VALUES ('$userID','$animalID','$date')";


    $result = $conn->query($sql);

    $sql2 = "UPDATE animal SET status = 'Adopted' where id = '$animalID'";

    $result2 = $conn->query($sql2);
    
  



    if($result && $result2){
        echo "<a onclick='history.back()'>GO BACK </a>";
        echo "<div class='alert alert-success'>
        <p>Animal was succesfully adopted, Congratulation!</p>
    </div>";
    }else {
        echo "<a onclick='history.back()'>GO BACK </a>";
        echo "<div class='alert alert-danger'>
        <p>Something went wrong, please try again later ...</p>
    </div>";
    }
    
    mysqli_close($conn);
?>