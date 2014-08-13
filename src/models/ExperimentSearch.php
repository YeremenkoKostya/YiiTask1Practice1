<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Experiment;

/**
 * ExperimentSearch represents the model behind the search form about `app\models\Experiment`.
 */
class ExperimentSearch extends Experiment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_exp', 'bones_num', 'throws'], 'integer'],
            [['date', 'time', 'name'], 'safe'],
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
        $query = Experiment::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_exp' => $this->id_exp,
            'bones_num' => $this->bones_num,
            'throws' => $this->throws,
        ]);

        $query->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'time', $this->time])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
