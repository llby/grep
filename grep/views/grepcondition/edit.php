<h2>Editing Grepcondition</h2>
<br>

<?php echo render('grepcondition/_form'); ?>
<p>
	<?php echo Html::anchor('grep/grepcondition/view/'.$grep->id."/".$grepcondition->id, 'View'); ?> |
	<?php echo Html::anchor('grep/grepcondition/index/'.$grep->id, 'Back'); ?>
</p>
