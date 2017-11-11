<?php
    session_start();
    if(isset($_SESSION['email'])){
        header('location: dashboard.php');
        die();
    }
    $pageTitle = "Verification | Advocate Portal";
    include 'inc/connect.php';
    include 'inc/header.php';
    $code = $_SESSION['code'];
?>
<?php
            if(isset($_GET['error'])){
                $error = filter_input(INPUT_GET, 'error', FILTER_SANITIZE_STRING);
                if($error == "not match"){
                    echo "<div class='alert alert-danger container content'>Verification Code not Match Try Again</div></body></html>";
                    die();
                }
            }
        ?>
<script type="text/javascript">
    alert("mail is sent to your email id, check in your inbox and spam for verification code");
    var code = "<?php echo $code;?>";
    alert(code);
    function check(){
        var check_code = document.getElementById('v_code').value;
        if(check_code === code){
            window.location="scripts/final_reg.php";
        }
        else{
            window.location="register.php?error=not match";
        }
    }
</script>
    <div class="content">
        <input type="text" id="v_code">
        <button type="button" onclick="check()">Submit</button>
    </div>
</body>
</html>