<?php
/* @var $this yii\web\View */
/* @var $data Log[]*/

use app\models\Log;
use yii\helpers\Url;

$this->title = 'История сайта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?= Url::to(['admin/index']) ?>">Главная</a></li>
                        <li class="breadcrumb-item active">История сайта</li>
                    </ol>
                </div>
                <h4 class="page-title">История сайта</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-12">
            <?php if (!empty($data)):?>
            <div class="timeline" dir="ltr">
                <?php foreach ($data as $index => $log):?>
                <?php
                $text = '';
                $info = json_decode($log->info,true);
                if($log->type == Log::TYPE_USER){
                    $text = Log::ACTION_DESCRIPTION[$log->action].' '.Log::TYPE_DESCRIPTION[$log->type]. ': <a href="'.Url::toRoute(['admin/users','id'=>$info['id']]).'">'.$info['username'].'</a>';
                }elseif ($log->type == Log::TYPE_ORDERS){
                    $text = Log::ACTION_DESCRIPTION[$log->action].' '.Log::TYPE_DESCRIPTION[$log->type].': <a href="'.Url::toRoute(['admin/orders-details','id'=>$info['id']]).'">'.$info['article'].'</a>';
                }elseif ($log->type == Log::TYPE_CONTACT){
                    $text = Log::ACTION_DESCRIPTION[$log->action].' '.Log::TYPE_DESCRIPTION[$log->type].': <a href="'.Url::toRoute(['admin/contact']).'">'.$info['name'].'</a>';
                }elseif ($log->type == Log::TYPE_COMMENTS){
                    $text = Log::ACTION_DESCRIPTION[$log->action].' '.Log::TYPE_DESCRIPTION[$log->type].': <a href="'.Url::toRoute(['site/product','id'=>$info['idProduct']]).'">'.$info['name'].'</a>';
                }
                if(!isset($date) or $date != date('d.m.Y',$log->created_at)):
                    $date = date('d.m.Y',$log->created_at);?>
                <article class="timeline-item">
                    <h2 class="m-0 d-none">&nbsp;</h2>
                    <div class="time-show mt-0">
                        <a href="#" class="btn btn-primary width-lg"><?= $date ?></a>
                    </div>
                </article>
                <?php  endif; ?>
                <article class="timeline-item <?= $index%2==0?'timeline-item-left':'' ?>">
                    <div class="timeline-desk">
                        <div class="timeline-box">
                            <span class="<?= $index%2==0?'arrow-alt':'arrow' ?>"></span>
                            <span class="timeline-icon"><i class="mdi mdi-adjust"></i></span>
                            <h4 class="mt-0 font-16"><?= date('d.m.Y',$log->created_at) ?></h4>
                            <p class="text-muted"><small><?= date('H:i:s',$log->created_at) ?></small></p>
                            <p class="mb-0"><?= $text ?></p>
                        </div>
                    </div>
                </article>
                <?php endforeach;?>
            </div>
            <?php else: ?>
            <h4>Нет данных</h4>
            <?php endif; ?>
            <!-- end timeline -->
        </div> <!-- end col -->
    </div>
    <!-- end row -->

</div>
