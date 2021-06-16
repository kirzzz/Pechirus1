<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\Log;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AdminAsset;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body  class="" data-sidebar-size="default" data-sidebar-color="dark" data-layout-width="fluid" data-layout-menu-position="fixed" data-sidebar-showuser="false" data-topbar-color="dark">
<?php $this->beginBody() ?>

<!-- Begin page -->
<div id="wrapper">

    <!-- Topbar Start -->
    <div class="navbar-custom">
        <div class="container-fluid">
            <ul class="list-unstyled topnav-menu float-right mb-0">

                <li class="d-none d-lg-block">
                    <form class="app-search">
                        <div class="app-search-box dropdown">
                            <div class="input-group">
                                <input type="search" class="form-control" placeholder="Поиск..." id="top-search">
                                <div class="input-group-append">
                                    <button class="btn" type="submit">
                                        <i class="fe-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="dropdown-menu dropdown-lg" id="search-dropdown">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h5 class="text-overflow mb-2">Found 22 results</h5>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-home mr-1"></i>
                                    <span>Analytics Report</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-aperture mr-1"></i>
                                    <span>How can I help you?</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-settings mr-1"></i>
                                    <span>User profile settings</span>
                                </a>

                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
                                </div>

                                <div class="notification-list">
                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="media">
                                            <img class="d-flex mr-2 rounded-circle" src="<?=Url::to('@web/admin/src/images/')?>users/user-2.jpg" alt="Generic placeholder image" height="32">
                                            <div class="media-body">
                                                <h5 class="m-0 font-14">Erwin E. Brown</h5>
                                                <span class="font-12 mb-0">UI Designer</span>
                                            </div>
                                        </div>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="media">
                                            <img class="d-flex mr-2 rounded-circle" src="<?=Url::to('@web/admin/src/images/')?>users/user-5.jpg" alt="Generic placeholder image" height="32">
                                            <div class="media-body">
                                                <h5 class="m-0 font-14">Jacob Deo</h5>
                                                <span class="font-12 mb-0">Developer</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </form>
                </li>

                <li class="dropdown d-inline-block d-lg-none">
                    <a class="nav-link arrow-none waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="fe-search noti-icon"></i>
                    </a>
                    <div class="dropdown-menu dropdown-lg dropdown-menu-right p-0">
                        <form class="p-3">
                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                        </form>
                    </div>
                </li>

                <li class="dropdown d-none d-lg-inline-block">
                    <a class="nav-link arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                        <i class="fe-maximize noti-icon"></i>
                    </a>
                </li>

                <!--<li class="dropdown d-none d-lg-inline-block topbar-dropdown">
                    <a class="nav-link arrow-none waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="fe-grid noti-icon"></i>
                    </a>
                    <div class="dropdown-menu dropdown-lg dropdown-menu-right">

                        <div class="p-lg-1">
                            <div class="row no-gutters">
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="<?/*=Url::to('@web/admin/src/images/')*/?>brands/slack.png" alt="slack">
                                        <span>Slack</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="<?/*=Url::to('@web/admin/src/images/')*/?>brands/github.png" alt="Github">
                                        <span>GitHub</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="<?/*=Url::to('@web/admin/src/images/')*/?>brands/dribbble.png" alt="dribbble">
                                        <span>Dribbble</span>
                                    </a>
                                </div>
                            </div>

                            <div class="row no-gutters">
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="<?/*=Url::to('@web/admin/src/images/')*/?>brands/bitbucket.png" alt="bitbucket">
                                        <span>Bitbucket</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="<?/*=Url::to('@web/admin/src/images/')*/?>brands/dropbox.png" alt="dropbox">
                                        <span>Dropbox</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="<?/*=Url::to('@web/admin/src/images/')*/?>brands/g-suite.png" alt="G Suite">
                                        <span>G Suite</span>
                                    </a>
                                </div>

                            </div>
                        </div>

                    </div>
                </li>-->
                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="fe-bell noti-icon"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="m-0">
                                Уведомления
                            </h5>
                        </div>
                        <div class="noti-scroll" data-simplebar>

                        <?php $data = Log::find()
                            ->where(['in','type',[Log::TYPE_COMMENTS,Log::TYPE_USER,Log::TYPE_ORDERS,Log::TYPE_CONTACT]])
                            ->andWhere(['action'=>Log::ACTION_CREATE])
                            ->orderBy(['created_at'=>SORT_DESC])
                            ->limit(5)->all(); ?>
                        <?php foreach ($data as $index => $log):?>
                        <?php
                            $text = '';
                            $info = json_decode($log->info,true);
                            $icon = '<i class="fe-bell noti-icon"></i>';
                            if($log->type == Log::TYPE_USER){
                                $text = Log::ACTION_DESCRIPTION[$log->action].' '.Log::TYPE_DESCRIPTION[$log->type]. ': '.$info['username'];
                                $icon = $log->action == Log::ACTION_CREATE?'<i class="fal fa-user-plus"></i>':'<i class="fal fa-user-edit"></i>';
                            }elseif ($log->type == Log::TYPE_ORDERS){
                                $text = Log::ACTION_DESCRIPTION[$log->action].' '.Log::TYPE_DESCRIPTION[$log->type].': '.$info['article'];
                                $icon = '<i class="fal fa-ruble-sign"></i>';
                            }elseif ($log->type == Log::TYPE_CONTACT){
                                $text = Log::ACTION_DESCRIPTION[$log->action].' '.Log::TYPE_DESCRIPTION[$log->type].': '.$info['name'];
                                $icon = '<i class="fal fa-id-card-alt"></i>';
                            }/*elseif ($log->type == Log::TYPE_COMMENTS){
                                $text = Log::ACTION_DESCRIPTION[$log->action].' '.Log::TYPE_DESCRIPTION[$log->type].': '.$info['name'];
                                $icon = '<i class="fal fa-comments"></i>';
                            }*/
                        ?>
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-info">
                                <?= $icon ?>
                            </div>
                            <p class="notify-details">
                                <b> <?= $text ?></b>
                                <small class="text-muted"><?= date('d.m.Y H:i:s',$log['created_at']) ?></small>
                            </p>
                        </a>
                        <?php endforeach; ?>
                        </div>

                        <!-- All-->
                        <a href="<?= Url::toRoute(['admin/notifications'])?>" class="dropdown-item text-center text-primary notify-item notify-all">
                            Все
                            <i class="fe-arrow-right"></i>
                        </a>

                    </div>
                </li>

                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <!--<img src="<?/*=Url::to('@web/admin/src/images/')*/?>users/user-1.jpg" alt="user-image" class="rounded-circle">-->
                        <span class="pro-user-name ml-1">
                            <?php $user = \app\models\User::findIdentity(Yii::$app->user->id);echo $user->username?>
                            <i class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Добро пожаловать !</h6>
                        </div>

                        <!-- item-->
                        <a href="<?= Url::toRoute(['admin/index'])?>" class="dropdown-item notify-item">
                            <i class="fe-user mr-1"></i>
                            <span>Главная</span>
                        </a>


                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-settings mr-1"></i>
                            <span>Настройки</span>
                        </a>



                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a href="<?= Url::toRoute(['site/logout'])?>" class="dropdown-item notify-item">
                            <i class="fe-log-out mr-1"></i>
                            <span>Выйти</span>
                        </a>

                    </div>
                </li>

                <li class="dropdown notification-list">
                    <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                        <i class="fe-settings noti-icon"></i>
                    </a>
                </li>

            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="<?= Url::toRoute(['site/index']) ?>" class="logo logo-dark text-center">
                    <span class="logo-sm">
                        <img src="<?= Url::to('@web/admin/src/images/logo-sm.png') ?>" alt="" height="45">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= Url::to('@web/admin/src/images/logo-dark.png') ?>" alt="" height="40">
                    </span>
                </a>
                <a href="<?= Url::toRoute(['site/index']) ?>" class="logo logo-light text-center">
                    <span class="logo-sm">
                        <img src="<?= Url::to('@web/admin/src/images/logo-sm.png') ?>" alt="" height="45">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= Url::to('@web/admin/src/images/logo-light.png') ?>" alt="" height="40">
                    </span>
                </a>
            </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile waves-effect waves-light">
                        <i class="fe-menu"></i>
                    </button>
                </li>

                <li>
                    <!-- Mobile menu toggle (Horizontal Layout)-->
                    <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </li>

                <li class="dropdown d-none d-xl-block">
                    <a class="nav-link waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        Создать
                        <i class="mdi mdi-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu">
                        <!-- item-->
                        <a href="<?= Url::toRoute(['admin/product'])?>" class="dropdown-item">
                            <i class="fal fa-conveyor-belt"></i>
                            <span>Продукт</span>
                        </a>

                        <!-- item-->
                        <a href="<?= Url::toRoute(['admin/catalogs'])?>" class="dropdown-item">
                            <i class="fal fa-network-wired"></i>
                            <span>Каталог</span>
                        </a>

                        <!-- item-->
                        <a href="<?= Url::toRoute(['admin/brands'])?>" class="dropdown-item">
                            <i class="fas fa-copyright"></i>
                            <span>Брэнд</span>
                        </a>

                    </div>
                </li>

                <!--<li class="dropdown dropdown-mega d-none d-xl-block">
                    <a class="nav-link waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        Каталог
                        <i class="mdi mdi-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-megamenu">
                        <div class="row">
                            <div class="col-sm-8">

                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="text-dark mt-0">UI Components</h5>
                                        <ul class="list-unstyled megamenu-list">
                                            <li>
                                                <a href="javascript:void(0);">Widgets</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Nestable List</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Range Sliders</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Masonry Items</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Sweet Alerts</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Treeview Page</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Tour Page</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-md-4">
                                        <h5 class="text-dark mt-0">Applications</h5>
                                        <ul class="list-unstyled megamenu-list">
                                            <li>
                                                <a href="javascript:void(0);">eCommerce Pages</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">CRM Pages</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Email</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Calendar</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Team Contacts</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Task Board</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Email Templates</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-md-4">
                                        <h5 class="text-dark mt-0">Extra Pages</h5>
                                        <ul class="list-unstyled megamenu-list">
                                            <li>
                                                <a href="javascript:void(0);">Left Sidebar with User</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Menu Collapsed</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Small Left Sidebar</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">New Header Style</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Search Result</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Gallery Pages</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Maintenance & Coming Soon</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="text-center mt-3">
                                    <h3 class="text-dark">Special Discount Sale!</h3>
                                    <h4>Save up to 70% off.</h4>
                                    <button class="btn btn-primary btn-rounded mt-3">Download Now</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </li>-->
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- end Topbar -->

    <!-- ========== Left Sidebar Start ========== -->
    <div class="left-side-menu">

        <div class="h-100" data-simplebar>

            <!-- User box -->
            <div class="user-box text-center">
                <div class="dropdown">
                    <a href="javascript: void(0);" class="text-dark h5 mt-2 mb-1 d-block"
                       data-toggle="dropdown"><?php $user = \app\models\User::findIdentity(Yii::$app->user->id);echo $user->username?></a>
                    <div class="dropdown-menu user-pro-dropdown">

                        <!-- item-->
                        <a href="<?= Url::toRoute(['admin/index'])?>" class="dropdown-item notify-item">
                            <i class="fe-user mr-1"></i>
                            <span>Главная</span>
                        </a>


                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-settings mr-1"></i>
                            <span>Настройки</span>
                        </a>

                        <!-- item-->
                        <a href="<?= Url::toRoute(['site/logout'])?>" class="dropdown-item notify-item">
                            <i class="fe-log-out mr-1"></i>
                            <span>Выйти</span>
                        </a>

                    </div>
                </div>
            </div>

            <!--- Sidemenu -->
            <div id="sidebar-menu" style="overflow: auto;max-height: calc(100vh - 140px);">

                <ul id="side-menu">

                    <li class="menu-title">Приборная панель</li>

                    <li>
                        <a href="<?= Url::toRoute(['admin/index'])?>">
                            <i class="fal fa-home-lg-alt"></i>
                            <span>Главная</span>
                        </a>
                    </li>
                    <!--<li>
                        <a href="#sidebarDashboards" data-toggle="collapse">
                            <i data-feather="airplay"></i>
                            <span class="badge badge-success badge-pill float-right">4</span>
                            <span>Главная</span>
                        </a>
                        <div class="collapse" id="sidebarDashboards">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="index.html">Dashboard 1</a>
                                </li>
                                <li>
                                    <a href="dashboard-2.html">Dashboard 2</a>
                                </li>
                                <li>
                                    <a href="dashboard-3.html">Dashboard 3</a>
                                </li>
                                <li>
                                    <a href="dashboard-4.html">Dashboard 4</a>
                                </li>
                            </ul>
                        </div>
                    </li>-->

                    <li class="menu-title mt-2">Продукт</li>
                    <li>
                        <a href="<?= Url::toRoute(['admin/product'])?>">
                            <i class="fal fa-conveyor-belt"></i>
                            <span>Новый продукт</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::toRoute(['admin/products'])?>">
                            <i class="fal fa-conveyor-belt-alt"></i>
                            <span>Все продукты</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::toRoute(['admin/brands'])?>">
                            <i class="fas fa-copyright"></i>
                            <span>Брэнды</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::toRoute(['admin/catalogs'])?>">
                            <i class="fal fa-network-wired"></i>
                            <span>Каталог</span>
                        </a>
                    </li>

                    <li class="menu-title mt-2">Заимствование</li>
                    <li>
                        <a href="<?= Url::toRoute(['admin/compare-products'])?>">
                            <i class="fas fa-percent"></i>
                            <span>Назначение соответствий</span>
                        </a>
                    </li>

                    <li class="menu-title mt-2">Заказы</li>
                    <li>
                        <a href="<?= Url::toRoute(['admin/orders'])?>">
                            <i class="fal fa-ruble-sign"></i>
                            <span>Заказы</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::toRoute(['admin/basket'])?>">
                            <i class="fad fa-shopping-basket"></i>
                            <span>Корзина</span>
                        </a>
                    </li>
                    <li class="menu-title mt-2">Поставка</li>
                    <li>
                        <a href="<?= Url::toRoute(['admin/provider'])?>">
                            <i class="fas fa-truck-moving"></i>
                            <span>Новый поставщик</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::toRoute(['admin/shipments'])?>">
                            <i class="fad fa-truck-loading"></i>
                            <span>Новая поставка</span>
                        </a>
                    </li>
                    <li class="menu-title mt-2">Пользователи</li>
                    <li>
                        <a href="<?= Url::toRoute(['admin/users'])?>">
                            <i class="fas fa-users"></i>
                            <span>Все</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::toRoute(['admin/comments'])?>">
                            <i class="fas fa-comments"></i>
                            <span>Комментарии</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::toRoute(['admin/contact'])?>">
                            <i class="fal fa-id-card-alt"></i>
                            <span>Заявки</span>
                        </a>
                    </li>
                    <li class="menu-title mt-2">Дополнительно</li>
                    <li>
                        <a href="<?= Url::toRoute(['admin/notifications'])?>">
                            <i class="fal fa-history"></i>
                            <span>История сайта</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::toRoute(['admin/massupload'])?>">
                            <i class="fal fa-file"></i>
                            <span>Массовая загрузка</span>
                        </a>
                    </li>
                </ul>

            </div>
            <!-- End Sidebar -->

            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">
            <?= $content ?>
        </div> <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        2021 - <script>document.write(new Date().getFullYear())</script> &copy; Админ-панель от <a href="">Kirzzz</a>
                    </div>
                   <!-- <div class="col-md-6">
                        <div class="text-md-right footer-links d-none d-sm-block">
                            <a href="javascript:void(0);">About Us</a>
                            <a href="javascript:void(0);">Help</a>
                            <a href="javascript:void(0);">Contact Us</a>
                        </div>
                    </div>-->
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
    <div class="right-bar">
        <div data-simplebar="" class="h-100" style="overflow-y:auto">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-bordered nav-justified" role="tablist">
                <!--<li class="nav-item">
                    <a class="nav-link py-2" data-toggle="tab" href="#chat-tab" role="tab">
                        <i class="mdi mdi-message-text d-block font-22 my-1"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-2" data-toggle="tab" href="#tasks-tab" role="tab">
                        <i class="mdi mdi-format-list-checkbox d-block font-22 my-1"></i>
                    </a>
                </li>-->
                <li class="nav-item">
                    <a class="nav-link py-2 active" data-toggle="tab" href="#settings-tab" role="tab">
                        <i class="mdi mdi-cog-outline d-block font-22 my-1"></i>
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content pt-0">
                <!--<div class="tab-pane" id="chat-tab" role="tabpanel">

                    <form class="search-bar p-3">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Поиск...">
                            <span class="mdi mdi-magnify"></span>
                        </div>
                    </form>

                    <h6 class="font-weight-medium px-3 mt-2 text-uppercase">Group Chats</h6>

                    <div class="p-2">
                        <a href="javascript: void(0);" class="text-reset notification-item pl-3 mb-2 d-block">
                            <i class="mdi mdi-checkbox-blank-circle-outline mr-1 text-success"></i>
                            <span class="mb-0 mt-1">App Development</span>
                        </a>

                        <a href="javascript: void(0);" class="text-reset notification-item pl-3 mb-2 d-block">
                            <i class="mdi mdi-checkbox-blank-circle-outline mr-1 text-warning"></i>
                            <span class="mb-0 mt-1">Office Work</span>
                        </a>

                        <a href="javascript: void(0);" class="text-reset notification-item pl-3 mb-2 d-block">
                            <i class="mdi mdi-checkbox-blank-circle-outline mr-1 text-danger"></i>
                            <span class="mb-0 mt-1">Personal Group</span>
                        </a>

                        <a href="javascript: void(0);" class="text-reset notification-item pl-3 d-block">
                            <i class="mdi mdi-checkbox-blank-circle-outline mr-1"></i>
                            <span class="mb-0 mt-1">Freelance</span>
                        </a>
                    </div>

                    <h6 class="font-weight-medium px-3 mt-3 text-uppercase">Favourites <a href="javascript: void(0);" class="font-18 text-danger"><i class="float-right mdi mdi-plus-circle"></i></a></h6>

                    <div class="p-2">
                        <a href="javascript: void(0);" class="text-reset notification-item">
                            <div class="media">
                                <div class="position-relative mr-2">
                                    <img src="<?/*=Url::to('@web/admin/src/images/')*/?>users/user-10.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                    <i class="mdi mdi-circle user-status online"></i>
                                </div>
                                <div class="media-body overflow-hidden">
                                    <h6 class="mt-0 mb-1 font-14">Andrew Mackie</h6>
                                    <div class="font-13 text-muted">
                                        <p class="mb-0 text-truncate">It will seem like simplified English.</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="javascript: void(0);" class="text-reset notification-item">
                            <div class="media">
                                <div class="position-relative mr-2">
                                    <img src="<?/*=Url::to('@web/admin/src/images/')*/?>users/user-1.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                    <i class="mdi mdi-circle user-status away"></i>
                                </div>
                                <div class="media-body overflow-hidden">
                                    <h6 class="mt-0 mb-1 font-14">Rory Dalyell</h6>
                                    <div class="font-13 text-muted">
                                        <p class="mb-0 text-truncate">To an English person, it will seem like simplified</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="javascript: void(0);" class="text-reset notification-item">
                            <div class="media">
                                <div class="position-relative mr-2">
                                    <img src="<?/*=Url::to('@web/admin/src/images/')*/?>users/user-9.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                    <i class="mdi mdi-circle user-status busy"></i>
                                </div>
                                <div class="media-body overflow-hidden">
                                    <h6 class="mt-0 mb-1 font-14">Jaxon Dunhill</h6>
                                    <div class="font-13 text-muted">
                                        <p class="mb-0 text-truncate">To achieve this, it would be necessary.</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <h6 class="font-weight-medium px-3 mt-3 text-uppercase">Other Chats <a href="javascript: void(0);" class="font-18 text-danger"><i class="float-right mdi mdi-plus-circle"></i></a></h6>

                    <div class="p-2 pb-4">
                        <a href="javascript: void(0);" class="text-reset notification-item">
                            <div class="media">
                                <div class="position-relative mr-2">
                                    <img src="<?/*=Url::to('@web/admin/src/images/')*/?>users/user-2.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                    <i class="mdi mdi-circle user-status online"></i>
                                </div>
                                <div class="media-body overflow-hidden">
                                    <h6 class="mt-0 mb-1 font-14">Jackson Therry</h6>
                                    <div class="font-13 text-muted">
                                        <p class="mb-0 text-truncate">Everyone realizes why a new common language.</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="javascript: void(0);" class="text-reset notification-item">
                            <div class="media">
                                <div class="position-relative mr-2">
                                    <img src="<?/*=Url::to('@web/admin/src/images/')*/?>users/user-4.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                    <i class="mdi mdi-circle user-status away"></i>
                                </div>
                                <div class="media-body overflow-hidden">
                                    <h6 class="mt-0 mb-1 font-14">Charles Deakin</h6>
                                    <div class="font-13 text-muted">
                                        <p class="mb-0 text-truncate">The languages only differ in their grammar.</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="javascript: void(0);" class="text-reset notification-item">
                            <div class="media">
                                <div class="position-relative mr-2">
                                    <img src="<?/*=Url::to('@web/admin/src/images/')*/?>users/user-5.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                    <i class="mdi mdi-circle user-status online"></i>
                                </div>
                                <div class="media-body overflow-hidden">
                                    <h6 class="mt-0 mb-1 font-14">Ryan Salting</h6>
                                    <div class="font-13 text-muted">
                                        <p class="mb-0 text-truncate">If several languages coalesce the grammar of the resulting.</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="javascript: void(0);" class="text-reset notification-item">
                            <div class="media">
                                <div class="position-relative mr-2">
                                    <img src="<?/*=Url::to('@web/admin/src/images/')*/?>users/user-6.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                    <i class="mdi mdi-circle user-status online"></i>
                                </div>
                                <div class="media-body overflow-hidden">
                                    <h6 class="mt-0 mb-1 font-14">Sean Howse</h6>
                                    <div class="font-13 text-muted">
                                        <p class="mb-0 text-truncate">It will seem like simplified English.</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="javascript: void(0);" class="text-reset notification-item">
                            <div class="media">
                                <div class="position-relative mr-2">
                                    <img src="<?/*=Url::to('@web/admin/src/images/')*/?>users/user-7.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                    <i class="mdi mdi-circle user-status busy"></i>
                                </div>
                                <div class="media-body overflow-hidden">
                                    <h6 class="mt-0 mb-1 font-14">Dean Coward</h6>
                                    <div class="font-13 text-muted">
                                        <p class="mb-0 text-truncate">The new common language will be more simple.</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="javascript: void(0);" class="text-reset notification-item">
                            <div class="media">
                                <div class="position-relative mr-2">
                                    <img src="<?/*=Url::to('@web/admin/src/images/')*/?>users/user-8.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                    <i class="mdi mdi-circle user-status away"></i>
                                </div>
                                <div class="media-body overflow-hidden">
                                    <h6 class="mt-0 mb-1 font-14">Hayley East</h6>
                                    <div class="font-13 text-muted">
                                        <p class="mb-0 text-truncate">One could refuse to pay expensive translators.</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <div class="text-center mt-3">
                            <a href="javascript:void(0);" class="btn btn-sm btn-white">
                                <i class="mdi mdi-spin mdi-loading mr-2"></i>
                                Load more
                            </a>
                        </div>
                    </div>

                </div>

                <div class="tab-pane" id="tasks-tab" role="tabpanel">
                    <h6 class="font-weight-medium p-3 m-0 text-uppercase">Working Tasks</h6>
                    <div class="px-2">
                        <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                            <p class="text-muted mb-0">App Development<span class="float-right">75%</span></p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </a>

                        <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                            <p class="text-muted mb-0">Database Repair<span class="float-right">37%</span></p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 37%" aria-valuenow="37" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </a>

                        <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                            <p class="text-muted mb-0">Backup Create<span class="float-right">52%</span></p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 52%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </a>
                    </div>

                    <h6 class="font-weight-medium px-3 mb-0 mt-4 text-uppercase">Upcoming Tasks</h6>

                    <div class="p-2">
                        <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                            <p class="text-muted mb-0">Sales Reporting<span class="float-right">12%</span></p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </a>

                        <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                            <p class="text-muted mb-0">Redesign Website<span class="float-right">67%</span></p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 67%" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </a>

                        <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                            <p class="text-muted mb-0">New Admin Design<span class="float-right">84%</span></p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 84%" aria-valuenow="84" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </a>
                    </div>

                    <div class="p-3 mt-2">
                        <a href="javascript: void(0);" class="btn btn-success btn-block waves-effect waves-light">Create Task</a>
                    </div>

                </div>-->
                <div class="tab-pane active" id="settings-tab" role="tabpanel">
                    <h6 class="font-weight-medium px-3 m-0 py-2 font-13 text-uppercase bg-light">
                        <span class="d-block py-1">Темовые настройки</span>
                    </h6>

                    <div class="p-3">
                        <div class="alert alert-warning" role="alert">
                            <strong>Кастомизируйте </strong> эту админ панель,
                        </div>

                        <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Цветовая гамма</h6>
                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="color-scheme-mode" value="light" id="light-mode-check">
                            <label class="custom-control-label" for="light-mode-check">Светлый режим</label>
                        </div>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="color-scheme-mode" value="dark" id="dark-mode-check" checked="">
                            <label class="custom-control-label" for="dark-mode-check">Темный режим</label>
                        </div>

                        <!-- Menu positions -->
                        <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Позиционирование панелей</h6>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="menus-position" value="fixed" id="fixed-check">
                            <label class="custom-control-label" for="fixed-check">Строго</label>
                        </div>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="menus-position" value="scrollable" id="scrollable-check" checked="">
                            <label class="custom-control-label" for="scrollable-check">Не строго</label>
                        </div>

                        <!-- Left Sidebar-->
                        <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Цвет левой панели</h6>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="leftsidebar-color" value="light" id="light-check">
                            <label class="custom-control-label" for="light-check">Светлый</label>
                        </div>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="leftsidebar-color" value="dark" id="dark-check" checked="">
                            <label class="custom-control-label" for="dark-check">Темный</label>
                        </div>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="leftsidebar-color" value="brand" id="brand-check">
                            <label class="custom-control-label" for="brand-check">Синий</label>
                        </div>

                        <div class="custom-control custom-switch mb-3">
                            <input type="radio" class="custom-control-input" name="leftsidebar-color" value="gradient" id="gradient-check">
                            <label class="custom-control-label" for="gradient-check">Градиент</label>
                        </div>

                        <!-- size -->
                        <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Левая панель</h6>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="leftsidebar-size" value="default" id="default-size-check" checked="">
                            <label class="custom-control-label" for="default-size-check">Стандартно</label>
                        </div>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="leftsidebar-size" value="condensed" id="condensed-check">
                            <label class="custom-control-label" for="condensed-check">Средне <small>(Extra Small size)</small></label>
                        </div>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="leftsidebar-size" value="compact" id="compact-check">
                            <label class="custom-control-label" for="compact-check">Компанктно <small>(Small size)</small></label>
                        </div>

                        <!-- User info -->
                        <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Информация о пользователе</h6>

                        <div class="custom-control custom-switch mb-1">
                            <input type="checkbox" class="custom-control-input" name="leftsidebar-user" value="fixed" id="sidebaruser-check">
                            <label class="custom-control-label" for="sidebaruser-check">Включена</label>
                        </div>


                        <!-- Topbar -->
                        <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Верхняя панель</h6>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="topbar-color" value="dark" id="darktopbar-check" checked="">
                            <label class="custom-control-label" for="darktopbar-check">Темный</label>
                        </div>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="topbar-color" value="light" id="lighttopbar-check">
                            <label class="custom-control-label" for="lighttopbar-check">Светлый</label>
                        </div>


                        <button class="btn btn-primary btn-block mt-4" id="resetBtn">К стандартным настройкам</button>

                    </div>

                </div>
            </div>

        </div> <!-- end slimscroll-menu-->
    </div>

