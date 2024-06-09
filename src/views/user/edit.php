<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2>Edit User</h2>

<form action="index.php?action=update&id=<?php echo $user['id']; ?>" method="post">

	<div class="form-group">
		<label for="username">Username:</label>
		<input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
	</div>

	<div class="form-group">
		<label for="email">Email:</label>
		<input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
	</div>
	
	<div class="form-group">
		<label for="role_id">Role:</label>
		<select id="role_id" name="role_id">
			<option value="1" <?php if ($user['role_id'] == 1) echo 'selected'; ?>>Admin</option>
			<option value="2" <?php if ($user['role_id'] == 2) echo 'selected'; ?>>User</option>
		</select>
	</div>

    <button class="btn btn-info" type="submit">Update</button>
</form>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
