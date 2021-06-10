<?php
/* @var $this yii\web\View */
/* @var $contact Contact */

use app\models\Contact;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

$this->title = 'Pechirus: Контакты';
?>
<div class="breadcrumb-area breadcrumb-mt bg-gray breadcrumb-ptb-1">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2>Контакты</h2>
        </div>
    </div>
</div>
<div class="contact-us-area pt-160">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8">
                <div class="row">
                    <div class="col-lg-10 ml-auto mr-auto">
                        <div class="contact-form-area">
                            <h2>Связаться со мной:</h2>
                            <?php $form = ActiveForm::begin(['method' => 'post','action' => Url::toRoute(['site/contact']),'enableClientValidation' => true,'errorCssClass' => 'text-danger']) ?>
                                <div class="single-contact-form">
                                    <?= $form->field($contact,'name')?>
                                </div>
                                <div class="single-contact-form">
                                    <?= $form->field($contact,'email')->input('email')?>
                                </div>
                                <div class="single-contact-form">
                                    <?= $form->field($contact,'tel')->widget(MaskedInput::className(), ['mask' => '+7 (999) 999-99-99'])?>
                                </div>
                                <div class="single-contact-form">
                                    <?= $form->field($contact,'message')->textarea()?>
                                    <button class="submit" type="submit">Отправить</button>
                                </div>
                            <?php ActiveForm::end() ?>
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="contact-info-area">
                    <div class="single-contact-info">
                        <div class="contact-info-title">
                            <h4>Наш адрес:</h4>
                        </div>
                        <p>МКАД 92км, Мытищи ул. Красный поселок, д.2a, ТЦ Садовод Линия Е, павильоны №47-48</p>
                    </div>
                    <div class="single-contact-info">
                        <div class="contact-info-title">
                            <h4>Связаться с нами:</h4>
                        </div>
                        <p>pechirus@gmail.com</p>
                        <p>+7 (495) 540-47-03</p>
                    </div>
                    <div class="single-contact-info">
                        <div class="contact-info-title">
                            <h4>Если вы заметили ошибку в работе сайте:</h4>
                            <p>Убедительная просьба: Если вы заметили ошибку в работе сайта свяжитесь с администратором по одному из следующих контактов. Тем самым вы можете стать нам еще лучше!</p>
                        </div>
                        <p>shcherbach00@mail.ru</p>
                        <p>@KirZZZ (telegram)</p>
                    </div>
                    <div class="single-contact-info">
                        <div class="contact-info-title">
                            <h4>Мы в социальных сетях:</h4>
                        </div>
                        <ul>
                            <li><a href="https://www.instagram.com/pechirus/"><i class="icon-social-instagram"></i></a></li>
                            <li><a href="https://g.page/r/CXtlGozxrhh4EAg/review"><i class="icofont-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-130" id="contact-map">
        <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A6ad4b7e64318166a127f70d8b56f7125d10fd1cbb9d771746b4f58e34017f01b&amp;source=constructor" width="100%" height="363" frameborder="0"></iframe>
    </div>
</div>
