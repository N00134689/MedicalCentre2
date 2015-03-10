<?php
if (!isset($username)) {
    $username = '';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/login.js"></script>
        <?php require "styles.php" ?>
        <title></title>
    </head>
    <body>
        <?php require 'toolbar.php' ?>
        <?php require 'header.php' ?>
        <?php require 'mainMenu.php' ?>
        <div class="container">
            <form id="loginForm" class="form-horizontal" role="form" action="login.php" method="POST">
                <fieldset>
                    <legend>Welcome back! Please sign in</legend>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="username">Username</label>
                        <div class="col-sm-5">
                            <input type="text"
                                   name="username"
                                   class="form-control"
                                   value="<?php echo $username; ?>" />
                        </div>
                        <div class="col-sm-5">
                            <span id="usernameError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['username'])) {
                                    echo $errorMessage['username'];
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="username">Password</label>
                        <div class="col-sm-5">
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   value="" />
                        </div>
                        <div class="col-sm-5">
                            <span id="passwordError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['password'])) {
                                    echo $errorMessage['password'];
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label"></label>
                        </div>
                        <div class="col-sm-5">
                            <button type="submit" name="loginBtn" id="loginBtn" class="btn btn-success">Login</button>
                            <a href="registerForm.php" class="btn">Register</a>
                            <a href="forgotPasswordForm.php" class="btn">Forgot Password</a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <?php require 'footer.php'; ?>
        <?php require 'scripts.php'; ?>
    </body>
</html>
