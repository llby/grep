<h2>Listing Greps</h2>
<br>
<?php if ($greps): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>User id</th>
			<th>Path</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($greps as $grep): ?>
		<tr>
			<td><?php echo $grep->user_id; ?></td>
			<td><?php echo $grep->path; ?></td>
			<td>
				<?php echo Html::anchor('grep/view/'.$grep->id, 'View'); ?> |
				<?php echo Html::anchor('grep/edit/'.$grep->id, 'Edit'); ?> |
				<?php echo Html::anchor('grep/delete/'.$grep->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?> |
				<?php echo Html::anchor('grep/grepcondition/index/'.$grep->id, 'Condition　→'); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Greps.</p>

<?php endif; ?>
<p>
	<?php echo Html::anchor('grep/create', 'Add new Grep', array('class' => 'btn btn-success')); ?>
</p>
