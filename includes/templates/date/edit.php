<?php
/**
 * @var string[] $errors
 * @var string|bool $success
 * @var \System\Databases\Objects\Date|null $date
 * @var \System\Databases\Objects\Job[] $jobs
 * @var int[] $jobIds
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

<?php if (isset($date)): ?>
    <h1 class="title mt-4">Edit <em><?= $date->location . ' - ' . $date->datetime; ?></em></h1>
    <<section class="columns">
        <form class="column is-6" action="" method="post" enctype="multipart/form-data">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="location">Location</label>
                </div>
                <div class="field-body">
                    <input class="input" id="location" type="text" name="location" value="<?= $date->location; ?>"/>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="description">Description</label>
                </div>
                <div class="field-body">
                    <textarea class="textarea" id="description" name="description"><?=$date->description ?></textarea>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="job-ids">Job(s)</label>
                </div>
                <div class="field-body select is-multiple is-fullwidth">
                    <select multiple size="3" name="job-ids[]" id="job-ids" title="Jobs">
                        <?php foreach ($jobs as $job): ?>
                            <option value="<?= $job->id; ?>" <?= in_array($job->id, $jobIds) ? 'selected' : '' ?>><?= $job->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="size">Size</label>
                </div>
                <div class="field-body">
                    <input class="input" id="size" type="text" name="size" value="<?= $date->size; ?>"/>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="hours">Hours</label>
                </div>
                <div class="field-body">
                    <input class="input" id="hours" type="number" name="hours" value="<?= $date->hours; ?>"/>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="datetime">Time</label>
                </div>
                <div class="field-body">
                    <input class="input" id="datetime" type="datetime-local" min="2024-01-11T00:00" name="datetime" value="<?= $date->datetime; ?>"/>
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
<a class="button" href="<?= BASE_PATH; ?>dates">&laquo; Go back to the list</a>
<a class="button is-danger" href="<?= BASE_PATH; ?>user/logout">Logout</a>