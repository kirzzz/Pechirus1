<?php


namespace app\models;

use yii\base\Model;
use Yii;

class SetError extends Model
{
    public function setError($model,$error,$type = 0){
        foreach ($model->getErrors() as $err) {
            $error .= implode(';', $err) . '<br/>';
        }
        if ($type)
            return $error;
        Yii::$app->session->setFlash('error', $error);
    }
}