<? use yii\helpers\Html; ?>

<h2><?=$title?></h2>
<table class="table">
	<tr>
		<th>Отель</th>
		<th>Цена</th>
	</tr>
	<?php 
		foreach($tours as $t){
			echo '
			<tr>
				<td>'.$t['hotel'].'</td>
				<td>'.$t['tourPrice'].' '.$t['currency'].'</td>
			</tr>';
		}
	?>
</table>