<?php

    include 'db.php';
    include "config.php";

        //on logout session_destroy();
        if(isset($_SESSION["user_id"])) {
            session_destroy();
        }
        
    session_start();
    if(!empty($_POST["loginMail"])) { //true if form was submitted
        $query  = "SELECT * FROM tbl_205_users WHERE email='" 
        . $_POST["loginMail"] 
        . "' and password_='"
        . $_POST["loginPass"]
        ."'";
        //echo $query;//can't start echo if header comes after it

        $result = mysqli_query($connection , $query);
        $row    = mysqli_fetch_array($result);

        if(is_array($row)) {
            $_SESSION["user_id"] = $row['id'];
            $_SESSION["user_type"] = $row['user_type'];
            $_SESSION["user_email"] = $row['email'];
            header('Location: ' . URL . 'index.php');
        } else {
            $message = "Invalid Username or Password!";
            // echo $message;
        }

    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">  
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=DM Sans">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    
    </head>
    <body id="loginBG">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                    <div class="card mt-5">
                        <div class="card-body">
                            <h1 class="card-title text-center">Login</h1>
                            <form action="#" method="post" id="frm">
                                <div class="form-group">
                                    <label for="loginMail">Email: </label>
                                    <input type="email" class="form-control" required name="loginMail" id="loginMail" aria-describedby="emailHelp" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="loginPass">Password: </label>
                                    <input type="password" class="form-control" required name="loginPass" id="loginPass" placeholder="Enter Password">
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Log Me In</button>
                                <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
//close DB connection
mysqli_close($connection);
?>