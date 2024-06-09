<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2>Create User</h2>
<form action="index.php?action=create" method="post">

	<div class="form-group">
		<label for="username">Username:</label>
		<input type="text" id="username" name="username" required>
	</div>

	<div class="form-group">
		<label for="email">Email:</label>
		<input type="email" id="email" name="email" required>
	</div>
	
	<div class="form-group">
		<label for="password">Password:</label>
		<input type="password" id="password" name="password" required>
	</div>

	<div class="form-group">
		<label for="role_id">Role:</label>
		<select id="role_id" name="role_id">
			<option value="1">Admin</option>
			<option value="2">User</option>
		</select>
	</div>

	<button class="btn btn-info" type="submit">Create</button>
</form>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