</div>
<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div id="danger-alert-modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled bg-danger">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-wrong h1 text-white"></i>
                        <h4 class="mt-2 text-white">Упс, Ошибка!</h4>
                        <p class="mt-3 text-white"><?= Yii::$app->session->getFlash('error') ?></p>
                        <button type="button" class="btn btn-light my-2" data-dismiss="modal">Окей</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div id="success-alert-modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled bg-success">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-checkmark h1 text-white"></i>
                        <h4 class="mt-2 text-white">Отлично!</h4>
                        <p class="mt-3 text-white"><?= Yii::$app->session->getFlash('success') ?></p>
                        <button type="button" class="btn btn-dark my-2" data-dismiss="modal">Окей</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('danger')): ?>
    <div id="info-alert-modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-information h1 text-info"></i>
                        <h4 class="mt-2">Обратите внимание!</h4>
                        <p class="mt-3"><?= Yii::$app->session->getFlash('danger') ?></p>
                        <button type="button" class="btn btn-info my-2" data-dismiss="modal">Окей</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
<?php endif; ?>
<?php $this->endBody() ?>
<div style="position: fixed; bottom: 0; right: 0; padding: 1rem;" data-toast-container>
    <!-- Then put toasts within -->
</div>
</body>
</html>
<?php $this->endPage() ?>
