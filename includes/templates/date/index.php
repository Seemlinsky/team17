<?php
/**
 * @var string[] $errors
 * @var int $totalDates
 * @var \System\Databases\Objects\Date[] $dates
 */
?>
<h1 class="title mt-4">Date Collection</h1>
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
<a class="button" href="<?= BASE_PATH; ?>dates/create">Create new date</a>
<table class="table is-striped mt-4">
    <thead>
    <tr>
        <th>#</th>
        <th>Location</th>
        <th>Date</th>
        <th>Job(s)</th>
        <th>Size</th>
        <th>Price</th>
        <th colspan=3"></th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="10" class="has-text-centered">&copy; My Collection with <?= $totalDates; ?> dates</td>
    </tr>
    </tfoot>
    <tbody>
    <?php foreach ($dates as $date): ?>
        <tr>
            <td class="is-vcentered"><?= $date->id; ?></td>
            <td class="is-vcentered"><?= $date->location; ?></td>
            <td class="is-vcentered"><?= $date->datetime; ?></td>
            <td class="is-vcentered"><?= implode(', ', $date->getJobs()); ?></td>

            <td class="is-vcentered"><?= $date->size; ?></td>
            <td class="is-vcentered">€<?= $date->price; ?></td>
            <td class="is-vcentered"><a href="<?= BASE_PATH; ?>dates/detail?id=<?= $date->id; ?>">Details</a></td>
            <td class="is-vcentered"><a href="<?= BASE_PATH; ?>dates/edit?id=<?= $date->id; ?>">Edit</a></td>
            <td class="is-vcentered"><a href="<?= BASE_PATH; ?>dates/delete?id=<?= $date->id; ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>