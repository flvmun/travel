<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */

$this->title = 'Поиск туров';
?>
<style>
    .search-module form *{
        margin-bottom: 5px;
    }
</style>
<div class="search-module">
    <?php 
        $form = ActiveForm::begin([
            'options' => [
                'class' => 'search--form',
                'style' => 'width:50%;margin:10px auto;'
            ]
        ]);
        echo '<p>Выберите город</p>';
        echo Html::activeDropDownList($cityM,'name',$cities,[
            'class'=>'form-control city--select',
            'name' => 'city'
        ]);
        echo '<div class="countries--list"></div>';
        echo '<p>Дата вылета</p>';
        echo DatePicker::widget([
            'name' => 'date',
            'value' => date('d m Y'),
            'options' => ['placeholder'=>'Выберите дату'],
            'pluginOptions' => [
                'format' => 'dd mm yyyy',
                'todayHighlight' => true
            ]
        ]);
        echo '<p>Количество ночей</p>';
        echo '<select name="nights" class="form-control">';
        foreach($nights as $n){
            echo '<option value="'.$n.'">'.$n.'</option>';
        }
        echo '</select>';
        echo Html::submitButton('Искать',['class'=>'btn btn-primary']);
        ActiveForm::end();
    ?>
    <div class="result"></div>
</div>
