<?php


namespace app\models;


use Yandex\Market\Partner;
use Yandex\Market\Partner\Clients\AssortmentClient;
use Yandex\Market\Partner\Clients\BaseClient;
use Yandex\Market\Partner\Clients\BidClient;
use Yandex\Market\Partner\Clients\FeedbackClient;
use Yandex\Market\Partner\Clients\FinanceClient;
use Yandex\Market\Partner\Clients\QualityClient;
use Yandex\Market\Partner\Clients\StatisticClient;

class YandexMarket
{
    //BASE PARAMS
    const oauth_token = 'AQAAAAATSk-lAAcD3ocOWdXFBExeqLlDELX6_cM';
    const oauth_client_id = '3a8caa3d59fe43729a8d8f43e5dc2ab6';
    const id_shop = '21267247';

    const base_uri = 'https://api.partner.market.yandex.ru/v2/campaigns/'.self::id_shop;

    const BIDS_RECOMMENDED_CARD = 'MODEL-CARD';
    const BIDS_RECOMMENDED_MARKET_SEARCH = 'MARKET-SEARCH';
    const BIDS_RECOMMENDED_SEARCH = 'SEARCH';

    //BIDS
    protected function offersBids($page = 0,$type = null){
        $feeds = YandexProductStat::find()->limit(500)->offset($page*500)->all();
        $offers = [];
        if($type)
            $offers['target'] = $type;
        foreach ($feeds as $feed){
            $offers['offers'][] = ['feedId'=>$feed['feedId'],'offerId'=>$feed['offerId']];
        }
        var_dump($offers);
        return $offers;
    }

    public function getBidsInfo(){
        $bidClient = new BidClient(self::oauth_client_id, self::oauth_token);
        $bids_arr = [];
        $page = 0;
        while (!empty($offers = $this->offersBids($page))){
            $bids = $bidClient->getBids(self::id_shop, $this->offersBids($page));
            foreach($bids->getBids()->toArray() as $bid){
                $bids_arr[] = $bid;
            }
            $page++;
        }
        return $bids_arr;
    }

    public function getBidsRecommended($type = self::BIDS_RECOMMENDED_CARD){
        $bidClient = new BidClient(self::oauth_client_id, self::oauth_token);
        $bids_arr = [];
        $page = 0;
        while (!empty($offers = $this->offersBids($page,$type))){
            $bids = $bidClient->getRecommendedBids(self::id_shop, $offers);
            if(is_array($bids)) {
                foreach ($bids->getBids()->toArray() as $bid) {
                    $bids_arr[] = $bid;
                }
                $page++;
            }else{
                var_dump($bids);
                return null;
            }
        }
        return $bids_arr;
    }

    public function getBidsRecommendedMarket(){
        $bidClient = new BidClient(self::oauth_client_id, self::oauth_token);
        $bids = $bidClient->getPopularRecommendedBidsMarketSearch(self::id_shop, $this->offersBids());
        return $bids->toArray();
    }

    public function getBidsSettings(){
        $bidClient = new BidClient(self::oauth_client_id, self::oauth_token);
        $bidsSettings = $bidClient->getBidsSettings(self::id_shop);
        return $bidsSettings;
    }



    //BALANCE
    public function getBalance(){
        $financeClient = new FinanceClient(self::oauth_client_id, self::oauth_token);
        $balanceObject = $financeClient->getBalance(self::id_shop);
        return $balanceObject->toArray();
    }


    //PriceList
    public function getAllPriceList(){
        $assortmentClient = new AssortmentClient(self::oauth_client_id, self::oauth_token);
        $feeds = $assortmentClient->getFeeds(self::id_shop);
        return $feeds->toArray();
    }

    public function getPriceListInfo($feed_id){
        $assortmentClient = new AssortmentClient(self::oauth_client_id, self::oauth_token);
        $feed = $assortmentClient->getFeed(self::id_shop, $feed_id);
        return $feed->toArray();
    }

    //Feedback
    public function getFeedback(){
        function echoComment($comment, $level = 0)
        {
            $tabs = str_repeat("\t", $level);
            echo $tabs . $comment->getAuthor() . ": " . $comment->getBody();
            $childrenComments = $comment->getChildren();
            foreach ($childrenComments as $childrenComment) {
                echoComment($childrenComment, $level + 1);
            }
        }
        $feedbackClient = new FeedbackClient(self::oauth_client_id, self::oauth_token);
        $getFeedback = $feedbackClient->getFeedback(self::id_shop)->getResult();

        return $getFeedback->toArray();
    }

    //STAT
    public function getBaseStat(){
        $statisticClient = new StatisticClient(self::oauth_client_id, self::oauth_token);
        $data = $statisticClient->getMain(self::id_shop, [
            // Начальная дата отчетного периода, обязательный параметр
            'fromDate' => date('d-m-Y', strtotime(date('Y-m-d'). " - 30 day")),
            // Конечная дата отчетного периода, необязательный параметр
            'toDate' => date('d-m-Y'),
        ]);

        return $data->toArray();
    }

    public function getOffers(){
        $statisticClient = new StatisticClient(self::oauth_client_id, self::oauth_token);
        $pageNumber = 0;
        $data = [];
        do {
            $pageNumber++;
            $offersStatsObject = $statisticClient->getOffersStats(self::id_shop, [
                // Начальная дата отчетного периода, обязательный параметр
                'fromDate' => date('d-m-Y', strtotime(date('Y-m-d'). " - 30 day")),
                // Конечная дата отчетного периода, необязательный параметр
                'toDate' => date('d-m-Y'),
                'page' => $pageNumber,
                'pageSize' => 100
            ]);
            $offersStats = $offersStatsObject->getOfferStats();
            foreach ($offersStats as $offer){
                $data[] = $offer->toArray();
            }
        } while ($offersStatsObject->getToOffer() != $offersStatsObject->getTotalOffersCount());

        return $data;
    }


    // QUALITY CONTROL

    public function getQualityClientError(){
        $qualityClient = new QualityClient(self::oauth_client_id, self::oauth_token);
        $data = $qualityClient->getTickets(self::id_shop);

        return $data->toArray();
    }

    public function getQualityClientReport(){
        $qualityClient = new QualityClient(self::oauth_client_id, self::oauth_token);
        $data = $qualityClient->getReport(self::id_shop);

        return $data->toArray();
    }
}