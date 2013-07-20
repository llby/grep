<h2>Viewing #<?php echo $grep->id; ?></h2>

<p>
	<strong>User id:</strong>
	<?php echo $grep->user_id; ?></p>
<p>
	<strong>Path:</strong>
	<?php echo $grep->path; ?></p>

<?php echo Html::anchor('grep/edit/'.$grep->id, 'Edit'); ?> |
<?php echo Html::anchor('grep', 'Back'); ?>