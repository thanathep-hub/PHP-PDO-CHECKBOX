<?php 

session_start();
require_once "config/db.php";      


if (isset($_POST['submit'])) {
    $skill_name = $_POST['skill_name'];
   
    $sql = $conn->prepare("INSERT INTO skill (Skill_name) VALUES(:skill_name)");
    $sql->bindParam(":skill_name", $skill_name);
    $sql->execute();

    if ($sql) {
        $_SESSION['success'] = "Data has been inserted successfully";
        header("location: index.php");
    } else {
        $_SESSION['error'] = "Data has not been inserted successfully";
        header("location: index.php");
    }
}

?>