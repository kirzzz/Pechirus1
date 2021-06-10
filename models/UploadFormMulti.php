<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadFormMulti extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    public function upload($product_id)
    {
        $arr = [];
        if ($this->validate()) {
            foreach ($this->imageFiles as $index=>$file) {
                $name = 'images/'.$product_id.'/'.$index.'_'.time ().'.'.$file->extension;
                $file->saveAs($name);
                array_push($arr,$name);
            }
            return json_encode($arr);
        } else {
            return false;
        }
    }
}