<?php
    session_start();
    if(isset($_SESSION['email'])){
        header('location: dashboard.php');
        die();
    }
    session_unset();
    session_destroy();
    $pageTitle = "Login | Advocate Portal";
    include 'inc/header.php';
?>
        <div class="container my_panel">
            <div class="col-sm-offset-3 col-sm-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h2>Login</h2><hr />
                        <img src="images/ad.png"  id = "ico" />
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="scripts/login_script.php">
                            <div class="form-group has-feedback">
                                <input type="email" placeholder="Email" class="input form-control" name="email" required>
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                            <br />
                            <div class="form-group has-feedback">
                                <input type="password" placeholder="Password" class="input form-control" name="password" required>
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <hr />
                            <?php include 'inc/panel_info.php';?>
                            <div class="form-group button_pos">
                                <button type="submit" class="btn btn-primary" >Login</button>
                            </div>
                            <?php
                                if(isset($_GET['error'])){
                                    $error = filter_input(INPUT_GET, 'error', FILTER_SANITIZE_STRING);
                                    if($error = "invalid user"){
                                        echo '<div class="alert alert-danger seperate">Username or Password is Incorrect</div>';
                                    }
                                    else if($error == "database error"){
                                        echo '<div class="alert alert-danger seperate">Sorry, Some Error has occured</div>';
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
