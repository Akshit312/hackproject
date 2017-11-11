<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header('location: login.php');
        die();
    }
    $pageTitle = "Dashboard";
    include 'inc/connect.php';
    $email = $_SESSION['email'];
    $info_user = "SELECT * FROM users where email = '$email'";
    $query = mysqli_query($con, $info_user);
    $arr = mysqli_fetch_array($query);
    $firstname = $arr['firstname'];
    $lastname = $arr['lastname'];
    include 'inc/header.php';
?>
<div class="container content">
    <div class="alert alert-info">
        <h3>You can Search Members Here</h3>
        <form method="POST" action="search_result.php">
            <input type="text" class="input-lg" placeholder="Search Members" name="search" required>
            <span class="space"><br /></span>
            <button class="btn btn-primary" type="submit" name="submit">Search <span class="glyphicon glyphicon-search"></span></button>
        </form>
    </div>
    <div class="alert alert-success fade in">
            <a class="close" data-dismiss="alert" aria-label="close">
            &times
            </a>
            <?php
                if(empty($_GET['status'])){
                    echo 'Welcome To Dashboard '.ucfirst($firstname).' '.ucfirst($lastname);
                }
                else{
                    $status = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_STRING);
                    if($status == "profile saved"){
                        echo 'Your Profile is saved';
                    }
                }
            ?>
    </div>
    <?php
        if(isset($_GET['success'])){
            $success = filter_input(INPUT_GET, 'success', FILTER_SANITIZE_STRING);
            if($success == "registered"){
                echo '<div class = "alert alert success container panel-heading">Congrats you are Successfully Registered</div>';
            }
            else if($success == "password changed"){
                echo '<div class = "alert alert success container panel-heading">Password changed</div>';
            }
        }
    ?>
    <div class="row">
        <div class="col-sm-6"><a href="referral.php"><button class="btn-lg btn btn-info">Your Referrals</button></a></div>
        <span class="space"><br /></span>
        <div class="col-sm-6"><a href="display_coupons.php"><button class="btn-lg btn btn-info">My Coupons and Offers</button></a></div>
        <span class="space"><br /></span>
    </div>
</div>
</body>
</html>