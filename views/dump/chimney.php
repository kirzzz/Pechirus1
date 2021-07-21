<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Рассчет стоимости дымохода';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="breadcrumb-area breadcrumb-mt breadcrumb-ptb-2">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2>Рассчет стоимости дымохода</h2>
            <p>С помощью данного сервиса вы сможете рассчитать дымоход конкретно под вас блабла</p>
            <ul>
                <li>
                    <a href="<?= Url::toRoute(['site/index'])?>">Главная</a>
                </li>
                <li><span> > </span></li>
                <li class="active">Рассчет стоимости дымохода</li>
            </ul>
        </div>
    </div>
</div>
<div class="cart-area bg-gray pt-160 pb-160">
    <div class="container">
        <div class="cart-table-content wishlist-wrap">
            <div class="proceed-btn justify-content-start">
                <h2>Выберите тип вывода дымохода</h2>
            </div>
            <div class="row no-gutters">
                <div class="col-3">
                    <div class="single-categories-5 text-center">
                        <div class="single-categories-5-img">
                            <a href="javascript:void(0)"><img style="height: 9rem" src="<?= Url::to(['@web/site/']) ?>/images/chimney/house_1.png"></a>
                        </div>
                        <div class="categorie-content-6">
                            <h4><a class="color-light" href="javascript:void(0)">Fashion</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="single-categories-5 text-center">
                        <div class="single-categories-5-img">
                            <a href="javascript:void(0)"><img style="height: 9rem" src="<?= Url::to(['@web/site/']) ?>/images/chimney/house_2.png"></a>
                        </div>
                        <div class="categorie-content-6">
                            <h4><a class="color-light" href="javascript:void(0)">Fashion</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="single-categories-5 text-center">
                        <div class="single-categories-5-img">
                            <a href="javascript:void(0)"><img style="height: 9rem" src="<?= Url::to(['@web/site/']) ?>/images/chimney/house_3.png"></a>
                        </div>
                        <div class="categorie-content-6">
                            <h4><a class="color-light" href="javascript:void(0)">Fashion</a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="single-categories-5 text-center">
                        <div class="single-categories-5-img">
                            <a href="javascript:void(0)"><img style="height: 9rem" src="<?= Url::to(['@web/site/']) ?>/images/chimney/house_4.png"></a>
                        </div>
                        <div class="categorie-content-6">
                            <h4><a class="color-light" href="javascript:void(0)">Fashion</a></h4>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="mb-3">
            <div class="proceed-btn justify-content-start">
                <h2>Выберите тип нержавейки</h2>
            </div>
            <div class="row no-gutters">
                <ul class="custom-row-ul row w-100">
                    <li class="col-md-3 m-0">
                        <a class="w-100">AISI 430</a>
                    </li>
                    <li class="col-md-3 m-0">
                        <a class="w-100">AISI 409</a>
                    </li>
                    <li class="col-md-3 m-0">
                        <a class="w-100">AISI 321 0,5mm</a>
                    </li>
                    <li class="col-md-3 m-0">
                        <a class="w-100">AISI 321 0,8mm</a>
                    </li>
                </ul>
            </div>
            <hr class="mb-3">
            <div class="proceed-btn justify-content-start">
                <h2>Введите высоту дымохода (через 0,5)</h2>
            </div>
            <div class="row no-gutters">
                <div class="input-group mb-3 form-search-1">
                    <input type="number" min="0" step="0,5" class="form-control" placeholder="Высота дымохода" aria-label="Высота дымохода" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">м</span>
                    </div>
                </div>
            </div>
            <hr class="mb-3">
            <div class="proceed-btn justify-content-start">
                <h2>Введите количество этажей</h2>
            </div>
            <div class="row no-gutters">
                <div class="form-search-1">
                    <input type="number" min="0" step="1" class="form-control" placeholder="Количество этажей">
                </div>
            </div>
        </div>
    </div>
</div>
