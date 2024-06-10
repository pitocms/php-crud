<?php

require_once __DIR__ . '/../models/User.php';

class UserController {
	
	private $db;
	private $user;

	public function __construct() 
	{
		// Initialize the database connection
		$database = new Database();
		$this->db = $database->getConnection();
		// Initialize the User model
		$this->user = new User($this->db);
	}

	/**
	 * Displays the list of all users.
	 * @return void
	 * @author Alimon
	 */
	public function index() 
	{
		$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10; // Number of records per page
        $offset = ($page - 1) * $limit;

        $users = $this->user->getAllUsers($limit, $offset);
        $totalUsers = $this->user->getTotalUsers();
        $totalPages = ceil($totalUsers / $limit);

		require_once __DIR__ . '/../views/user/index.php';
	}

	
	/**
	 * Handles the creation of a new user.
	 * @return void
	 * @author Alimon
	 */
	public function create() 
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$username = $_POST['username'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$role_id = $_POST['role_id'];

			// Validate input using model method
			$errors = $this->user->validateUser($username, $email, $password);

			if (!empty($errors)) {
				foreach ($errors as $error) {
					echo $error . "<br>";
				}
			} else {
				try {
					$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

					if ($this->user->createUser($username, $email, $hashedPassword, $role_id)) {
						$_SESSION['success_message'] = "Updated successfully!";
						header("Location: index.php?action=list");
					} else {
						echo "Error creating user.";
					}
				} catch (Exception $e) {
					// Log the exception if necessary
					error_log($e->getMessage());
					echo "An error occurred while creating the user. Please try again later.";
				}
			}
		} else {
			require_once __DIR__ . '/../views/user/create.php';
		}
	}


	/**
	 * Handles the update of an existing user.
	 * @param int $id
	 * @return void
	 * @author Alimon
	 */
	public function update($id) {

		$user = $this->user->getUserById($id);

		if ($_SERVER['REQUEST_METHOD'] === 'POST') 
		{
			// Validate input
			$username = $_POST['username'];
			$email = $_POST['email'];
			$role_id = $_POST['role_id'];

			if ($this->user->updateUser($id, $username, $email, $role_id)) {
				$_SESSION['success_message'] = "User created successfully!";
				header("Location: index.php?action=list");
			} else {
				echo "Error updating user.";
			}

		} else {
			require_once __DIR__ . '/../views/user/edit.php';
		}
	}

	/**
	 * Handles the deletion of a user.
	 * @param int $id The ID of the user to be deleted.
	 * @return void
	 * @author Alimon
	 */
	public function delete($id) 
	{
		try {
			if ($this->user->deleteUser($id)) {
				header("Location: index.php?action=list");
				exit();
			} else {
				echo "Error deleting user.";
			}
		} catch (Exception $e) {
			// Log the exception if necessary
			error_log($e->getMessage());
			echo "An error occurred while deleting the user. Please try again later.";
		}
	}

}
