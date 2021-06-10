<?php

namespace app\commands;

use app\models\Log;
use app\models\Product;
use app\models\Yandex;
use app\models\YandexBaseStat;
use app\models\YandexMarket;
use app\models\YandexProductStat;
use Yii;
use yii\console\Controller;
use yii\helpers\Url;

class YandexController extends Controller
{
    public function log($model,$name){
        if(!$model->save()){
            $log = new Log(['action' => 'create','type' => 'Yandex_'.$name,'status' => 0,'info' => json_encode($model->errors,JSON_UNESCAPED_UNICODE)]);
            $log->save();
        }
    }

    public function fullYandex($datum,$name){
        $yandex = new Yandex();
        $yandex = new Yandex(['name' => $name,'json' => json_encode($datum,JSON_UNESCAPED_UNICODE)]);
        $yandex->save();
        $this->log($yandex,$name);
    }

    public function actionQuality()
    {
        $yandex_api = new YandexMarket();

        $QualityClientError = $yandex_api->getQualityClientError();
        $this->fullYandex($QualityClientError,Yandex::QUALITY_ERROR);

        $QualityClientReport = $yandex_api->getQualityClientReport();
        $this->fullYandex($QualityClientReport,Yandex::QUALITY_REPORT);
    }

    public function actionStat()
    {
        $yandex_api = new YandexMarket();

        $BaseStat = $yandex_api->getBaseStat();
        $this->fullYandex($BaseStat,Yandex::STAT_BASE);

        $Offers = $yandex_api->getOffers();
        $this->fullYandex($Offers,Yandex::STAT_OFFER);
    }

    public function actionFeedback()
    {
        $yandex_api = new YandexMarket();

        $Feedback = $yandex_api->getFeedback();
        $this->fullYandex($Feedback,Yandex::FEEDBACK);
    }

    //DO AFTER getOfferStat
    public function actionBids()
    {
        $yandex_api = new YandexMarket();

        /*$BidsInfo = $yandex_api->getBidsInfo();
        $this->fullYandex($BidsInfo,Yandex::BIDS_INFO);*/

        $BidsRecommended = $yandex_api->getBidsRecommended();
        if($BidsRecommended)
            $this->fullYandex($BidsRecommended,Yandex::BIDS_INFO);
    }

    public function actionBalance(){
        $yandex_api = new YandexMarket();

        $Balance = $yandex_api->getBalance();
        $this->fullYandex($Balance,Yandex::BALANCE);
    }

    public function actionPriceList(){
        $yandex_api = new YandexMarket();

        $AllPriceList = $yandex_api->getAllPriceList();
        $this->fullYandex($AllPriceList,Yandex::FEEDBACK);
    }

    //IMPORT IN TO TABLE LIST

    public function actionGetOfferStat(){
        $data = Yandex::getOffersStat();
        foreach ($data as $datum){
            $product = Product::findArticle($datum['offerId']);
            if(isset($product->id)){
                $yandex_stat = YandexProductStat::findIdProduct($product->id);
                if(!isset($yandex_stat->idProduct))
                    $yandex_stat = new YandexProductStat();
                $yandex_stat->idProduct = $product->id;
                $yandex_stat->clicks = $datum['clicks'];
                $yandex_stat->offerId = $datum['offerId'];
                $yandex_stat->feedId = $datum['feedId'];
                $yandex_stat->spending = $datum['spending'];
                $yandex_stat->save();
                if(!$yandex_stat->save()){
                    $this->log($yandex_stat,'YandexProductStat');
                }
            }else{
                $body = Yii::$app->view->renderFile ( '@app/mail/layouts/error_log.php' , [
                    'error'=>'Несоответстивие YML продуктов к БД',
                    'data'=>'OfferID - '.$datum['offerId']
                ]);
                Yii::$app->mailer->compose()
                ->setFrom(['info@pechirus.ru' => 'Письмо с сайта Pechirus']) //TODO EDIT WITH NEW EMAIL
                ->setTo('pechirus@mail.ru')
                ->setSubject('Ошибка')
                ->setHtmlBody($body)
                ->send();
            }
        }
    }

    public function actionGetBaseStat(){
        $data = Yandex::getBaseStat();
        foreach ($data as $datum){
            $row = YandexBaseStat::findDate($datum['date']);
            if(!isset($row->id)){
                $row = new YandexBaseStat();
                $row->date = $datum['date'];
            }
            $row->clicks = $datum['clicks'];
            $row->spending = $datum['spending'];
            $row->placeGroup = $datum['placeGroup'];
            $row->save();
            if(!$row->save()){
                $this->log($row,'YandexBaseStat');
            }
        }
    }
}