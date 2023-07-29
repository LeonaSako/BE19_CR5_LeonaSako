<?php


    require_once "db_connect.php";

    $id = $_GET["id"]; 
    echo $id;
    $sql = "SELECT * FROM animal WHERE id = $id"; 

    $result = $conn->query($sql);
    
    $delete = "DELETE FROM animal WHERE id= $id"; 

    if(mysqli_query($conn, $delete)){
        header("Location: dashboard.php");
    }else {
        echo "Error";
    }
    
    mysqli_close($conn);
?>