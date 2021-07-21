<?php
namespace app\models;

require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yii;
use yii\base\Model;

class MultiUnload extends Model
{
    public $idCatalog;
    public $child;

    public function rules()
    {
        return [
            ['idCatalog','integer'],
            ['idCatalog','exist','skipOnEmpty' => true,'targetClass' => Catalog::className(),'targetAttribute' => ['idCatalog'=>'id']],
            ['child','boolean']
        ];
    }

    public function createExcel(){
        if($this->validate()){
            //Создаем экземпляр класса электронной таблицы
            $spreadsheet = new Spreadsheet();
            //Получаем текущий активный лист
            $sheet = $spreadsheet->getActiveSheet();
            // Записываем в ячейку A1 данные
            if ($this->idCatalog){
                $catalogs = $this->idCatalog;
                if ($this->child)
                    $catalogs = Catalog::getTreeDown($this->idCatalog);
                $products = Product::find()->andWhere(['in','idCatalog',$catalogs])->all();
            }else{
                $products = Product::find()->all();
            }

            $sheet->setCellValue('A1', 'ID');
            $sheet->setCellValue('B1', 'Артикул');
            $sheet->setCellValue('C1', 'Каталог');
            $sheet->setCellValue('D1', 'Брэнд');
            $sheet->setCellValue('E1', 'Название');
            $sheet->setCellValue('F1', 'Цена');
            $sheet->setCellValue('G1', 'Цена закупки');
            $sheet->setCellValue('H1', 'Цена со скидкой');
            $sheet->setCellValue('I1', 'Хар-ки');
            $sheet->setCellValue('J1', 'Описание');
            $sheet->setCellValue('K1', 'В наличии');
            $sheet->setCellValue('L1', 'Скрыт');
            $sheet->setCellValue('M1', 'Статус');
            $sheet->setCellValue('N1', 'Количество');
            foreach ($products as $index => $product){
                $sheet->setCellValue('A'.($index+2), $product->id);
                $sheet->setCellValue('B'.($index+2), $product->article);
                $sheet->setCellValue('C'.($index+2), $product->getCatalogName());
                $sheet->setCellValue('D'.($index+2), $product->getBrandName());
                $sheet->setCellValue('E'.($index+2), $product->name);
                $sheet->setCellValue('F'.($index+2), $product->price);
                $sheet->setCellValue('G'.($index+2), $product->purchasePrice);
                $sheet->setCellValue('H'.($index+2), $product->new_price);
                $sheet->setCellValue('I'.($index+2), $product->property);
                $sheet->setCellValue('J'.($index+2), strip_tags($product->description));
                $sheet->setCellValue('K'.($index+2), $product->in_stock);
                $sheet->setCellValue('L'.($index+2), $product->hidden);
                $sheet->setCellValue('M'.($index+2), $product->status);
                $sheet->setCellValue('N'.($index+2), $product->count);
            }

            $writer = new Xlsx($spreadsheet);
            $name = 'multiunload/' . date('Y_m_d-H_i_s') . '_' .'products.xlsx';
            $writer->save($name);
            return $name;
        }
        return false;
    }

    public function attributeLabels()
    {
        return [
            'child' => Yii::t('app', 'Выгрузка дочерних каталогов'),
        ];
    }
}