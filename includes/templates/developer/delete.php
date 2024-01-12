<?php
/**
 * @var string[] $errors
 * @var \System\Databases\Objects\Unused\Developer $developer
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

<h1 class="title mt-4">Are you sure you want to delete developer <em><?= $developer->name; ?></em>?</h1>
<a class="button is-danger mt-4" href="<?= BASE_PATH; ?>developers/delete?id=<?= $developer->id; ?>&continue">Yes, delete!</a>
<a class="button mt-4" href="<?= BASE_PATH; ?>developers">Go back to the list</a>
