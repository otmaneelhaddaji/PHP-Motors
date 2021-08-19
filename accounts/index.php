<?php
//Accounts Controller

//Get the database connection file
require_once '../library/connections.php';
//Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
//Get the accounts model for use as needed
require_once '../model/accounts-model.php';

require_once '../library/functions.php';

require_once '../model/reviews-model.php';

//Create or access a session
session_start();

//Get array of classifications
$classifications = getClassifications();

$navList = createNav($classifications);

// $action is used to store the type of content being requested. 
// filter_input() is used to eliminate harmful code.
// Check the POST and GET objects to look for name/value pairs, store the value in the $action variable

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'login':
        include '../view/login.php';

        break;

    case 'registration':
        include '../view/registration.php';

        break;

    case 'register':
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

        //Check for existing email address
        $existingEmail = checkExistingEmail($clientEmail);

        if ($existingEmail) {
            $message = '<p class="notice">That email is already registered to an account do you want to login instead?</p>';
            include '../view/login.php';
            exit;
        }

        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        //check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            $message = '<p class="error">Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit;
        }

        //hash checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        if ($regOutcome === 1) {
            // setcookie("firstname", $clientFirstname, strtotime('+1 year'), '/');

            $_SESSION['message'] = "<p class='success-msg'>Thanks for registering, $clientFirstname. Please use your email and password to login.</p>";
            header('Location: /phpmotors/accounts/?action=login');
            exit;
        } else {
            $message = "<p class='error'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }


        break;

    case 'Login':
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        if (empty($clientEmail) || empty($checkPassword)) {
            $message = '<p class="error">Please provide information for all empty form fields.</p>';
            // $message = "$clientEmail, $checkPassword";
            include '../view/login.php';
            exit;
        }

        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if (!$hashCheck) {
            $message = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;

        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Send them to the admin view
        header('location: /phpmotors/accounts/index.php?action=admin');
        exit;

        break;

    case 'admin':
        $clientReviews = getReviewsByClient($_SESSION['clientData']['clientId']);
        $clientReviewList = createEditableReviews($clientReviews);
        if (empty($clientReviews)) {
            $clientReviewList = "<p>You haven't written any reviews yet.</p>";
        }
        $_SESSION['clientReviewList'] = $clientReviewList;
        include '../view/admin.php';
        break;

    case 'logout':
        $_SESSION['loggedin'] = FALSE;
        unset($_SESSION['clientData']);
        session_destroy();

        header('Location: /phpmotors/index.php');

        //go to the update account page
    case 'updateAccountView':

        include '../view/registration-update.php';
        exit;
        break;

        //submit update account form
    case 'updateAccount':
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_STRING));

        //Check for existing email address in the database
        $existingEmail = checkExistingEmail($clientEmail);

        if (!(($clientEmail === $_SESSION['clientData']['clientEmail']))) {
            if ($existingEmail) {
                $message = '<p class="notice">That email is already registered to an account.</p>';
                include '../view/registration-update.php';
                exit;
            }
        }

        $clientEmail = checkEmail($clientEmail);


        //check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
            $message = '<p class="error">Please provide information for all empty form fields.</p>';
            include '../view/registration-update.php';
            exit;
        }

        // Send the data to the model
        $regOutcome = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

        if ($regOutcome === 1) {
            $clientData = getClient($clientEmail);
            array_pop($clientData);
            $_SESSION['clientData'] = $clientData;
            $_SESSION['message'] = "<p>Your account has been updated successfully.</p>";
            header('Location: /phpmotors/accounts/index.php?action=admin');
            exit;
        } else {
            $message = "<p class='error'>Sorry $clientFirstname, but the update failed. Please try again.</p>";
            include '../view/registration-update.php';
            exit;
        }


        break;

        break;

        //check and change the password
    case 'changePassword':
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_STRING));

        $checkPassword = checkPassword($clientPassword);

        //check for missing data
        if (empty($checkPassword)) {
            $message = '<p class="error">Please match the requested password format.</p>';
            include '../view/registration-update.php';
            exit;
        }

        //hash checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $regOutcome = changePassword($hashedPassword, $clientId);

        if ($regOutcome === 1) {

            $_SESSION['message'] = "<p class='success-msg'>Your password has been changed successfully.</p>";
            header('Location: /phpmotors/accounts/?action=admin');
            exit;
        } else {
            $message = "<p class='error'>Sorry $clientFirstname, but the password change has failed. Please try again.</p>";
            include '../view/registration-update.php';
            exit;
        }

        break;


    default:
        header('Location: /phpmotors/accounts/index.php?action=admin');
}
