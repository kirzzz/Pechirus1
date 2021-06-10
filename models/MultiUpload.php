<?php
namespace app\models;

require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\web\UploadedFile;
use yii\base\Model;

class MultiUpload extends Model
{

    /**
     * @var UploadedFile
     */

    public $excel;
    private $name;

    public function rules()
    {
        return [
            [['excel'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xlsx, xls'],
        ];
    }

    public function upload(){
        if($this->validate()){
            $name = 'multiupload/' . date('Y_m_d-H_i_s') . '_products.' . $this->excel->extension;
            $this->excel->saveAs($name);
            $this->name = $name;
            if(($file = $this->reader()) !== false)
                return $file;
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
        $output = $this->updateProducts($sheetData);
        if(!empty($output)){
            $filename = $this->createOutput($output);
            return $filename;
        }

        return false;
    }

    private function createOutput($output){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Строка');
        $sheet->setCellValue('B1', 'ID');
        $sheet->setCellValue('C1', 'Статус');
        $sheet->setCellValue('D1', 'Информация');
        foreach ($output as $index => $out){
            $sheet->setCellValue('A'.($index+2), $out['row']);
            $sheet->setCellValue('B'.($index+2), $out['id']);
            $sheet->setCellValue('C'.($index+2), $out['status']);
            $sheet->setCellValue('D'.($index+2), $out['info']);
        }

        $writer = new Xlsx($spreadsheet);
        $name = 'multiupload/output/' . date('Y_m_d-H_i_s') . '_' .'output.xlsx';
        $writer->save($name);
        return $name;
    }

    public function updateProducts($sheetData){
        $output = [];
        foreach ($sheetData as $row=>$column){
            $product = Product::findIdentity($column['A']);
            if(isset($product->id) and $row != 1){
                $error = new SetError();
                $product->name = $column['E'];
                $product->price = ((trim($column['F']) !== '' and is_numeric($column['F']))?$column['F']:$product->price);
                $product->purchasePrice = ((trim($column['G']) !== '' and is_numeric($column['G']))?$column['G']:$product->purchasePrice);
                $product->new_price = ((trim($column['H']) !== '' and is_numeric($column['H']))?$column['H']:$product->new_price);
                $product->in_stock = ((trim($column['K']) !== '' and is_numeric($column['K']))?$column['K']:$product->in_stock);
                $product->hidden = ((trim($column['L']) !== '' and is_numeric($column['L']))?$column['L']:$product->hidden);
                $product->save();
                if($product->save()){
                    $output[] = ['row'=>$row,'id'=>$column['A'],'status'=>'Успех','info'=>'Продукт успешно обновлен!'];
                }else{
                    $output[] = ['row'=>$row,'id'=>$column['A'],'status'=>'Ошибка','info'=>'Ошибка:'.$error->setError($product,'',1)];
                }
            }else{
                $output[] = ['row'=>$row,'id'=>$column['A'],'status'=>'Ошибка','info'=>'Ошибка: Не удалось найти продукт с заданным ID = '.$column['A']];
            }
        }
        return $output;
    }
}