<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
    <title><?php echo "$carDetails[invMake] $carDetails[invModel]";?> | PHP Motors</title>
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
        <h1><?php echo "$carDetails[invMake] $carDetails[invModel]";?></h1>
        <?php
            echo '<div class=\'display-with-thumbnails\'>';
            echo $carDetailsHtml;
            echo '<h3 class="thumbnails-heading">Images</h3>';
            echo $thumbnailsHtml;
            
            echo '</div>';
        ?>
        <hr>
        <div class="reviews">
            <h2 class="centered-text">Customer Reviews</h2>
            <?php
            //display review form if logged in. Display login link if not logged in. 
            if ($_SESSION['loggedin']){
                echo $reviewForm;
            } else {
                echo "<p class=\"centered-text\">Only users who are logged in can write a review. Please <a href='/phpmotors/accounts/index.php?action=login'>Log In</a> to leave a review for this vehicle.</p>";
            }
            //Display reviews if exist, "write the first review" if not
            echo $vehicleReviewsHtml;
            
            ?>
        </div>
        </main>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </div>

</body>

</html>