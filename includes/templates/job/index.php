<?php
/**
 * @var array $errors
 * @var int $totalJobs
 * @var \System\Databases\Objects\Job[] $jobs
 */
?>
<h1 class="title mt-4">Jobs</h1>
<?php if (!empty($errors)): ?>
    <section class="content">
        <ul class="notification is-danger">
            <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php endif; ?>

<a class="button is-primary" href="<?= BASE_PATH; ?>">&laquo; Back home</a>
<a class="button" href="<?= BASE_PATH; ?>jobs/create">Create new job</a>
<table class="table is-striped mt-4">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Price</th>
        <th>Total Dates</th>
        <th colspan="3"></th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="7" class="has-text-centered">&copy; My Collection with <?= $totalJobs; ?> jobs</td>
    </tr>
    </tfoot>
    <tbody>
    <?php foreach ($jobs as $job): ?>
        <tr>
            <td><?= $job->id; ?></td>
            <td><?= $job->name; ?></td>
            <td>€<?= number_format($job->price, 2, '.', '');; ?></td>
            <td><?= count($job->dates()); ?></td>
            <td><a href="<?= BASE_PATH; ?>jobs/detail?id=<?= $job->id; ?>">Details</a></td>
            <td><a href="<?= BASE_PATH; ?>jobs/edit?id=<?= $job->id; ?>">Edit</a></td>
            <td><a href="<?= BASE_PATH; ?>jobs/delete?id=<?= $job->id; ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
