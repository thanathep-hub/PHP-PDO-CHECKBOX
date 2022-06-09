<?php 

session_start();
require_once "config/db.php";      


if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    // $Skill_name=(array) $_POST['checkrr'];
    // $emskill=implode(",",$_POST["Skill_name"]); 


    $Skill = (array) $_POST['checkrr'];
    $skill_name = implode(",", $Skill);
    // echo $Skill_name;

    // echo '<script type="text/javascript">alert("Data has been submitted to ' . $Skill_name . '");</script>';
   
    $sql = $conn->prepare("INSERT INTO profile (fullname, skill_name) VALUES(:fullname, :skill_name)");
    $sql->bindParam(":fullname", $fullname);
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