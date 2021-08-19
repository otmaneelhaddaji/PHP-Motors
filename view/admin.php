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
    <title>Client Admin Portal</title>
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
</head>
<body>
    <div id="content">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        <nav>
            <?php echo $navList; ?>
        </nav>

        <main>
            <h1><?php echo $_SESSION['clientData']['clientFirstname'].' '.$_SESSION['clientData']['clientLastname']; ?></h1>
            <p>You are logged in.</p>
            <?php echo $_SESSION['message'];
                if (isset($message)){
                    echo $message;
                }
                unset($_SESSION['message']);
            ?>
            <ul class="client-info-list">
                <?php 
                    echo "<li>First name:  " . $_SESSION["clientData"]["clientFirstname"] . "</li>";
                    echo "<li>Last name: ". $_SESSION['clientData']['clientLastname']."</li>";
                    echo "<li>Email: ". $_SESSION['clientData']['clientEmail']."</li>";
                ?>
            </ul>
            
            <h2 class="small-heading">Use this link to update your account information.</h2>
            <a class='client-link' href="/phpmotors/accounts/index.php?action=updateAccountView">Update Account Information</a>

            <?php 
            if ($_SESSION['clientData']['clientLevel'] > 1){
                echo "<h2 class='small-heading'>Use this link to to administer inventory.</h2>";
                echo "<a class='client-link' href='/phpmotors/vehicles'>Manage Vehicles</a><br>";
                echo "<a class='client-link' href='/phpmotors/uploads'>Upload Pictures</a>";
            }
            ?>
            <h2>Reviews</h2>
            <!-- Provide a way to update and delete reviews -->
            <?php
                echo $_SESSION['clientReviewList'];
            ?>

        </main>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </div>

</body>

</html>

