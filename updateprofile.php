<?php

session_start();

require_once "config/db.php";

if (isset($_POST['update'])) {
    $profile_id = $_POST['profile_id'];
    $fullname = $_POST['fullname'];

    $Skill = (array) $_POST['checkrr'];
    $skill_name = implode(",", $Skill);

    $sql = $conn->prepare("UPDATE profile SET fullname = :fullname, skill_name = :skill_name WHERE profile_id = :profile_id");
        $sql->bindParam(":profile_id", $profile_id);
        $sql->bindParam(":fullname", $fullname);
        $sql->bindParam(":skill_name", $skill_name);
        $sql->execute();

        if ($sql) {
            $_SESSION['success'] = "Data has been updated successfully";
            header("location: index.php");
        } else {
            $_SESSION['error'] = "Data has not been updated successfully";
            header("location: index.php");
        }
}

?>

