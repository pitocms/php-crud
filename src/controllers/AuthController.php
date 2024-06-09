<?php
require_once __DIR__ . '/../models/User.php';

class AuthController 
{
	
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
	 * Handles user login.
	 * @return void
	 * @author Alimon
	 */
	public function login() 
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$email = $_POST['email'];
			$password = $_POST['password'];

			// Fetch the user by email
			$user = $this->user->getUserByEmail($email);

			// Verify the password
			if ($user && password_verify($password, $user['password'])) {
				// Set session variables
				$_SESSION['user_id'] = $user['id'];
				$_SESSION['username'] = $user['username'];
				$_SESSION['role_id'] = $user['role_id'];
				header("Location: index.php?action=list");
			} else {
				$error = "Invalid email or password";
				require_once __DIR__ . '/../views/auth/login.php';
			}
		} else {
			require_once __DIR__ . '/../views/auth/login.php';
		}
	}

	/**
	 * Handles user logout.
	 * @return void
	 * @author Alimon
	 */
	public function logout() 
	{
		session_unset();
		session_destroy();
		header("Location: index.php?action=login");
	}
}

?>
