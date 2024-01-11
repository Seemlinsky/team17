<?php
/**
 * @var string[] $errors
 * @var \System\Databases\Objects\Game $game
 */
?>
<?php if (!empty($errors)): ?>
    <section class="content">
        <ul class="notification is-danger">
            <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php endif; ?>

<?php if (isset($game)): ?>
    <h1 class="title mt-4"><?= $game->developers_name . ' - ' . $game->name; ?></h1>
    <img class="image is-128x128" src="<?= BASE_PATH; ?>images/<?= $game->image; ?>" alt="<?= $game->name; ?>"/>
    <section class="content">
        <ul>
            <li><b>Description:</b> <?= $game->description; ?></li>
            <li><b>Genres:</b> <?= implode(', ', $game->getGenres());?></li>
            <li><b>Year:</b> <?= $game->year; ?></li>
            <li><b>Rating:</b> <?= $game->rating; ?></li>
        </ul>
    </section>

<a class="button mt-4" href="<?= BASE_PATH; ?>games/detail?id=<?= $game->getPreviousId(); ?>">&laquo; Previous</a>
<a class="button mt-4" href="<?= BASE_PATH; ?>games/detail?id=<?= $game->getNextId(); ?>">Next &raquo;</a>
<br>
<?php endif; ?>

<a class="button mt-4" href="<?= BASE_PATH . 'games'; ?>">Go back to the list</a>
