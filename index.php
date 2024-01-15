<?php
//Require needed files
require_once 'includes/config/settings.php';
require_once 'vendor/autoload.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <?php
        include_once 'includes/templates/nav.php';
    ?>
</header>
<main>
    <div>
        <section class="leftColumnHomePage">
            <h1 class="h1HomePage">Find the best cleaning service</h1>
            <p>
                Welkom bij Viktoria Schoonmaakbedrijf, waar we geloven in het bieden van hoge kwaliteit
                voor een lage kwantiteit. Onze toewijding aan uitmuntendheid betekent dat we streven naar
                een vlekkeloos resultaat. Wij zijn toegewijd aan het leveren van hoogwaardige
                schoonmaakdiensten, waardoor uw leef- en werkomgeving straalt met frisheid.
                Ontdek een wereld van vlekkeloze reinheid met Viktoria Schoonmaakbedrijf - waar
                elk detail telt en uw tevredenheid onze prioriteit is.
            </p>
        </section>
    </div>
    <div class="rightColumnHomePage">
        <section>
            <img src="images/cleaningImage.png" alt="cleaningImage">
        </section>
    </div>
</main>
</body>
</html>
