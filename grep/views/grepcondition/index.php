
<h2>Listing Grepconditions</h2>
<br>
<?php if ($grepconditions): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Condition</th>
			<th>Kind</th>
			<th>Comment</th>
			<th>Command</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($grepconditions as $grepcondition): ?>
		<tr>
			<td><?php echo $grepcondition->condition; ?></td>
			<td><?php echo $grepcondition->kind; ?></td>
			<td><?php echo $grepcondition->comment; ?></td>
			<td><?php echo "grep -HIinr --exclude-dir=.svn --exclude-dir=.git ".$grepcondition->condition." ".$grep->path; ?></td>
			<td>
				<?php echo Html::anchor('grep/grepcondition/view/'.$grep->id."/".$grepcondition->id, 'View'); ?> |
				<?php echo Html::anchor('grep/grepcondition/edit/'.$grep->id."/".$grepcondition->id, 'Edit'); ?> |
				<?php echo Html::anchor('grep/grepcondition/delete/'.$grep->id."/".$grepcondition->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?> |
				<?php echo Html::anchor('grep/grepcondition/grep/'.$grep->id."/".$grepcondition->id, 'Grep'); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
<p>No Grepconditions.</p>

<?php endif; ?>
<p>
	<?php echo Html::anchor('grep/grepcondition/create/'.$grep->id, 'Add new Grepcondition', array('class' => 'btn btn-success')); ?>
</p>
<p>
	<?php echo Html::anchor('grep/grep/index', 'Back'); ?>
</p>
