<?php
/**
 * @var string[] $errors
 * @var string|bool $success
 * @var \System\Databases\Objects\Game|null $game
 * @var \System\Databases\Objects\Developer[] $developers
 * @var \System\Databases\Objects\Genre[] $genres
 * @var int[] $genreIds
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

<?php if ($success): ?>
    <p class="notification is-primary"><?= $success; ?></p>
<?php endif; ?>

<?php if (isset($game)): ?>
    <h1 class="title mt-4">Edit <em><?= $game->developers_name . ' - ' . $game->name; ?></em></h1>
    <section class="columns">
        <form class="column is-6" action="" method="post" enctype="multipart/form-data">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="developer-id">Developer</label>
                </div>
                <div class="field-body select is-fullwidth">
                    <select name="developer-id" id="developer-id">
                        <?php foreach ($developers as $developer): ?>
                            <option value="<?= $developer->id; ?>" <?= $developer->id === $game->developer_id ? 'selected' : '' ?>><?= $developer->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="name">Name</label>
                </div>
                <div class="field-body">
                    <input class="input" id="name" type="text" name="name" value="<?= $game->name; ?>"/>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="description">Description</label>
                </div>
                <div class="field-body">
                    <textarea class="textarea" id="description" name="description"><?=$game->description ?></textarea>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="genre-ids">Genre(s)</label>
                </div>
                <div class="field-body select is-multiple is-fullwidth">
                    <select multiple size="3" name="genre-ids[]" id="genre-ids" title="Genres">
                        <?php foreach ($genres as $genre): ?>
                            <option value="<?= $genre->id; ?>" <?= in_array($genre->id, $genreIds) ? 'selected' : '' ?>><?= $genre->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="year">Year</label>
                </div>
                <div class="field-body">
                    <input class="input" id="year" type="text" name="year" value="<?= $game->year; ?>"/>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="rating">Rating</label>
                </div>
                <div class="field-body">
                    <input class="input" id="rating" type="number" step="0.1" name="rating" value="<?= $game->rating; ?>"/>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="image">Image</label>
                </div>
                <div class="field-body">
                    <input class="input" id="image" type="file" name="image"/>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal"></div>
                <div class="field-body">
                    <button class="button is-primary is-fullwidth" type="submit" name="submit">Save</button>
                </div>
            </div>
        </form>
    </section>
<?php endif; ?>
<a class="button" href="<?= BASE_PATH; ?>games">&laquo; Go back to the list</a>
<a class="button is-danger" href="<?= BASE_PATH; ?>user/logout">Logout</a>