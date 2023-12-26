<?php
include "user.php";
$classFunction = new Users();

if (isset($_SESSION['data'])) {
    return header('Location:index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="login.css" rel="stylesheet" type="text/css" />
</head>
<body class="body-login">
    <div class="container-login">
                    <h1 class="h1-login">Login</h1>
                    <div>
                        <?php
                        if (isset($_SESSION['pesan'])) {
                            echo '<div class="alert-login">' . $_SESSION['pesan'] . '</div>';
                            unset($_SESSION['pesan']);
                        }
                        ?>
                    </div>
                    
                        <!-- Email -->
                    <form class="form-login" action="process.php?param=login" method="post">
                        <div>
                            <label for="email" class="label-login"><b>Email</b></label>
                            <input type="email" class="input-login" id="email" name="email" required placeholder="Masukkan Email Anda">
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="label-login"><b>Password</b></label>
                            <input type="password" class="input-login" id="password" name="password" required placeholder="Masukkan Password Anda">
                        </div>

                        <button type="submit" class="button-login">Login</button>
                    </form>
    </div>
</body>
</html>