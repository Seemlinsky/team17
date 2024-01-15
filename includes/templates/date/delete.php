<?php
/**
 * @var string[] $errors
 * @var \System\Databases\Objects\Date $date
 */

use System\Databases\Objects\User;

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

<h1 class="title mt-4">Are you sure you want to delete date <em><?= $date->location; ?></em> from <em><?= User::getById($date->user_id)->name; ?></em>?</h1>
<a class="button is-danger mt-4" href="<?= BASE_PATH; ?>dates/delete?id=<?= $date->id; ?>&continue">Yes, delete!</a>
<a class="button mt-4" href="<?= BASE_PATH; ?>dates">Go back to the list</a>
