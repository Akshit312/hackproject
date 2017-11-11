<?php
    session_start();
    if(isset($_SESSION['email'])){
        header('location: dashboard.php');
        die();
    }
    session_unset();
    session_destroy();
    $pageTitle = "Signup | Advocate Portal";
    include 'inc/connect.php';
    include 'inc/header.php';
?>
        <div class="container my_panel">
            <div class="col-sm-offset-3 col-sm-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h2>Sign Up</h2><hr />
                        <img src="images/adico.png"  id = "ico" />
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="scripts/signup_script.php">
                            <div class="form-group has-feedback">
                                <input name="firstname" type="text" placeholder="First Name" class="input form-control" required>
                            </div>
                            <div class="form-group has-feedback">
                                <input name="lastname" type="text" placeholder="Last Name" class="input form-control" required>
                            </div>
                            <div class="form-group has-feedback">
                                <input name="email" type="email" placeholder="Email" class="input form-control" required>
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input name="password" type="password" placeholder="Password" class="input form-control" required>
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="form-group">
                                <input name="ref" type="text" placeholder="Referral Code(Optional)" class="input form-control">
                            </div>
                            <hr />
                            <?php include 'inc/panel_info.php';?>
                            <div class="form-group button_pos">
                                <button type="submit" class="btn btn-primary">Sign Up</button>
                            </div>
                            <?php
                                if(isset($_GET['error'])){
                                    $error = filter_input(INPUT_GET, 'error', FILTER_SANITIZE_STRING);
                                    if($error == "Invalid Email"){
                                        echo '<div class="alert alert-danger seperate">This email is already registered Please Try another email.</div>';
                                    }
                                    else if($error == "corrupt email"){
                                        echo '<div class="alert alert-danger seperate">This email is not a valid email Please Try another email.</div>';
                                    }
                                    else if($error == "invalid ref"){
                                        echo '<div class="alert alert-danger seperate">This Referral code not valid, Please Try another.</div>';
                                    }
                                }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>                                            
</html>