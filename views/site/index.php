<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div>
    <div class="scale"><img src="../../web/img/header.jpg" alt="Шапка" height="600px" class="scale w-100"></div>
</div>
<div class="site-index">
    <div class="body-content container">

        <div class="jumbotron m-0 mt-3 bg-white">
            <h1 class="display-3 ">Hello, world!</h1>
            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for
                calling extra attention to featured content or information.</p>
            <hr class="my-2">
            <p>It uses utility classes for typography and
                spacing to space content out within the larger container.</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="/projects/create" role="button">Хочу ремонт!</a>
            </p>
        </div>

        <div class="card-deck">
            <div class="card">
                <img class="card-img-top" src="../../web/img/test-icon2.svg" alt="Card image cap">
                <div class="card-body"> Some more card content </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="../../web/img/test-icon2.svg" alt="Card image cap">
                <div class="card-body"> Some more card content </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="../../web/img/test-icon2.svg" alt="Card image cap">
                <div class="card-body"> Some more card content </div>
            </div>
        </div>

        <h3 class="jumbotron display-3 bg-white">Наши работы</h3>

        <div id="carouselExampleIndicators" class="carousel slide mt-4" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="../../web/img/gallery1.jpg" data-src="holder.js/900x400?theme=social" alt="900x400" style="width: 900px; height: 500px;" data-holder-rendered="true">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="../../web/img/gallery2.jpg" data-src="holder.js/900x400?theme=industrial" alt="900x400" style="width: 900px; height: 500px;" data-holder-rendered="true">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            <a href="#">Больше работ</a>
        </div>
    </div>
</div>








