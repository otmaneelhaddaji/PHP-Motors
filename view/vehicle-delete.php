<?php
//Only allow admins to access this page.

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
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
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
		echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Delete $invMake $invModel"; }?></h1>
            <p class="delete">Confirm Vehicle Deletion. This delete is permanent and cannot be undone.</p>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form action="/phpmotors/vehicles/index.php" method="POST">
                <label for="classificationName">Car Classification:</label><br>
                <?php echo $classificationList; ?><br>

                <label for="invMake">Make</label><br>
                <input type="text" id="invMake" name="invMake" readonly<?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }  ?>><br>

                <label for="invModel">Model</label><br>
                <input type="text" id="invModel" name="invModel" readonly<?php if(isset($invModel)){echo "value='$invModel'";}elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }  ?>><br>

                <label for="invDescription">Description</label><br>
                <textarea name="invDescription" id="invDescription" readonly><?php if(isset($invDescription)){echo "$invDescription";} elseif(isset($invInfo['invDescription'])) {echo "$invInfo[invDescription]"; } ?></textarea><br>
                

                <button class="delete-btn" type="submit" name="submit" id="regbtn" value="Update Vehicle">Delete Vehicle</button><br>
                
                <input type="hidden" name="action" value="deleteVehicle">
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