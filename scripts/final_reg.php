<?php
    session_start();
    if(isset($_SESSION['email'])){
        header('location: ../dashboard.php');
        die();
    }
    include '../inc/connect.php';
    $insert_query = $_SESSION['query'];
    $code = $_SESSION['code'];
    $email = $_SESSION['u_email'];
    $id = $_SESSION['u_id'];
    $submit = mysqli_query($con,$insert_query);
    $_SESSION['email'] = $email;
    $_SESSION['id'] = $id;
    unset ($_SESSION["query"]);
    unset ($_SESSION["code"]);
    unset ($_SESSION["u_email"]);
    unset ($_SESSION["u_id"]);
    header("location: ../dashboard.php?success=registered");
    die();
?>