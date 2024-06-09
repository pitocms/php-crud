<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2>Login</h2>
<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<form action="index.php?action=login" method="post">
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button class="btn btn-primary" type="submit">Login</button>
</form>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
