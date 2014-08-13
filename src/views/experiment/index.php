<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ExperimentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Experiments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="experiment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Experiment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_exp',
            'date',
            'time',
            'name',
            'bones_num',
            'throws',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
