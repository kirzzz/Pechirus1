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
            <div class="d-flex flex-column w-100 ">
                <div class="label mb-3">
                    <h4>Выберите тип вывода дымохода</h4>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="radio-svg">
                            <input type="radio" name="chimney-house">
                            <img class="svg" src="<?= Url::to(['@web/site/']) ?>/images/chimney/house-stroke-1.svg" alt="">
                        </label>
                    </div>
                    <div class="col-sm-3">
                        <label class="radio-svg">
                            <input type="radio" name="chimney-house">
                            <img class="svg" src="<?= Url::to(['@web/site/']) ?>/images/chimney/house-stroke-2.svg" alt="">
                        </label>
                    </div>
                    <div class="col-sm-3">
                        <label class="radio-svg">
                            <input type="radio" name="chimney-house">
                            <img class="svg" src="<?= Url::to(['@web/site/']) ?>/images/chimney/house-stroke-3.svg" alt="">
                        </label>
                    </div>
                    <div class="col-sm-3">
                        <label class="radio-svg">
                            <input type="radio" name="chimney-house">
                            <img class="svg" src="<?= Url::to(['@web/site/']) ?>/images/chimney/house-stroke-4.svg" alt="">
                        </label>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column w-100">
                <div class="label mb-3">
                    <h4>Выберите тип вывода дымохода</h4>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="radio-text">
                            <input type="radio" name="chimney-aisi">
                            <p>AISI 430</p>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <label class="radio-text">
                            <input type="radio" name="chimney-aisi">
                            <p>AISI 409</p>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <label class="radio-text">
                            <input type="radio" name="chimney-aisi">
                            <p>AISI 321 0,5mm</p>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <label class="radio-text">
                            <input type="radio" name="chimney-aisi">
                            <p>AISI 321 0,8mm</p>
                        </label>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column w-100">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="label mb-3">
                            <h4>Введите высоту дымохода (через 0,5м)</h4>
                        </div>
                        <div class="input-group mb-3 custom-input-text">
                            <input type="number" min="0" step="0,5" class="form-control" placeholder="Высота дымохода" aria-label="Высота дымохода" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">м</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="label mb-3">
                            <h4>Введите количетсво этажей</h4>
                        </div>
                        <div class="input-group mb-3 custom-input-text">
                            <input type="number" min="0" class="form-control" placeholder="Высота дымохода" aria-label="Высота дымохода" aria-describedby="basic-addon2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
