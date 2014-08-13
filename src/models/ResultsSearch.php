<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Results;

/**
 * ResultsSearch represents the model behind the search form about `app\models\Results`.
 */
class ResultsSearch extends Results
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_result', 'num', 'count', 'id_exp'], 'integer'],
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
        $query = Results::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_result' => $this->id_result,
            'num' => $this->num,
            'count' => $this->count,
            'id_exp' => $this->id_exp,
        ]);

        return $dataProvider;
    }
}
