<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php require 'toolbar.php'; ?>
        <form id="registerForm" 
              action="checkRegister.php" 
              method="POST" 
              onsubmit="return validateRegistration(this);">
            <table border="0">
                <tbody>
                    <tr>
                        <td>Username</td>
                        <td>
                            <input type="text" name="username" value="" />
                            <span id="usernameError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['username'])) {
                                    echo $errorMessage['username'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>
                            <input type="password" name="password" value="" />
                            <span id="passwordError" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['password'])) {
                                    echo $errorMessage['password'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Confirm Password</td>
                        <td>
                            <input type="password" name="password2" value="" />
                            <span id="password2Error" class="error">
                                <?php
                                if (isset($errorMessage) && isset($errorMessage['password2'])) {
                                    echo $errorMessage['password2'];
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Register" name="register" />
                        </td>
                    </tr>
                </tbody>
            </table>

        </form>
        <script type="text/javascript" src="js/register.js"></script>
    </body>
</html>
