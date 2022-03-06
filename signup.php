<?php

$showalert = false;
$showerror = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'shared/connect.php';
    

    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    // $exists = false;

    // check wether this username is exist
    $existsql = "SELECT * FROM `jaynew` WHERE username = '$username'";
    $result = mysqli_query($conn, $existsql);
    $numExistrow = mysqli_num_rows($result);
    if ($numExistrow > 0) {
        // $exists = true;
        $showerror = "Username already exist.";
    } else {
        // $exists = false;
        if (($password == $confirmpassword)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `jaynew` (`username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";

            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showalert = true;
            }
        } else {
            $showerror = "Password do not match!";
        }
    }
}


?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Signup</title>
</head>

<body>

    <?php require './shared/header.php' ?>
    <?php
    if ($showalert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong>Your account is created successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
    <?php
    if ($showerror) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Sorry!</strong> ' . $showerror . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
    ?>
    <div class="container">
        <h1 class="text-center text-success mt-5">Signup to our website</h1>

        <form action="/loginsystem/signup.php" method="post">

            <div class="col-md-6 m-auto">
                <label for="username" class="form-label">Username</label>
                <input type="username" class="form-control" name="username" id="username" name="username" aria-describedby="username">
            </div>
            <div class="col-md-6 m-auto">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">

            </div>
            <div class="col-md-6 m-auto">
                <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword">
                <div id="confirmpassword" class="form-text">Make sure to type the same password</div>
            </div>
            <div class="text-center m-auto">
                <button type="submit" class="btn btn-primary mt-3 col-md-6 m-auto">Signup</button>
            </div>
        </form>
    </div>
    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        -->

       

</html>