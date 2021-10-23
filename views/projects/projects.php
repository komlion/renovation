<?php

use app\models\Photo;

?>

<div class="body-content container">
    <?php foreach ($projects as $project):
        $client = $project->getClient();
        ?>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $project->getAddress() ?></h4>
                <h6 class="card-subtitle mb-2 text-muted"><a href="/users?userId=<?= $client->id ?>"><?= $client->first_name . ' ' . $client->last_name ?></a></h6>
                <h6 class="card-subtitle mb-2 text-muted"><?= $project->create_date ?></h6>
                <p class="card-text">
                    <?= mb_substr($project->comment, 0, 500) ?><?php if (strlen($project->comment) > 250) {echo '...';} ?>
                </p>
                <div class="card-deck">
                    <?php $photos = $project->getThreeOrLessPhotos($project);
                    for  ($i = 0; $i < 3; $i++): ?>
                    <div class="card">
                        <img class="img-fluid" src='<?php if (isset($photos[$i])) { echo $photos[$i]->path; } else { echo 'web/img/noImg.jpg';} ?>' alt='clientPhoto'>
                    </div>
                    <?php endfor; ?>
                </div>
                <a href="projects?projectId=<?= $project->id ?>" class="card-link">Подробнее</a>
                <a href="projects/delete?projectId=<?= $project->id ?>" class="card-link">Удалить</a>
            </div>
        </div>
    <?php endforeach; ?>

    <?= $pagination->echoPagination() ?>
</div>
