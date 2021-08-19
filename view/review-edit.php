<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
    <title>Edit Review | PHP Motors</title>
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
            <h1 class="centered-text">Edit Review</h1>
            <form class="review-form" action="/phpmotors/reviews/index.php" method="POST">
       <h3>For: <?php echo $reviewDetails['invMake'].' '.$reviewDetails['invModel']; ?></h3>
           <label for="sName">Screen Name</label><br>
           <input id="sName" name="sName" type="text" value="<?php echo $sName?>" disabled required><br>
   
           <label for="reviewText">Your Review</label><br>
           <textarea name="reviewText" id="reviewText" placeholder="Write your review here" required><?php echo $reviewDetails['reviewText']; ?></textarea>
   
           <button type="submit">Update Your Review</button><br>
           <input type="hidden" name="action" value="updateReview">
           <input type="hidden" name="reviewId" value=<?php echo $reviewDetails['reviewId']?>>
       </form>


        </main>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </div>

</body>

</html>