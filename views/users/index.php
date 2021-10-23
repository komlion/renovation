<?php

?>

<div class="body-content container">
        <div class="row">
            <div class="card w-75 p-2">
                <h4 class="card-title">Профиль</h4>
                <h6 class="card-title">Имя: <?= $user->fullName() ?></h6>
                <h6 class="card-title">Телефон: +7<?= $user->phone ?></h6>
            </div>

        <div id="accordion" role="tablist" class="w-25 pull-right">
            <div class="card">
                <div class="card-header" role="tab" id="headingOne">
                    <h5 class="mb-0">
                        <a class="collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Мои проекты
                        </a>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                    <?php foreach ($projects as $project): ?>
                        <div class="card">
                            <div class="card-body">
                                <a class="card-text" href="projects?projectId=<?= $project->id ?>"><?= $project->getAddress() ?></a>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>

