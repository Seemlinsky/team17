<?php
/**
 * @var array $errors
 * @var \System\Databases\Objects\Unused\Genre|null $genre
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

<?php if (isset($genre)): ?>
    <h1 class="title mt-4"><?= $genre->name; ?></h1>
    <section class="content">
        <ul>
            <li>Games:
                <ul>
                    <?php foreach ($genre->games() as $game): ?>
                        <li><?= $game->name; ?></li>
                    <?php endforeach; ?>
                </ul>
            </li>
        </ul>
    </section>

<a class="button mt-4" href="<?= BASE_PATH; ?>genres/detail?id=<?= $genre->getPreviousId(); ?>">&laquo; Previous</a>
<a class="button mt-4" href="<?= BASE_PATH; ?>genres/detail?id=<?= $genre->getNextId(); ?>">Next &raquo;</a>
<br>
<?php endif; ?>

<a class="button mt-4" href="<?= BASE_PATH; ?>genres">Go back to the list</a>
