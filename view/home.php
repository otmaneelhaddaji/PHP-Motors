<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/style.css" media="screen">
    <title>Home | PHP Motors</title>
</head>

<body>
    <div id="content">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        <nav>
            <?php echo $navList; ?>
        </nav>

        <main>
            <h1>Welcome to PHP Motors!</h1>
            <div>
                <div class="car-description">
                    <h2>DMC Delorean</h2>
                    <p>3 Cup holders</p>
                    <p>Superman doors</p>
                    <p>Fuzzy dice!</p>
                </div>
                <div class="img-and-button">
                    <button class="cta">Own Today</button>
                    <img src="/phpmotors/images/vehicles/delorean.jpg" alt="DMC Delorean" class="product-image">
                </div>
            </div>
            <div class="ugly-screen-bottom">
                <div class="reviews-wrapper">
                    <h2>DMC Delorean Reviews</h2>
                    <ul class="reviews">
                        <li>"So fast its almost like traveling in time." (4/5)</li>
                        <li>"Coolest ride on the road." (4/5)</li>
                        <li>"I'm feeling Marty McFly! (5/5)</li>
                        <li>"The most futuristic ride of our day" (4.5/5)</li>
                        <li>"80's livin and I love it!" (5/5)</li>
                    </ul>

                </div>
                <div class="upgrades-wrapper">
                    <h2>Delorean Upgrades</h2>
                    <div class="upgrades-grid">
                        <div class="upgrade-card">
                            <div class="image-box"><img src="/phpmotors/images/upgrades/flux-cap.png" alt=""></div>
                            <a href="#">Flux Capacitor</a>
                        </div>
                        <div class="upgrade-card">
                            <div class="image-box"><img src="/phpmotors/images/upgrades/flame.jpg" alt=""></div>
                            <a href="#">Flame Decals</a>
                        </div>
                        <div class="upgrade-card">
                            <div class="image-box"><img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt=""></div>
                            <a href="#">Bumper Stickers</a>
                        </div>
                        <div class="upgrade-card">
                            <div class="image-box"><img src="/phpmotors/images/upgrades/hub-cap.jpg" alt=""></div>
                            <a href="#">Hub Caps</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </div>

</body>

</html>