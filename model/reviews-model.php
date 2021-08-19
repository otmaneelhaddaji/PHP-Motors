<?php
//the model for reviews

//insert a review
function insertReview($invId, $clientId, $reviewText){
    // Create a connection object using the phpmotors connection function
    
    $db = phpmotorsConnect();
    
    // The SQL statement
    $sql = 'INSERT INTO reviews (reviewText, invId, clientId)
    VALUES (:reviewText, :invId, :clientId)';
    // Create the prepared statement using the phpmotors connection
    
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is

    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    // $stmt->bindValue(':reviewDate', $date, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);

    // Insert the data
    $stmt->execute();
    
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    
    return $rowsChanged;
}

//get reviews for a specific inventory item as well as client name
function getReviewsByVehicle($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT 
                reviews.*, clients.clientFirstname, clients.clientLastname, clients.clientId
            FROM
                reviews, clients
            WHERE 
                reviews.invId = :invId
            AND
	            reviews.clientId = clients.clientId
            ORDER BY reviews.reviewDate DESC;';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->execute();
    $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}

//get reviews written by a specific client, get vehicle name that each review goes with
function getReviewsByClient($clientId){
    $db = phpmotorsConnect();
    $sql = 'SELECT 
                reviews.*, clients.clientFirstname, clients.clientLastname, clients.clientId, inventory.invId, inventory.invMake, inventory.invModel
            FROM
                reviews, clients, inventory
            WHERE 
                clients.clientId = :clientId
            AND 
                clients.clientId = reviews.clientId
            AND
                reviews.invId = inventory.invId
            ORDER BY reviews.reviewDate DESC;';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
    $stmt->execute();
    $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}

//get a specific review, including name of vehicle it is for
function getReview($reviewId){
    $db = phpmotorsConnect();
    $sql = 'SELECT 
                reviews.*, inventory.invMake, inventory.invModel, inventory.invId, clients.clientFirstname, clients.clientLastname, clients.clientId
            FROM 
                reviews, inventory, clients
            WHERE 
                reviews.reviewId = :reviewId
            AND
                inventory.invId = reviews.invId
            AND
                clients.clientId = reviews.clientId';

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_STR);
    $stmt->execute();
    $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}

//update a specific review
function updateReview($reviewId, $reviewText){
    $db = phpmotorsConnect();
    
    // The SQL statement
    $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';
    // Create the prepared statement using the phpmotors connection
    
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_STR);

   
    // Insert the data
    $stmt->execute();
    
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    
    return $rowsChanged;
}

//delete a specific review
function deleteReview($reviewId){
    // Create a connection object using the phpmotors connection function
            
    $db = phpmotorsConnect();
            
    // The SQL statement
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    // Create the prepared statement using the phpmotors connection

    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is

    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);

    // Insert the data
    $stmt->execute();

    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)

    return $rowsChanged;
}

?>