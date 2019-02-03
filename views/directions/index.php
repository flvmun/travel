<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DirectionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Направления';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="directions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить Направление', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'loc_from',
            'loc_to',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
