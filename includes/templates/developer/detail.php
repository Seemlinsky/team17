<?php
/**
 * @var array $errors
 * @var \System\Databases\Objects\Developer|null $developer
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

<?php if (isset($developer)): ?>
    <h1 class="title mt-4"><?= $developer->name; ?></h1>
    <section class="content">
        <ul>
            <li>Games:
                <ul>
                    <?php foreach ($developer->games() as $game): ?>
                        <li><?= $game->name; ?></li>
                    <?php endforeach; ?>
                </ul>
            </li>
        </ul>
    </section>
<a class="button mt-4" href="<?= BASE_PATH; ?>developers/detail?id=<?= $developer->getPreviousId(); ?>">&laquo; Previous</a>
<a class="button mt-4" href="<?= BASE_PATH; ?>developers/detail?id=<?= $developer->getNextId(); ?>">Next &raquo;</a>
<br>
<?php endif; ?>
<a class="button mt-4" href="<?= BASE_PATH; ?>developers">Go back to the list</a>
