<?php
session_start();

require_once "config/db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        .container {
            max-width: 550px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1>Edit Data</h1>
        <hr>
        <form action="updateprofile.php" method="post">
            <?php
            if (isset($_GET['profile_id'])) {
                $profile_id = $_GET['profile_id'];
                $stmt = $conn->query("SELECT * FROM profile WHERE profile_id = $profile_id");
                $stmt->execute();
                $profile = $stmt->fetch();

                $stmt2 = $conn->query("SELECT skill_name FROM skill");

                while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                    $skills[] = $row;
                }
            }
            ?>
            <div class="mb-3">
                <label for="profile_id" class="col-form-label">profile_id:</label>
                <input type="text" readonly value="<?php echo $profile['profile_id']; ?>" required class="form-control" name="profile_id">
            </div>
            <div class="mb-3">
                            <label for="full_name" class="col-form-label"> fullname: </label>
                            <input value="<?php echo $profile['fullname']; ?>" type="text" class="form-control" id="fullname" name="fullname" required>
                        </div>
            <div class="mb-3">
                <!-- <label for="skill_name" class="col-form-label">skill_name:</label> -->
                <?php

                $skill = explode(",", $profile['skill_name']);
                // foreach ($skill as $items) {
                //     // echo ": $items";
                //     echo " <input class='orm-check-input' type='checkbox' value='' id='flexCheckDefault' checked >
                //     <label class='form-check-label' for='flexCheckDefault'>
                //       $items
                //     </label> ";
                // }

                foreach ($skills as $items) {
                    foreach($items as  $value) {
                        if(in_array($value,$skill)){
                            echo " <input class='orm-check-input' type='checkbox' name='checkrr[]' value='$value' id='flexCheckDefault' checked >
                                 <label class='form-check-label' for='flexCheckDefault'>
                                   $value
                                 </label> ";
                        }else{
                            echo " <input class='orm-check-input' type='checkbox' name='checkrr[]' value='$value' id='flexCheckDefault'>
                                 <label class='form-check-label' for='flexCheckDefault'>
                                   $value
                                 </label> ";
                        }
                      }
                }
                ?>
            </div>

            <hr>
            <a href="index.php" class="btn btn-secondary">Go Back</a>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>
    </div>

</body>

</html>