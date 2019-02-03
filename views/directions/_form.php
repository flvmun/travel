<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Directions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="directions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'loc_from')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'loc_to')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
