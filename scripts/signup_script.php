<?php
    session_start();
    if(isset($_SESSION['email'])){
        header('location: ../dashboard.php');
        die();
    }
    include '../inc/connect.php';
    $firstname = htmlentities(mysqli_real_escape_string($con,filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING)));
    $lastname = htmlentities(mysqli_real_escape_string($con,filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING)));
    $email = htmlentities(mysqli_real_escape_string($con,filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING)));
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('location: ../signup.php?error=corrupt email');
        die();
    }
    $valid_email = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $valid_email);
    $password = md5(htmlentities(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)));
    if(mysqli_num_rows($result) > 0){
        header('location:../signup.php?error=Invalid Email');
        die();
    }
    if(isset($_POST['ref']) && !empty($_POST['ref'])){
        $ref = filter_input(INPUT_POST, 'ref', FILTER_SANITIZE_STRING);
        $collect_point = "SELECT * FROM users WHERE referral_id = '$ref'";
        $result_point = mysqli_query($con, $collect_point);
        $arr = mysqli_fetch_array($result_point);
        $points = $arr['points'];
        $check = "SELECT * FROM users WHERE referral_id = '$ref'";
        $check_ref = mysqli_query($con, $check);
        if(mysqli_num_rows($check_ref) > 0){
            if($points == null){
                $points = 1;
            }
            else{
                $points++;
            }
            $username = $arr['firstname'].' '.$arr['lastname'];
            $friend_name = $firstname.' '.$lastname;
            $update = "UPDATE users SET points = '$points' WHERE referral_id = '$ref'";
            $update_result = mysqli_query($con,$update);
            $qry = "INSERT INTO referral (ref_id,user,friend,f_email) VALUES('$ref','$username','$friend_name','$email')";
            $link = mysqli_query($con, $qry);
            
        }
        else{
            header('location: ../signup.php?error=invalid ref');
            die();
        }
    }
    $time = time();
    $get_id = "SELECT MAX(id) FROM users";
    $last_id = mysqli_query($con, $get_id);
    $arr = mysqli_fetch_array($last_id);
    $id = $arr['MAX(id)'];
    if($id == null){
        $id = 1;
    }
    $referral_id = "ref".$id.$time;
    $code = rand(10000,99999);
    $to = $email;
    $subject = 'Verification Code';
    $body = 'Verification code for registeration is - '.$code;
    $headers = 'From: legaldesire.com';
    mail($to,$subject,$body,$headers);
    $insert_query = "INSERT INTO users(firstname,lastname,email,password,referral_id) VALUES('$firstname','$lastname','$email','$password','$referral_id')";
    $_SESSION['query'] = $insert_query;
    $_SESSION['code'] = $code;
    $_SESSION['u_email'] = $email;
    $_SESSION['u_id'] = $id;
    header('location: ../register.php');
    die();
    ?>