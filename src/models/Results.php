<?php

namespace app\models;


use Yii;
use yii\db\Command;
use yii\db\Connection;

/**
 * This is the model class for table "results".
 *
 * @property integer $id_result
 * @property integer $num
 * @property integer $count
 * @property integer $id_exp
 *
 * @property Experiment $idExp
 */
class Results extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'results';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['num', 'count', 'id_exp'], 'required'],
            [['num', 'count', 'id_exp'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_result' => 'Id Result',
            'num' => 'Num',
            'count' => 'Count',
            'id_exp' => 'Id Exp',
            'countres' => 'Countres',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdExp()
    {
        return $this->hasOne(Experiment::className(), ['id_exp' => 'id_exp']);
    }

    public function getExperiment()
    {
        return $this->hasOne(Experiment::className(), ['id_exp' => 'id_exp']);
    }

    public function getProcent () {
        $totalCount = $this->experiment->throws;
        return ($totalCount > 0) ? ($this->count / $totalCount): 0;
    }


}
