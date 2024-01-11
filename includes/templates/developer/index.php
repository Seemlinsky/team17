<?php
/**
 * @var array $errors
 * @var int $totalDevelopers
 * @var \System\Databases\Objects\Developer[] $developers
 */
?>
<h1 class="title mt-4">Developers</h1>
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
<a class="button" href="<?= BASE_PATH; ?>developers/create">Create new developer</a>
<table class="table is-striped mt-4">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Total Games</th>
        <th colspan="3"></th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="6" class="has-text-centered">&copy; My Collection with <?= $totalDevelopers; ?> developers</td>
    </tr>
    </tfoot>
    <tbody>
    <?php foreach ($developers as $developer): ?>
        <tr>
            <td><?= $developer->id; ?></td>
            <td><?= $developer->name; ?></td>
            <td><?= count($developer->games()); ?></td>
            <td><a href="<?= BASE_PATH; ?>developers/detail?id=<?= $developer->id; ?>">Details</a></td>
            <td><a href="<?= BASE_PATH; ?>developers/edit?id=<?= $developer->id; ?>">Edit</a></td>
            <td><a href="<?= BASE_PATH; ?>developers/delete?id=<?= $developer->id; ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
