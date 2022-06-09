<?php
session_start();

require_once "config/db.php";
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 5 Checkbox List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>

    <div class="modal fade" id="usermodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Skill</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="insert.php" method="post">
                        <div class="mb-3">
                            <label for="skill_name" class="col-form-label"> name: </label>
                            <input type="text" class="form-control" id="skill_name" name="skill_name">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addprofile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Checkbox</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="insertprofile.php" method="post">
                        <div class="mb-3">
                            <label for="full_name" class="col-form-label"> fullname: </label>
                            <input type="text" class="form-control" id="fullname" name="fullname">
                        </div>

                        <?php
                        $stmt = $conn->query("SELECT * FROM skill");
                        $stmt->execute();
                        $skills = $stmt->fetchAll();
                        

                        if (!$skills) {
                            echo " <div class='text-center'><p> No data Checkbox </p> </div>";
                        } else {
                            foreach ($skills as $items) {
                        ?>
                                <div class="form-check">
                                    <input name="checkrr[]" class="form-check-input" type="checkbox" value="<?php echo $items['skill_name']; ?>">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        <?php echo $items['skill_name']; ?>
                                    </label>
                                </div>

                        <?php }
                        } ?>





                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>




    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h1>
                    Checkbox Bottstrap 5
                </h1>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#usermodal">
                    Add Skill
                </button>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addprofile">
                    Add profile
                </button>
            </div>

        </div>

        <hr>
        <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php } ?>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Skill_name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->query("SELECT * FROM profile");
                $stmt->execute();
                $profile = $stmt->fetchAll();

                if (!$profile) {
                    echo "<p><td colspan='6' class='text-center'>No data available</td></p>";
                } else {
                    foreach ($profile as $items) {
                ?>
                        <tr>
                            <th scope="row"><?php echo $items['profile_id']; ?></th>
                            <td><?php echo $items['skill_name']; ?></td>
                            <td>
                                <a href="edit.php?profile_id=<?php echo $items['profile_id']; ?>" class="btn btn-warning">Edit</a>
                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>

    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>