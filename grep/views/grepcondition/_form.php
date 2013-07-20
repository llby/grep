<?php echo Form::open(); ?>
	<fieldset>
		<div class="clearfix">
			<?php echo Form::label('Condition', 'condition'); ?>

			<div class="input">
				<?php echo Form::input('condition', Input::post('condition', isset($grepcondition) ? $grepcondition->condition : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Kind', 'kind'); ?>

			<div class="input">
				<?php echo Form::input('kind', Input::post('kind', isset($grepcondition) ? $grepcondition->kind : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Comment', 'comment'); ?>

			<div class="input">
				<?php echo Form::input('comment', Input::post('comment', isset($grepcondition) ? $grepcondition->comment : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="actions">
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>
		</div>
	</fieldset>
<?php echo Form::close(); ?>