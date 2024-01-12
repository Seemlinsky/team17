<?php
/**
 * @var array $errors
 * @var string|boolean $success
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

<?php if ($success): ?>
    <p class="notification is-primary"><?= $success; ?></p>
<?php endif; ?>

<?php if (isset($job)): ?>
    <h1 class="title mt-4">Edit <em><?= $job->name; ?></em></h1>
    <section class="columns">
        <form class="column is-6" action="" method="post" enctype="multipart/form-data">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="name">Name</label>
                </div>
                <div class="field-body">
                    <input class="input" id="name" type="text" name="name" value="<?= $job->name; ?>"/>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="description">Description</label>
                </div>
                <div class="field-body">
                    <textarea class="textarea" id="description" name="description"><?=$job->description ?></textarea>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="price">Price</label>
                </div>
                <div class="field-body">
                    <input class="input" id="price" type="number" step="0.01" name="price" value="<?= $job->price; ?>"/>
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
<a class="button mt-4" href="<?= BASE_PATH; ?>jobs">&laquo; Go back to the list</a>
<a class="button mt-4 is-danger" href="<?= BASE_PATH; ?>user/logout">Logout</a>