<?php
namespace app\commands;

use app\models\Brand;
use app\models\Catalog;
use app\models\Product;
use app\models\YandexCategory;
use app\models\YandexProductStat;
use SplFileInfo;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\console\Controller;
use yii\console\ExitCode;

class HelloController extends Controller
{
    public function actionIndex()
    {
        $a = file_get_contents("C:\Users\kirzzz\PhpstormProjects\Pechi\Pechirus\web\product_json\catalogs.json");
        $a = json_decode($a,true);
        foreach ($a as $key=>$value) {
            $catalog = new Catalog();
            $catalog->article = $key;
            $catalog->name = $value['name'];
            $catalog->idParent = isset($value['parent'])?$value['parent']:null;
            $catalog->save();
            if(!$catalog->save()){
                print_r($catalog->getErrorSummary(true));
            }
        }
    }

    public function actionCreateYandexCategory(){
        $a = file_get_contents("C:\Users\kirzzz\PhpstormProjects\\testPHP\pechirus\json\yandex_catalog.json");
        $a = json_decode($a,true);
        foreach ($a as $key=>$value) {
            $catalog = new YandexCategory();
            $catalog->id = $value['id'];
            $catalog->name = $value['name'];
            $catalog->idParent = isset($value['idParent'])?$value['idParent']:null;
            $catalog->save();
            if(!$catalog->save()){
                print_r($catalog->getErrorSummary(true));
            }
        }
    }

    public function actionTest()
    {
        $path = Yii::$app->basePath.'/web/images/default'.'/'.'%D1%81%D0%B8%D0%B1%D0%B8%D1%80%D1%8C%2020%D0%BB%D0%BA.jpeg';
        rename($path,Yii::$app->security->generateRandomString().'.'.pathinfo($path)['extension']);
    }

    public function actionRenameFiles()
    {
        $products = Product::find()->select(['id','img'])->asArray()->all();
        $err = [];
        foreach ($products as $val){
            $imgs = json_decode($val['img'],true);
            if(is_array($imgs)){
                unset($info);
                foreach ($imgs as $index => $img){
                    $temp = urldecode($img['path']);
                    if($temp !== $img['path']){
                        $info = new SplFileInfo($img['path']);
                        $info->getPath();
                        $path = Yii::$app->basePath.'/web/'.$img['path'];
                        $new_name = mb_strimwidth(md5(Yii::$app->security->generateRandomString()),0,10,'') .'.'.pathinfo($path)['extension'];
                        $new_path = $info->getPath().'/'.$new_name;
                        $imgs[$index]['path'] = $new_path;
                        $imgs[$index]['name'] = $new_name;
                        rename($path,Yii::$app->basePath.'/web/'.$new_path);
                    }
                }
                if(isset($info)){
                    array_push($err,['old'=>json_decode($val['img'],true),'new'=>$imgs]);
                    Product::updateAll(['img' => json_encode($imgs)], ['=', 'id', $val['id']]);
                }
            }
        }
    }

    public function actionRenameFilesX(){
        $products = Product::find()->all();
        foreach ($products as $product){
            $images = [];
            $path = Yii::$app->basePath.'\web\images\\'. $column['A'];
            if (is_dir($path) && file_exists($path)) {
                foreach (FileHelper::findFiles($path, ['except' => ['.*']]) as $file){
                    $name_img = explode('\\',$file)[count(explode('\\',$file))-1];
                    array_push($images,['name'=>$name_img,'path'=>'images/'. $column['A'].'/'.$name_img,'size'=>filesize($file)]);
                }
            }
            $product->img = json_encode($images,JSON_UNESCAPED_UNICODE);
        }
        //TODO переименовать изображения
    }

    public function actionBrandController(){
        $brands = Brand::find()->all();
        foreach ($brands as $brand) {
            $str_name = $brand->name;
            preg_match('/\((.+)\)/', $str_name, $m);
            if(!empty($m)){
                $str_name_1 = explode('(',$str_name);
                Product::updateAll(['idBrand'=>$brand->id],['or',['like','lower(name)',$str_name_1[0]],['like','lower(name)',$m[1]]]);
            }else{
                Product::updateAll(['idBrand'=>$brand->id],['like','lower(name)',$brand->name]);
            }
        }
    }

    public function actionParse(){
        $products = YandexProductStat::find()->with('product')->limit(100)->all();
        $api = [];
        $api['region_id'] = 213;
        foreach ($products as $product){
            $api['site_products'][]['product_name'] = $product['product']['name'];
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apimarket.parserdata.ru/task/search/',
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
                "Authorization: Token 781946bb19a896c6c1e6c65ddc44f07c2080f64e"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        print_r($response);
    }

    public function actionParseGet(){
        $task = '946661';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apimarket.parserdata.ru/task/'.$task.'/search/?page=1',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Token 781946bb19a896c6c1e6c65ddc44f07c2080f64e"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        print_r(json_encode(json_decode($response,true),JSON_UNESCAPED_UNICODE));
    }

    public function actionTestCompare(){
        $products = Product::find()->all();
        foreach ($products as $product){
            $json = json_decode($product->property,true);
            if(isset($json['myrows'])){
                foreach ($json['myrows'] as $index=>$row){
                    if(!isset($row['name'])){
                        unset($json['myrows'][$index]);
                        $trig = 1;
                    }
                }
                if(isset($trig)){
                    $product->property = json_encode($json,JSON_UNESCAPED_UNICODE);
                    $product->save();
                    var_dump($product->id);
                }
            }
        }
    }
}
