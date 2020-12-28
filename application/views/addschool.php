<?php include 'inc/header.php'; ?>

	<div class="container">
		<?php echo form_open("admin/createschool", ['class'=>'form-horizontal']); ?>

		<?php if ($message = $this->session->flashdata('message')): ?>
			<div class="row">
				<div class="col-md-6">
					<div class="alert alert-success alert-dismissble">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<?php echo $message; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<h3>Add school</h3>
		<hr>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="schoolname" class="col-md-3 control-label">school Name</label>
					<div class="col-md-9">
						<?php echo form_input([ 'name'=>'schoolname',
																		'class'=>'form-control',
																		'value'=>set_value('schoolname'),
																		'placeholder'=>'school Name'
																	]); ?>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<?php echo form_error('schoolname', '<div class="text-danger">', '</div>'); ?>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="branch" class="col-md-3 control-label">Branch</label>
					<div class="col-md-9">
						<?php echo form_input([ 'name'=>'branch',
																		'class'=>'form-control',
																		'placeholder'=>'Branch'
																	]); ?>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<?php echo form_error('branch', '<div class="text-danger">', '</div>'); ?>
			</div>
		</div>

		<button type="submit" class="btn btn-primary">Add school</button>
		<?php echo anchor("admin/dashboard", "Back", ['class'=>'btn btn-primary']); ?>

		<?php echo form_close(); ?>
	</div>

<?php include 'inc/footer.php'; ?>
