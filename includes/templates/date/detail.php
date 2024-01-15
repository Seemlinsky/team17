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

<?php if (isset($date)): ?>
    <h1 class="title mt-4"><?= $date->location . ' - ' . $date->datetime; ?></h1>
    <section class="content">
        <ul>
            <li><b>Description:</b> <?= $date->description; ?></li>
            <li><b>Jobs:</b> <?= implode(', ', $date->getJobs());?></li>
            <li><b>Size:</b> <?= $date->size; ?></li>
            <li><b>Price:</b> €<?= $date->price; ?></li>
            <li><b>User:</b> <?= User::getById($date->user_id)->name; ?></li>
        </ul>
    </section>

<?php endif; ?>

<a class="button mt-4" href="<?= BASE_PATH . 'dates'; ?>">Go back to the list</a>
