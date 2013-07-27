<h2>Viewing #<?php echo $grepcondition->id; ?></h2>
<br>
<table class="table table-striped">
    <tr>
        <td>
            <strong>Condition:</strong>
	    <?php echo $grepcondition->condition; ?>
        </td>
        <td>
            <strong>Kind:</strong>
            <?php echo $grepcondition->kind; ?>
        </td>
        <td>
            <strong>Comment:</strong>
            <?php echo $grepcondition->comment; ?>
        </td>
    </tr>
</table>
<br>
<table class="table table-striped">
	<thead>
		<tr>
			<th>ファイルパス</th>
			<th>行番号</th>
			<th>結果</th>
			<th>呼出し元リスト</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($grepresults as $key => $grepresult ): ?>
        	<tr>
                        <td><?php echo $grepresult->file_name; ?></td>
                        <td><?php echo $grepresult->line_number; ?></td>
                        <td><?php echo $results[$key]; ?></td>
                </tr>
        <?php endforeach; ?>
        </tbody>
</table>

<?php echo Html::anchor('grep/grepcondition/edit/'.$grep->id."/".$grepcondition->id, 'Edit'); ?> |
<?php echo Html::anchor('grep/grepcondition/index/'.$grep->id, 'Back'); ?>
