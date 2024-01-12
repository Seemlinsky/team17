<?php
/**
 * @var string[] $errors
 * @var \System\Databases\Objects\Job $job
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

<h1 class="title mt-4">Are you sure you want to delete job <em><?= $job->name; ?></em>?</h1>
<a class="button is-danger mt-4" href="<?= BASE_PATH; ?>jobs/delete?id=<?= $job->id; ?>&continue">Yes, delete!</a>
<a class="button mt-4" href="<?= BASE_PATH; ?>jobs">Go back to the list</a>
