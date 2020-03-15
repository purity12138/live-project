<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "appointment".
 *
 * @property integer $id
 * @property string $identify
 * @property string $tel
 * @property integer $number
 * @property integer $period_id
 * @property integer $serial
 */
class Appointment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'appointment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['identify', 'tel', 'number', 'period_id', 'serial', 'win'], 'required'],
            [['number', 'period_id', 'serial', 'win'], 'integer'],
            [['identify'], 'string', 'max' => 19],
            [['tel'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'identify' => 'Identify',
            'tel' => 'Tel',
            'number' => 'Number',
            'period_id' => 'Period ID',
            'serial' => 'Serial',
            'win' => 'Win'
        ];
    }
}
