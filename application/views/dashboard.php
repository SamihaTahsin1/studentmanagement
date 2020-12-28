<?php include 'inc/header.php'; ?>

	<div class="container">
		<h3>Welcome to Dashboard
			<div class="float-right">
				<?php echo anchor("welcome/logout", 'Logout', ['class'=>'btn btn-primary btn-sm']); ?>
			</div>
		</h3>
		<?php $username = $this->session->userdata('username'); ?>
		<h5>Welcome <?php echo "<b>".$username."</b>"; ?></h5>
		<div class="row">
			<?php echo anchor("admin/addschool", 'Add school', ['class'=>'btn btn-primary btn-sm mx-1']); ?>
			<?php echo anchor("admin/addmoderator", 'Add Moderator', ['class'=>'btn btn-primary btn-sm mx-1']); ?>
			<?php echo anchor("admin/addstudent", 'Add Student', ['class'=>'btn btn-primary btn-sm mx-1']); ?>
		</div>
		<hr>
		<div class="row">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>school Name</th>
						<th>Username</th>
						<th>Email</th>
						<th>Role</th>
						<th>Gender</th>
						<th>Branch</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if (count($schoolUsers)): ?>
						<?php foreach ($schoolUsers as $schoolUser): ?>
							<tr>
								<td><?php echo $schoolUser->school_id; ?></td>
								<td><?php echo $schoolUser->schoolname; ?></td>
								<td><?php echo $schoolUser->username; ?></td>
								<td><?php echo $schoolUser->email; ?></td>
								<td><?php echo $schoolUser->rolename; ?></td>
								<td><?php echo $schoolUser->gender; ?></td>
								<td><?php echo $schoolUser->branch; ?></td>
								<td><?php echo anchor("admin/viewstudents/{$schoolUser->school_id}", 'View', ['class'=>'btn btn-primary btn-sm mx-1']); ?></td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td>
								No Records Found!
							</td>
						</tr>
					<?php endif;?>
				</tbody>
			</table>
		</div>
	</div>

<?php include 'inc/footer.php'; ?>
