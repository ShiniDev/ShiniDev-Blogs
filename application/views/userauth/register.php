<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url() ?>assets/Shinidev.jpg">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/variables.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/userauth/userauth.css">
    <title>Shinidev</title>
</head>

<body>
    <div class="flex-container flex-center">
        <?= form_open('userauth/register', 'class=login-form onkeyup=checkPassword()') ?>
        <h3>Register</h3>
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Username" minlength="3" required>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" minlength="4" required>
        <label for="re-password">Retype password</label>
        <input type="password" name="re-password" placeholder="Retype password" minlength="4" required>
        <div class="flex-container checkbox-container">
            <input onchange="showPassword()" type="checkbox" name="visible-pass">
            <p>Show password</p>
        </div>
        <input type="submit" name="register-submit" value="Register" disabled>
        <div class="flex-container">
            <a href="<?= base_url() ?>userauth/login" class="login">Login</a>
            <p class="copyright">&copy; shinidev 2021</p>
        </div>
        <?= form_close() ?>
    </div>
    <script src="<?= base_url() ?>js/userauth/helper.js"></script>
</body>

</html>