<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="icon" href="<?= base_url() ?>assets/Shinidev.jpg">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/variables.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/userauth/userauth.css">
    <title>Shinidev</title>
</head>

<body>
    <div class="flex-container flex-center">
        <?= form_open('userauth/login', 'class=login-form') ?>
        <h3>Login</h3>
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Username" minlength="3" required>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" minlength="4" required>
        <div class="flex-container checkbox-container">
            <input onchange="showPassword()" type="checkbox" name="visible-pass">
            <p>Show password</p>
        </div>
        <?php if (isset($error_msg)) { ?>
            <div class="flex-container error-container">
                <!-- <p class="close-button">x</p> -->
                <p class="error-msg"><?= $error_msg ?></p>
            </div>
        <?php } ?>
        <input type="submit" name="login-submit" value="Login">
        <div class="flex-container flex-center">
            <!-- <a href="<?= base_url() ?>userauth/register" class="register">Register</a> -->
            <p class="copyright">&copy; shinidev 2021</p>
        </div>
        <?= form_close() ?>
    </div>
    <script src="<?= base_url() ?>js/userauth/helper.js"></script>
</body>

</html>