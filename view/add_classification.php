<?php
if (! $_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] <= 1){
    header('Location: /phpmotors/index.php');
    exit;
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
    <title>Add Classification | PHP Motors</title>
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

            <h1 class="form-title">Add Classification</h1>
            <form action="/phpmotors/vehicles/index.php" method="POST">
                <label for="classificationName">New Classification Name</label><br>
                <input id="classificationName" name="classificationName" type="text" required ><br>

                <button type="submit" name="submit" id="regbtn" value="add_classification">Add New Classification</button><br>
                
                <input type="hidden" name="action" value="add_classification_to_db">
            </form>
        </main>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </div>

</body>

</html>