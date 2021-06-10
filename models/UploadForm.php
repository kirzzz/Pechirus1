<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    public function upload($article)
    {
        if ($this->validate()) {
            $name = 'images/' . $article . '_' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($name);
            return $name;
        } else {
            return false;
        }
    }

    public function uploadProduct($product_id)
    {
        if ($this->validate()) {
            $path = 'images/'. $product_id;
            FileHelper::createDirectory($path);
            $name = $path . '/' . Yii::$app->security->generateRandomString() . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($name);
            return $name;
        } else {
            return false;
        }
    }

    public function getPath($article){
        if($this->imageFile->baseName)
            $name = 'images/' . $article . '_' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
        else
            return false;
        return $name;
    }
}