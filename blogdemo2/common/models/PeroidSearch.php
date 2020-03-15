<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Peroid;

/**
 * PeroidSearch represents the model behind the search form about `common\models\Peroid`.
 */
class PeroidSearch extends Peroid
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'num', 'total'], 'integer'],
            [['start_time', 'endtime'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Peroid::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'start_time' => $this->start_time,
            'endtime' => $this->endtime,
            'num' => $this->num,
            'total' => $this->total,
        ]);

        return $dataProvider;
    }
}
