<?php
/**
 * @var string|null $pageTitle
 * @var string|null $content
 */
?>
<!doctype html>
<html lang="en">
<head>
    <title>Viktoria Schoonmaakbedrijf | <?= $pageTitle ?? ''; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?=BASE_PATH?>/includes/styles/style.css">
    <link rel="stylesheet" href="<?=BASE_PATH?>/includes/styles/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <nav>
        <div class="navlinks">
            <span class="navCompanyName">Viktoria Schoonmaakbedrijf</span>
            <a href="<?=BASE_PATH?>">Home</a>
            <a href="<?=BASE_PATH?>afspraken">Afspraken</a>
            <a href="overons">Over Ons</a>
            <a href="contact">Contact</a>
        </div>
        <?php if(!$this->session->keyExists('user')): ?>
        <div class="navLoginLinks">
            <a href="<?=BASE_PATH?>login">Login</a>
            <a href="<?=BASE_PATH?>registratie">Registreer</a>
        </div>
        <?php else: ?>
        <p>Je bent al ingelogd. <a href="<?=BASE_PATH?>logout">Uitloggen?</a></p>
        <?php endif; ?>
    </nav>
</header>
<div class="container px-4">
    <?= $content ?? ''; ?>
</div>
<footer>
    <div class="footerdiv">
        <div>
            <div>
                www.viktoriaschoonmaakbedrijf.com
            </div>
            <div>
                Neem contact op: nummer
            </div>

        </div>

        <div>
            <div class="linkdiv">
                <p> Meer weten? <a href="overons">Over ons</a></p>

            </div>
        </div>
    </div>

</footer>
</body>
</html>
