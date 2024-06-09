<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2>User List</h2>
<table class="table">
    <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['username']); ?></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
            <td><?php echo htmlspecialchars($user['role_id']); ?></td>
            <td>
                <a href="index.php?action=edit&id=<?php echo $user['id']; ?>">Edit</a>
                <a href="index.php?action=delete&id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
