<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
    <title>Delete Review | PHP Motors</title>
</head>

<body>
    <div id="content">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        <nav>
            <?php echo $navList; ?>
        </nav>

        <main>
        <h1 class="centered-text">Delete Review</h1>
            <p class="centered-text error">Are you sure you want to delete this review? This cannot be undone.</p>
            <?php

            if (isset($message)) {
                echo $message;
            }
            

            ?>
            
        
            <form action="/phpmotors/reviews/index.php" class="review-form" method="POST">
            <h2>For: <?php echo $reviewDetails['invMake'].' '.$reviewDetails['invModel']; ?></h2>
                <label for="sName">Screen Name</label><br>
                <input type="text" id="sName" name="sName" readonly <?php if(isset($sName)){echo "value='$sName'";}?>><br>

                <label for="reviewText">Review</label><br>
                <textarea name="reviewText" id="reviewText" readonly><?php if(isset($reviewDetails['reviewText'])){echo "$reviewDetails[reviewText]";}?></textarea><br>
                

                <button class="delete-btn" type="submit" name="submit" id="regbtn" value="">Delete Review</button><br>
                
                <input type="hidden" name="action" value="deleteReview">
                <input type="hidden" name="reviewId" value="<?php echo $reviewId ?>">
            </form>
        </main>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </div>

</body>

</html>