<?php
use yii\helpers\Html;

echo '<p>Выберите страну</p>';
echo Html::activeDropDownList($model,'loc_to',$countries,[
	'class'=>'form-control',
	'name'=>'country'
]);
?>