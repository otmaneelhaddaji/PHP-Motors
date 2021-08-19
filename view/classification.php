<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
    <title><?php echo $classificationName; ?> vehicles | PHP Motors</title>

</head>

<body>
    <div id="content">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        <nav>
            <?php echo $navList; ?>
        </nav>

        <main>
            <h1><?php echo $classificationName; ?> vehicles</h1>
            <?php if(isset($message)){ echo $message; }
            if(isset($vehicleDisplay)){echo $vehicleDisplay;}
            ?>
            
        </main>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </div>

</body>

</html>