<?php
namespace app\models;

require __DIR__ . '/../vendor/autoload.php';

use DOMDocument;
use phpDocumentor\Reflection\Types\This;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\base\Model;

class MultiUploadDamp extends Model
{

    const TYPE_PRODUCT = 'product';
    const TYPE_CATALOG = 'catalog';
    /**
     * @var UploadedFile
     */


    public $excel;
    public $type;
    private $name;
    private $output;

    public function rules()
    {
        return [
            [['excel'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xlsx, xls'],
            ['type','required'],
            ['type', 'in', 'range' => [self::TYPE_PRODUCT,self::TYPE_CATALOG]],
        ];
    }

    public function upload(){
        if($this->validate()){
            $name = 'multiupload/' . date('Y_m_d-H_i_s') . '_' . $this->type . '.' . $this->excel->extension;
            $this->excel->saveAs($name);
            $this->name = $name;
            if($this->reader() !== false)
                return $this->output;
        }
        return false;
    }

    public function reader()
    {
        try {
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($this->name);
        } catch (Exception $e) {
            $this->addError($e->getMessage());
            return false;
        }
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($this->name);
        $sheetData =  $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        if($this->type == self::TYPE_PRODUCT)
            $this->updateProducts($sheetData);
        else
            $this->catalogHandler($sheetData);
    }

    /*public function productHandler($sheetData)
    {
        $column_desc = [
            'id'=>'A',
            'name'=>'B',
            'description'=>'C',
            'property'=>'D',
            'price'=>'E',
            'idCatalog'=>'H',
            'hidden'=>'M',
            'in_stock'=>'R',
            'property_1'=>'O',
            'property_2'=>'P',
            'property_3'=>'Q',
            'brand_name'=>'S',
            'status'=>'W',
            'catalog_name'=>'I',
            'images' => 'Y'
        ];

        $brands = [];
        $catalogs = [];

        foreach ($sheetData as $row=>$column){
            $product = new Product();
            $product->article = $column['A'];
            $product->name = $column['B'];
            $product->price = (trim($column['E']) !== ''?(int)$column['E']:0);
            $product->idCatalog = $column['H'];
            $product->description = $column['C'];
            $product->hidden = $column['M'] == 1;
            $product->in_stock = strpos($column['R'], 'false') === false;
            $product->status = Product::STATUS_DEFAULT;

            $dom = new domDocument('1.0', 'UTF-8');
            @$dom->loadHTML("\xEF\xBB\xBF" . $column['D']);
            $dom->preserveWhiteSpace = false;
            $tables = $dom->getElementsByTagName('table');
            if(count($tables)){
                $tr = $tables->item(0)->getElementsByTagName('tr');
                $property = ['myrows'=>[]];
                foreach ($tr as $td) {
                    $name = $td->getElementsByTagName('th');
                    $value = $td->getElementsByTagName('td');
                    $property_elem = [];
                    if(count($name)){
                        $property_elem['name'] = $td->childNodes[0]->nodeValue;
                        $property_elem['value'] = $td->childNodes[3]->nodeValue;
                    }elseif(count($value)==2){
                        $property_elem['name'] = $value[0]->nodeValue;
                        $property_elem['value'] = $value[1]->nodeValue;
                    }elseif(count($value)==1){
                        $property_elem['name'] = explode('-',$value[0]->nodeValue)[0];
                        $property_elem['value'] = explode('-',$value[0]->nodeValue)[1];
                    }
                    array_push($property['myrows'],$property_elem);
                }
                $product->property = json_encode($property,JSON_UNESCAPED_UNICODE);
            }
            $p = $dom->getElementsByTagName('p');
            if(count($p)){
                foreach ($p as $index=>$p_elem){
                    $previous_encoding = mb_internal_encoding();
                    mb_internal_encoding('UTF-8');
                    $product->description.= $dom->saveHTML($p_elem);
                    mb_internal_encoding($previous_encoding);
                }
            }
            $images = [];
            $path = Yii::$app->basePath.'\web\images\\'. $column['A'];
            if (is_dir($path) && file_exists($path)) {
                foreach (FileHelper::findFiles($path, ['except' => ['.*']]) as $file){
                    $name_img = explode('\\',$file)[count(explode('\\',$file))-1];
                    array_push($images,['name'=>$name_img,'path'=>'images/'. $column['A'].'/'.$name_img,'size'=>filesize($file)]);
                }
            }
            $product->img = json_encode($images,JSON_UNESCAPED_UNICODE);
            $product->save();
            if(!$product->save()){
                var_dump($column['A']);
                echo PHP_EOL;
                var_dump($product->getErrorSummary(true));
                echo PHP_EOL;
            }
        }
    }*/

    public function updateProducts($sheetData){
        $column_desc = [
            'article'=>'A',
            'name'=>'B',
            'price'=>'E',
            'hidden'=>'M',
            'in_stock'=>'R',
            'status'=>'W',
        ];

        foreach ($sheetData as $row=>$column){
            $product = Product::findArticle($column[$column_desc['article']]);
            if(isset($product->id) and $column[$column_desc['article']] !== 'id'){
                if($product->name != $column[$column_desc['name']]){
                    //var_dump('Product name: '.$column[$column_desc['article']].': old - '.$product->name .' new - '.$column[$column_desc['name']].PHP_EOL);
                    $product->name = $column[$column_desc['name']];
                    $product->save();
                }
                $price = (trim($column[$column_desc['price']]) !== ''?(int)$column[$column_desc['price']]:0);
                if($product->price != $price){
                    $product->price = $price;
                    $product->save();
                }
                $hidden = $column[$column_desc['hidden']] == 1;
                if($product->hidden != $hidden){
                    //var_dump('Product hidden: '.$column[$column_desc['article']].': old - '.$product->hidden .' new - '.$hidden.PHP_EOL);
                    $product->hidden = $hidden;
                    $product->save();
                }
                $in_stock = strpos($column[$column_desc['in_stock']], 'false') === false;
                if($product->in_stock != $in_stock){
                    //var_dump('Product in_stock: '.$column[$column_desc['article']].': old - '.$product->in_stock .' new - '.$in_stock.PHP_EOL);
                    $product->in_stock = $in_stock;
                    $product->save();
                }
            }else{
                var_dump('Error: product with article '.$column[$column_desc['article']].' not found');
            }
            echo PHP_EOL;
        }
    }

    public function catalogHandler($sheetData)
    {
    }
}