<?php
    if(! $_SESSION['loggedin']){
        header('Location: /phpmotors/index.php');

    }

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
    <title>Update Account Info | PHP Motors</title>
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
            <h1 class="centered">Update Account Information</h1>
            
            <!-- account info form -->
            <h2 class="centered">Name and Contact Info</h2>
            <form action="/phpmotors/accounts/index.php" method="post">
            <label for="clientFirstname">First Name*</label><br>
                <input id="clientFirstname" name="clientFirstname" type="text" required <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} elseif(isset($_SESSION['clientData'])) {echo "value=".$_SESSION['clientData']['clientFirstname'].""; } ?>><br>

                <label for="clientLastname">Last Name*</label><br>
                <input id="clientLastname" name="clientLastname" type="text" required <?php if(isset($clientLastname)){echo "value='$clientLastname'";} elseif(isset($_SESSION['clientData'])) {echo "value=".$_SESSION['clientData']['clientLastname'].""; } ?>><br>

                <label for="clientEmail">Email*</label><br>
                <input id="clientEmail" name="clientEmail" type="email" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";} elseif(isset($_SESSION['clientData'])) {echo "value=".$_SESSION['clientData']['clientEmail'].""; } ?>><br>

                <button type="submit" name="submit" value="Update Account">Update Account</button><br>
                
                <input type="hidden" name="action" value="updateAccount">
                <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId']?>">

                
            </form>
            <?php
            if (isset($message)) {
                echo $message;
               }

            ?>
            <!-- password update form -->
            <h2 class="centered">Change Password</h2>
            <form action="/phpmotors/accounts/index.php" method="post">
            <label for="clientPassword">Password*</label><br>
                <input id="clientPassword" name="clientPassword" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
                <span class="password-hint">This will change your current password. New passwords must have at least 8 characters, 1 capital letter, 1 lowercase letter, and 1 special character.</span><br>

                <button type="submit" name="submit" value="Update Password">Change Password</button><br>
                
                <input type="hidden" name="action" value="changePassword">
                <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId']?>">
        </form>
        </main>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </div>

</body>

</html>
