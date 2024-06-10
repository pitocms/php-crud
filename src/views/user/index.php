<?php include __DIR__ . '/../layouts/header.php'; ?>

<h2>User List</h2>
<table class="table">
    <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>
    <?php 
        $role = [
            '1' => 'Admin',
            '2' => 'Noral'
        ];
    ?>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['username']); ?></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
            <td>
                <?php 
                    echo htmlspecialchars(
                        $role[$user['role_id']]
                    )
                ?>
            </td>
            <td>
                <a href="index.php?action=edit&id=<?php echo $user['id']; ?>">Edit</a>
                <a href="index.php?action=delete&id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<!-- Pagination controls -->
<nav aria-label="Page navigation example">
    <?php if ($page > 1): ?>
        <a href="index.php?action=list&page=<?php echo $page - 1; ?>">Previous</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="index.php?action=list&page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="active"'; ?>>
            <?php echo $i; ?>
        </a>
    <?php endfor; ?>

    <?php if ($page < $totalPages): ?>
        <a href="index.php?action=list&page=<?php echo $page + 1; ?>">Next</a>
    <?php endif; ?>
</nav>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
