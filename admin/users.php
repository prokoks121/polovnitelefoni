
<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>


<?php 
	// Get all admin users from DB
	$admins = getAdminUsers();
$users = getAllUsers();
	$roles = ['Admin', 'Author'];				
?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
	<title>Admin | Manage users</title>
</head>
<body>
	<!-- admin navbar -->
	<?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>
	<div class="container content">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/admin/includes/menu.php') ?>
	
		<!-- Display records from DB-->
		<div class="table-div">
			<!-- Display notification message -->
			<?php include(ROOT_PATH . '/includes/messages.php') ?>

			<?php if (empty($admins)): ?>
				<h1>Nema Administratora</h1>
			<?php else: ?>
				<table class="table">
					<thead>
						<th>N</th>
							<th>ID</th>
						<th>User name</th>
						<th>email</th>
<th>Azurirano</th>
						<th>Objavljeno</th>
						<th>Role</th>
						<th>IP adresa</th>

						<th colspan="2">Action</th>
					</thead>
					<tbody>
					<?php foreach ($admins as $key => $admin): ?>


							<?php
global $conn;
$now = strtotime("now");
$your_date = strtotime($admin['updated_at']);
$datediff = $now - $your_date;
$razlika = round($datediff / (60 * 60 * 24));

$your_date1 = strtotime($admin['created_at']);
$datediff1 = $now - $your_date1;
$razlika1 = round($datediff1 / (60 * 60 * 24));
 ?>
						<tr>
							<td><?php echo $key + 1; ?></td>
							<td>
								<?php echo $admin['id']; ?>
								</td>
							<td>
								<?php echo $admin['username']; ?>
								</td>
								<td>
								<?php echo $admin['email']; ?>	
							</td>
							<td><?php echo $admin['created_at']; ?> / <?php echo $razlika1; ?> Dan</td>
														<td><?php echo $admin['updated_at']; ?> / <?php echo $razlika; ?> Dan</td>
							<td>
<select class="admin_check" id="<?php echo $admin['id'] ?>">
	<?php foreach ($roles as $key => $role): ?>
													<option value="" disabled="disabled" selected>Izabei / <?php echo $admin['role']; ?></option>

						<option value="<?php echo $role; ?>"><?php echo $role; ?></option>
					<?php endforeach ?>
											<option value="none">none</option>

</select>


							</td>
							<td>
								<?php echo $admin['ip_addres']; ?>	
							</td>
							<td>
								<a class="fa fa-pencil btn edit"
									href="users.php?edit-admin=<?php echo $admin['id'] ?>">
								</a>
							</td>
							<td>
								<a class="fa fa-trash btn delete" 
								    href="users.php?delete-admin=<?php echo $admin['id'] ?>">
								</a>
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			<?php endif ?>
			<table class="table">
					<thead>
						<th>N</th>
							<th>ID</th>
						<th>User name</th>
						<th>email</th>
<th>Azurirano</th>
						<th>Objavljeno</th>
						<th>Role</th>
						<th>IP adresa</th>

						<th colspan="2">Action</th>
					</thead>
					<tbody>
					<?php foreach ($users as $key => $admin): ?>


							<?php
global $conn;
$now = strtotime("now");
$your_date = strtotime($admin['updated_at']);
$datediff = $now - $your_date;
$razlika = round($datediff / (60 * 60 * 24));

$your_date1 = strtotime($admin['created_at']);
$datediff1 = $now - $your_date1;
$razlika1 = round($datediff1 / (60 * 60 * 24));
 ?>
						<tr>
							<td><?php echo $key + 1; ?></td>
							<td>
								<?php echo $admin['id']; ?>
								</td>
							<td>
								<?php echo $admin['username']; ?>
								</td>
								<td>
								<?php echo $admin['email']; ?>	
							</td>
							<td><?php echo $admin['created_at']; ?> / <?php echo $razlika1; ?> Dan</td>
														<td><?php echo $admin['updated_at']; ?> / <?php echo $razlika; ?> Dan</td>
							<td>
<select class="admin_check" id="<?php echo $admin['id'] ?>">
	<?php foreach ($roles as $key => $role): ?>
													<option value="" disabled="disabled" selected>Izabei / <?php echo $admin['role']; ?></option>

						<option value="<?php echo $role; ?>"><?php echo $role; ?></option>
					<?php endforeach ?>
											<option value="none">none</option>

</select>


							</td>
							<td>
								<?php echo $admin['ip_addres']; ?>	
							</td>
							<td>
								<a class="fa fa-pencil btn edit"
									href="users.php?edit-admin=<?php echo $admin['id'] ?>">
								</a>
							</td>
							<td>
								<a class="fa fa-trash btn delete" 
								    href="users.php?delete-admin=<?php echo $admin['id'] ?>">
								</a>
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
		</div>
		<!-- // Display records from DB -->
	</div>
<script type="text/javascript">
		 $('.admin_check').on('change',function(){
var value = $(this).find('option:selected').val();
		var id = $(this).attr('id');
		var link ="users.php?edit-role="+id+"&role="+value;
		window.location.replace(link);
		 });
		

</script>
</body>
</html>
