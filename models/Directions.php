<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "directions".
 *
 * @property int $id
 * @property string $loc_from
 * @property string $loc_to
 */
class Directions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'directions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['loc_from', 'loc_to'], 'required'],
            [['loc_from', 'loc_to'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'loc_from' => 'Откуда',
            'loc_to' => 'Куда',
        ];
    }
}
