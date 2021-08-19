<?php
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] <= 1) {
    header('Location: /phpmotors/index.php');
    exit;
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
    <title>Vehicle Management | PHP Motors</title>
</head>

<body>
    <div id="content">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        <nav>
            <?php echo $navList; ?>
        </nav>

        <main>
            <h1>Manage Vehicles</h1>
            <a href="/phpmotors/vehicles/index.php?action=add_classification">Add a new classification</a>
            <br>
            <a href="/phpmotors/vehicles/index.php?action=add_vehicle">Add a new vehicle</a>

            <?php
            if (isset($message)) {
                echo $message;
            }
            if (isset($classificationList)) {
                echo '<h2>Vehicles By Classification</h2>';
                echo '<p>Choose a classification to see those vehicles</p>';
                echo $classificationList;
            }
            ?>
            <noscript>
                <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
            </noscript>

            <table id="inventoryDisplay"></table>

        </main>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </div>
    <script src="../js/inventory.js"></script>
</body>

</html><?php unset($_SESSION['message']); ?>