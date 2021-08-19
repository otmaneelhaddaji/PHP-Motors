<?php
// This is the controller for reviews

//Get the database connection file
require_once '../library/connections.php';
//Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
//Get the reviews model
require_once '../model/reviews-model.php';

require_once '../library/functions.php';

//Create or access a session
session_start();

//get array of classifications
$classifications = getClassifications();

$navList = createNav($classifications);


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
$action = filter_input(INPUT_GET, 'action');
}

switch ($action){
    //add a new review
    case "addReview":
        $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));

        if(empty($reviewText)){
            $message = '<p class="error">Please fill in all empty fields</p>';
            header("Location: http://localhost/phpmotors/vehicles/index.php?action=getDetails&invid=$invId");
            exit;
        }

        $outcome = insertReview($invId, $clientId, $reviewText);
        if($outcome === 1){
            $message = "Thank you for reviewing this vehicle!";
            header("Location: http://localhost/phpmotors/vehicles/index.php?action=getDetails&invid=$invId");
            exit;
        } 
        else {
            $message = "<p class='error'>Something is wrong. Your review could not be added</p>";
            header("Location: http://localhost/phpmotors/vehicles/index.php?action=getDetails&invid=$invId");
            exit;
        }
        break;

    //deliver a view to edit a review
    case "editView":
        $reviewId = trim(filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
        
        $reviewDetails = getReview($reviewId)[0];
        $sName = getScreenName($reviewDetails['clientFirstname'], $reviewDetails['clientLastname']);
        include "../view/review-edit.php";
        break;

    //handle the review to update
    case "updateReview":
        $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
        $reviewId = trim(filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
        $reviewDetails = getReview($reviewId)[0];
        $sName = getScreenName($reviewDetails['clientFirstname'], $reviewDetails['clientLastname']);
        
        if(empty($reviewText)){
            $message = '<p class="error">Please fill in all empty fields</p>';
            
            include "../view/review-edit.php";
            exit;
        } elseif ($reviewText == $reviewDetails['reviewText']){
            $message = '<p class="error">You need to change your review to submit this form</p>';
            include "../view/review-edit.php";
            exit;
        }

        $outcome = updateReview($reviewId, $reviewText);
        
        if($outcome === 1){
            $_SESSION['message'] = "<p class='notice'>Your review was updated!</p>";
            
            header ("Location: /phpmotors/accounts/index.php?action=admin");
            exit;
        } 
        else {
            $message = "<p class='error'>Something is wrong. Your review could not be changed</p>";
            include "../view/review-edit.php";
            exit;
        }
        break;

    //deliver a view to confirm deletion of a review
    case "deleteConfirmView":
        $reviewId = trim(filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT));
        $reviewDetails = getReview($reviewId)[0];
        $sName = getScreenName($reviewDetails['clientFirstname'], $reviewDetails['clientLastname']);
        include "../view/review-delete.php";
        break;

    //handle review deletion
    case "deleteReview":
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteReview($reviewId);
        if ($deleteResult) {
            $message = "<p class='notice'>The review was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/index.php?action=admin');
            exit;
        } else {
            $message = "<p class='error'>Error: review was not
        deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts');
            exit;
        }


        break;

    //Deliver admin view if loggged in or home view if not
    default: 
        if ($_SESSION['loggedin']){
            include '../view/admin.php';
        }
        else{
            include '../view.home.php';
        }
        break;
}

?>