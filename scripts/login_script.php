<?php
    session_start();
    include '../inc/connect.php';
    if(isset($_SESSION['email'])){
        header('location: ../dashboard.php');
        die();
    }
    $email = htmlentities(mysqli_real_escape_string($con,filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING)));
    $password =  md5(htmlentities(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)));
    $login_query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $login = mysqli_query($con, $login_query);
    $arr = mysqli_fetch_array($login);
    if(mysqli_num_rows($login) == 0){
        header('location: ../login.php?error=invalid user');
        die();
    }
    else if(mysqli_num_rows($login) == 1){
        $_SESSION['email'] = $arr['email'];
        $_SESSION['id'] = $arr['id'];
        header('location: ../dashboard.php');
        die();
    }
    else{
        header('location: ../login.php?error=database error');
        die();
    }
?>