<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "peroid".
 *
 * @property integer $id
 * @property string $start_time
 * @property string $endtime
 * @property integer $num
 * @property integer $total
 */
class Peroid extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'peroid';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_time', 'endtime', 'num', 'total'], 'required'],
            [['start_time', 'endtime'], 'safe'],
            [['num', 'total'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start_time' => 'Start Time',
            'endtime' => 'Endtime',
            'num' => 'Num',
            'total' => 'Total',
        ];
    }
    public function getUrl()
    {
        return Yii::$app->urlManager->createUrl(
            ['peroid/detail','id'=>$this->id]);
    }
}
