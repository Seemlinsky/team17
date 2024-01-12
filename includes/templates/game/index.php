<?php
/**
 * @var string[] $errors
 * @var int $totalGames
 * @var \System\Databases\Objects\Unused\Game[] $games
 * @var string $developerName
 */
?>
<h1 class="title mt-4">Game Collection</h1>
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
<a class="button" href="<?= BASE_PATH; ?>games/create">Create new game</a>
<table class="table is-striped mt-4">
    <thead>
    <tr>
        <th></th>
        <th>#</th>
        <th>Name</th>
        <th>Developer</th>
        <th>Genre(s)</th>
        <th>Year</th>
        <th>Rating</th>
        <th colspan=3"></th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="10" class="has-text-centered">&copy; My Collection with <?= $totalGames; ?> games</td>
    </tr>
    </tfoot>
    <tbody>
    <?php foreach ($games as $game): ?>
        <tr>
            <td class="is-vcentered">
                <img class="image is-64x64" src="images/<?= $game->image; ?>" alt="<?= $game->name; ?>"/>
            </td>
            <td class="is-vcentered"><?= $game->id; ?></td>
            <td class="is-vcentered"><?= $game->name; ?></td>
            <td class="is-vcentered"><?= $game->developers_name; ?></td>
            <td class="is-vcentered"><?= implode(', ', $game->getGenres()); ?></td>

            <td class="is-vcentered"><?= $game->year; ?></td>
            <td class="is-vcentered"><?= $game->rating; ?></td>
            <td class="is-vcentered"><a href="<?= BASE_PATH; ?>games/detail?id=<?= $game->id; ?>">Details</a></td>
            <td class="is-vcentered"><a href="<?= BASE_PATH; ?>games/edit?id=<?= $game->id; ?>">Edit</a></td>
            <td class="is-vcentered"><a href="<?= BASE_PATH; ?>games/delete?id=<?= $game->id; ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>