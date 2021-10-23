<?php

?>

<div class="body-content container">
    <?php foreach ($notifications as $notification): ?>
        <div class="card mx-auto container-fluid p-2 mt-2">
            <?php if ($notification->is_new) { echo '<span>Новое!</span>'; }?>
            <h4 class="card-title"><?= $notification->title ?></h4>
            <p class="card-text"><?= $notification->text ?></p>
            <p class="text-muted"><?= $notification->date ?></p>
        </div>
    <?php endforeach; ?>

</div>