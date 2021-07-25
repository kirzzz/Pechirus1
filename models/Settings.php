<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $json
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['json'], 'string'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'json' => 'Json',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
