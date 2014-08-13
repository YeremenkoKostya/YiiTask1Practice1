<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "experiment".
 *
 * @property integer $id_exp
 * @property string $date
 * @property string $time
 * @property string $name
 * @property integer $bones_num
 * @property integer $throws
 *
 * @property Results[] $results
 */
class Experiment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'experiment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['bones_num', 'throws'], 'integer'],
            [['date', 'time', 'name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_exp' => 'Id Exp',
            'date' => 'Date',
            'time' => 'Time',
            'name' => 'Name',
            'bones_num' => 'Bones Num',
            'throws' => 'Throws',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResults()
    {
        return $this->hasMany(Results::className(), ['id_exp' => 'id_exp']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->date = date("m.d.y");
            $this->time = date("H:i:s");
            $this->bones_num = 2;
            $this->throws = 36000;
            return true;
        } else {
            return false;
        }
    }


    public function afterSave($insert, $changedAttribute) {
        $connection = \Yii::$app->db;

        $arrayBones = array(2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0, 12=>0);
                 //print_r($arrayBones);
                 $numberBroskov = 36000;
                 $res=0;
                 for($i=0; $i<$numberBroskov; $i++){
                     $res = (rand(1,6)+ rand(1,6));
                   $arrayBones[$res]+=1;
                 }
        //$Id = $this->id_exp;

        //$command = $connection->createCommand("$results",[`$num`,`$count`,`$Id`]);

         $command = $connection->createCommand(
            'SELECT DISTINCT  `id_exp`
            FROM  `experiment`
            WHERE  `id_exp` = (
            SELECT MAX(  `id_exp` )
            FROM  `experiment` ) ');
         $post = $command->queryOne();
         $index = $post['id_exp'];


        foreach ($arrayBones as $key => $value) {
            $connection->createCommand()->batchInsert('bones.results', ['num', 'count', 'id_exp'], [
                [$key, $value, $index],
            ])->execute();
        }
    }

}
