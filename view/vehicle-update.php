<?php
//Only allow admins to access this page.

if (! $_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] <= 1){
    header('Location: /phpmotors/index.php');
    exit;
}

    //Create start of select dropdown
    $classificationList = "<select name='classificationName' id='classificationName'>";
    $classificationList .= "<option value='' selected disabled hidden>choose a car classification.</option>";

    //Add classification names to nav list and select dropdwon
    foreach ($classifications as $classification) {

        $classificationList .= "<option value=".urlencode($classification['classificationId']);
        if(isset($classificationId)){
            if($classification['classificationId'] === $classificationId){
                $classificationList .= ' selected ';
            }
        } elseif(isset($invInfo['classificationId'])){
            if($classification['classificationId'] === $invInfo['classificationId']){
             $classificationList .= ' selected ';
            }
           }

        $classificationList .= ">".$classification['classificationName']."</option>";
       }
       
       //finish classification list
       $classificationList .= "</select>";

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?> | PHP Motors</title>
</head>

<body>
    <div id="content">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        <nav>
            <?php echo $navList; ?>
        </nav>

        <main>
            <h1 class="form-title"><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?></h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            
            ?>
            <form action="/phpmotors/vehicles/index.php" method="POST">
                <label for="classificationName">Car Classification:</label><br>
                <?php echo $classificationList; ?><br>

                <label for="invMake">Make</label><br>
                <input type="text" id="invMake" name="invMake" required <?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }  ?>><br>

                <label for="invModel">Model</label><br>
                <input type="text" id="invModel" name="invModel" required <?php if(isset($invModel)){echo "value='$invModel'";}elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }  ?>><br>

                <label for="invDescription">Description</label><br>
                <textarea name="invDescription" id="invDescription"><?php if(isset($invDescription)){echo "$invDescription";} elseif(isset($invInfo['invDescription'])) {echo "$invInfo[invDescription]"; } ?></textarea><br>

                <label for="invImage">Image Path</label><br>
                <input type="text" id="invImage" name="invImage" <?php if(isset($invImage)){echo "value='$invImage'";} elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; } ?>><br>

                <label for="invThumbnail">Thumbnail Path</label><br>
                <input type="text" id="invThumbnail" name="invThumbnail" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }  ?>><br>

                <label for="invPrice">Price</label><br>
                <input type="number" id="invPrice" name="invPrice" required <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; } ?>><br>

                <label for="invStock"># in Stock</label><br>
                <input type="number" id="invStock" name="invStock" required <?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; } ?>><br>

                <label for="invColor">Color</label><br>
                <input type="text" id="invColor" name="invColor" required <?php if(isset($invColor)){echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; } ?>><br>

                

                <button type="submit" name="submit" id="regbtn" value="Update Vehicle">Update Vehicle</button><br>
                
                <input type="hidden" name="action" value="updateVehicle">
                <input type="hidden" name="invId" value="
                    <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
                    elseif(isset($invId)){ echo $invId; } ?>
                    ">
            </form>

        </main>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </div>

</body>

</html>