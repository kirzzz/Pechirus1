<?php
namespace app\models;

require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;


class AvitoExcel extends Model
{
    private $ListingFee = 'Package';


    public function rules()
    {
        return [];
    }

    public function createExcel(){
        if($this->validate()){
            //Создаем экземпляр класса электронной таблицы
            $spreadsheet = new Spreadsheet();
            //Получаем текущий активный лист
            $sheet = $spreadsheet->getActiveSheet();
            // Записываем в ячейку A1 данные

            $sheet->setCellValue('A1', 'Id');
            $sheet->setCellValue('B1', 'AvitoId');
            $sheet->setCellValue('C1', 'AdStatus');
            $sheet->setCellValue('D1', 'Category');
            $sheet->setCellValue('E1', 'GoodsType');
            $sheet->setCellValue('F1', 'Address');
            $sheet->setCellValue('G1', 'Title');
            $sheet->setCellValue('H1', 'Description');
            $sheet->setCellValue('I1', 'Condition');
            $sheet->setCellValue('J1', 'Price');
            $sheet->setCellValue('K1', 'DateBegin');
            $sheet->setCellValue('L1', 'DateEnd');
            $sheet->setCellValue('M1', 'AllowEmail');
            $sheet->setCellValue('N1', 'ManagerName');
            $sheet->setCellValue('O1', 'ContactPhone');
            $sheet->setCellValue('P1', 'AdType');
            $sheet->setCellValue('Q1', 'ImageUrls');

            $products = Product::find()->where(['in','id',AvitoToProduct::getActiveId()])->all();

            foreach ($products as $index => $product){
                $sheet->setCellValue('A'.($index+2), $product->id);
                $sheet->setCellValue('B'.($index+2), '');
                $sheet->setCellValue('C'.($index+2), 'Free');
                $sheet->setCellValue('D'.($index+2), 'Ремонт и строительство');
                $sheet->setCellValue('E'.($index+2), 'Камины и обогреватели');
                $sheet->setCellValue('F'.($index+2), 'МКАД 92км, Мытищи ул. Красный поселок, д.2a, ТЦ Садовод Линия Е, павильоны №47-48');
                $sheet->setCellValue('G'.($index+2), $product->name);
                $sheet->setCellValue('H'.($index+2), static::GetProductDescAndProperty($product));
                $sheet->setCellValue('I'.($index+2), 'Новое');
                $sheet->setCellValue('J'.($index+2), $product->price);
                $sheet->setCellValue('K'.($index+2), date('Y-m-d'));
                $sheet->setCellValue('L'.($index+2), date("Y-m-d", strtotime("+1 month")));
                $sheet->setCellValue('M'.($index+2), 'Да');
                $sheet->setCellValue('N'.($index+2), 'Кулаков Антон Валентинович');
                $sheet->setCellValue('O'.($index+2), '+7 (495) 540-47-03');
                $sheet->setCellValue('P'.($index+2), 'Товар от производителя');
                $sheet->setCellValue('Q'.($index+2),static::GetImgUrls($product));
            }

            $writer = new Xlsx($spreadsheet);
            $name = 'avito/' . date('Y_m_d-H_i_s') . '_' .'avito.xlsx';
            $writer->save($name);
            return $name;
        }
        return false;
    }

    private static function GetProductDescAndProperty(Product $product){
        $params = $product->property;
        $desc = $product->description;
        if($params){
            $new_param = '';
            if(isset($desc) and trim(strip_tags($desc)) !== ''){
                $new_param.= 'Описание: '.PHP_EOL.$desc.PHP_EOL.PHP_EOL;
            }
            $params = json_decode($product->property,true);
            if(isset($params['myrows'])){
                $new_param.= 'Характеристики:';
                foreach ($params['myrows'] as $param){
                    $new_param .= $param['name'] .': '. $param['value'].PHP_EOL;
                }
                return $new_param;
            }
        }
        return false;
    }

    private static function  GetImgUrls(Product  $product){
        $imgs = json_decode($product->img,true);
        $urls = '';
        if(!empty($imgs)){
            foreach ($imgs as $img){
                $urls .= Url::to($img['path'],true).PHP_EOL;
            }
        }
        return $urls;
    }
}