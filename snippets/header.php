<header id="page_header">
    <div class="header-top">
        <a href="/phpmotors/index.php"><img src="/phpmotors/images/site/logo.png" alt="PHP Motors Logo"></a>
        <div class="profile-links">
        <?php 
        if(isset($_SESSION['loggedin'])){
            echo "<a href='/phpmotors/accounts/index.php?action=admin' class='welcome'>Welcome, ". $_SESSION['clientData']['clientFirstname']."</a>";
            echo '<a href="/phpmotors/accounts/index.php?action=logout" class="logout">Logout</a>';
        } else {
            echo '<a href="/phpmotors/accounts/index.php?action=login" class="my-account-link">My Account</a>';
        }   
        ?>
        </div>
    </div>
</header>