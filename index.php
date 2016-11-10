<!DOCTYPE html>
<?php
require_once('conn.php');
global $statusMsg1;

session_start();
if (isset($_SESSION["user"]))
    header('Location: homepage.php');

if (isset($_POST["submit"])) { {
// username and password sent from form
        $username = mysqli_real_escape_string($conn, stripslashes($_POST['username']));
        $password = mysqli_real_escape_string($conn, stripslashes($_POST['password']));

        $sql = "SELECT * FROM `user` WHERE `username`='$username' and `password`='$password'";
        $result = $conn->query($sql);
        if (!$result) { // add this check.
            die('Invalid query: ' . mysql_error());
        }
        $row = $result->fetch_assoc();
        if ($row) {
            $_SESSION['user'] = $row['username'];
            header("Location: homepage.php");
        } else {
            $statusMsg1 = "<center><font color='red'>Invalid username or password.Please try again.</font></center>";
        }
    }
}
?>
<html >
    <head>
        <meta charset="UTF-8">
        <title>Cooking Mummy</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- form validation script -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.js"></script>
        <link rel="stylesheet" href="css/login&register.css">
    </head>
    <body>
        <?php include('headerToLogin&Register.php'); ?>
        <div id="wrap">  
            <div class="form">
                <h2>Log In</h2>
                <form role="form" action="index.php" method="POST" name="login" data-toggle="validator" accept-charset="UTF-8">
                    <div class="form-group row">
                        <label for="username" class="control-label col-sm-3 col-form-label"><h3>Username</h3></label>
                        <div class="col-sm-9">
                            <input required type="text" name="username" placeholder="Username" class="form-control" />
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Password" class="control-label col-sm-3 col-form-label"><h3>Password</h3></label>
                        <div class="col-sm-9">
                            <input required type="password" name="password" placeholder="Password" class="form-control" />
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <p class="forgot"><a href="/forgot">Forgot Password?</a></p>
                    <button type="submit" value="submit" class="btn btn-success button button-block" name="submit" >Log In</button>
                    <hr>
                    <button type="button" class="btn btn-danger button button-block"  onclick="location.href = 'registerPage.php';">Register</button>
                </form>
                <div class="clearfix"></div>
                <br><br>
                <?php echo $statusMsg1; ?>
            </div>
        </div>
        <?php include('footer.inc.php'); ?>
    </body>
</html>
