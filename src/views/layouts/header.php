<!DOCTYPE html>
<html>
<head>
	<title>User Management System</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>

<body>

	<div class="container">
		<header>
			<h1 class="text-center mt-4">User Management System</h1> <hr>

			<nav>
				<?php if ( ( isset($_GET['action']) && $_GET['action'] != "login") || isset($_GET['action']) == false ):  ?>
					<!-- Add navigation links -->
					<a class="btn btn-primary" href="<?php echo "index.php"; ?>">User List</a>
					<a class="btn btn-info" href="<?php echo "index.php?action=create"; ?>">Create User</a>
					<a class="btn btn-warning" href="<?php echo "index.php?action=logout"; ?>">Logout</a>
				<?php endif; ?>
			</nav>


			<hr>

			<?php
				if (isset($_SESSION['success_message'])) {
					echo "<div class='alert alert-success'>" . $_SESSION['success_message'] . "</div>";
					unset($_SESSION['success_message']); // Clear the message after displaying it
				}
			?>

		</header>

		<main>
	
	
