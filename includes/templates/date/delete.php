<?php
/**
 * @var string[] $errors
 * @var \System\Databases\Objects\Unused\Game $game
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

<h1 class="title mt-4">Are you sure you want to delete game <em><?= $game->name; ?></em> from <em><?= $game->developers_name; ?></em>?</h1>
<a class="button is-danger mt-4" href="<?= BASE_PATH; ?>games/delete?id=<?= $game->id; ?>&continue">Yes, delete!</a>
<a class="button mt-4" href="<?= BASE_PATH; ?>games">Go back to the list</a>
