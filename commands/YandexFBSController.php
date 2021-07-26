<?php


namespace app\commands;


use yii\console\Controller;

class YandexFBSController extends Controller
{
    const oauth_token = 'AQAAAAATSk-lAAcD3ocOWdXFBExeqLlDELX6_cM';
    const oauth_client_id = '3a8caa3d59fe43729a8d8f43e5dc2ab6';

    public function actionQuality()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.partner.market.yandex.ru/v2/campaigns/22108060/offer-mapping-entries/updates.json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>json_encode($api,JSON_UNESCAPED_UNICODE),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: OAuth oauth_token=\"self::oauth_token\", oauth_client_id=\"\""
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        print_r($response);
    }
}