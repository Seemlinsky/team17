<?php
/**
 * @var array $errors
 * @var \System\Databases\Objects\Job|null $job
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

<?php if (isset($job)): ?>
    <h1 class="title mt-4"><?= $job->name; ?></h1>
    <section class="content">
        <ul>
            <li><b>Description:</b> <?= $job->description; ?></li>
            <li>Dates:
                <ul>
                    <?php foreach ($job->dates() as $date): ?>
                        <li><?= $date->location ?> - <?= $date->datetime; ?></li>
                    <?php endforeach; ?>
                </ul>
            </li>
        </ul>
    </section>
<br>
<?php endif; ?>

<a class="button mt-4" href="<?= BASE_PATH; ?>jobs">Go back to the list</a>
