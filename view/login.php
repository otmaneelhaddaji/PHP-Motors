<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
    <title>Login | PHP Motors</title>
</head>

<body>
    <div id="content">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        <nav>
            <?php echo $navList; ?>
        </nav>
        <main>
        <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
        <form action="/phpmotors/accounts/index.php" method="POST" class="login-form">
        <h1>Login</h1>
            <label for="clientEmail">Email</label><br>
            <input id="clientEmail" name="clientEmail" type="email" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>><br>

            <label for="clientPassword">Password</label><br>
            <input id="clientPassword" name="clientPassword" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
            <span class="password-hint">Passwords must have at least 8 characters, 1 capital letter, 1 lowercase letter, and 1 special character.</span>

            <br>
            <button type="submit">Login</button><br>
            <input type="hidden" name="action" value="Login">

            <a href="/phpmotors/accounts/index.php?action=registration">Don't have an account? Register here.</a>
        </form>
        </main>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </div>

</body>

</html>