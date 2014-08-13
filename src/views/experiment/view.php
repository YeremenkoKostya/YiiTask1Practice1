<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Experiment */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Experiments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="experiment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_exp], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_exp], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_exp',
            'date',
            'time',
            'name',
            'bones_num',
            'throws',
        ],
    ]) ?>
    <h3>Таблица "еxperiment" номер експеримента = <?=$model->id_exp?> </h3>
     <?= GridView::widget([
        'dataProvider' => $resExperiment,
        'columns' => [
            //'id_exp',
            'date',
            'time',
            'name',
            'bones_num',
            'throws',
        ],
    ]) ?>

<?php if (!empty ($model->results)):?>

    <h3>Таблица "results"</h3>
     <?= GridView::widget([
         'dataProvider' => $resResult,
         'columns' => [
             //'id_result',
             'num',
             'count',
             //'id_exp',
           [
           'attribute' => 'procent',
           'format' => ['percent'],
       ],
                     ],
]); ?>

    <?php foreach ($model->results as $result):?>
    <div> num: <?= $result->num ?> &nbsp &nbsp &nbsp
        count : <?=$result->count?> &nbsp &nbsp &nbsp
        соотношение: 1/ <?php $a = round(36000/$result->count); echo $a?> &nbsp &nbsp &nbsp
        id_result : <?=$result->id_result?></div>
    <?php endforeach; ?>

<?php else: ?>
НЕТ РЕЗУЛЬТАТОВ
<?php endif; ?>
</div>