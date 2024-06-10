<?php
require_once __DIR__ .'/../config/database.php';

class User 
{
	private $conn;
	private $table_name = "users";

	public function __construct($db) {
		$this->conn = $db;
	}

	public function validateUser($username, $email, $password)
	{
		$errors = [];

		if (empty($username)) {
			$errors[] = "Username is required.";
		}
		if (empty($email)) {
			$errors[] = "Email is required.";
		} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors[] = "Invalid email format.";
		}
		if (empty($password)) {
			$errors[] = "Password is required.";
		}

		return $errors;
	}

	/**
	 * Retrieves all users from the database.
	 * @return array An array of associative arrays.
	 * @author Alimon
 	*/
	public function getAllUsers($limit, $offset)
	{
		$query = "SELECT * FROM users LIMIT :limit OFFSET :offset";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
		$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


	public function getTotalUsers()
    {
        $query = "SELECT COUNT(*) as total FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

	
	/**
	 * Retrieves a user from the database by their ID.
	 * @param int $id The ID of the user to retrieve.
	 * @return array|null
	 * @author Alimon
	 */
	public function getUserById($id) {
		$query = "SELECT id, username, email, password, role_id FROM " . $this->table_name . " WHERE id = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	// Create a new user
	public function createUser($username, $email, $password, $role_id) {
		$query = "INSERT INTO " . $this->table_name . " (username, email, password, role_id) VALUES (:username, :email, :password, :role_id)";
		$stmt = $this->conn->prepare($query);

		// Bind parameters
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':password', $password);
		$stmt->bindParam(':role_id', $role_id);

		return $stmt->execute();
	}

	// Update a user
	public function updateUser($id, $username, $email, $role_id) {
		$query = "UPDATE " . $this->table_name . " SET username = :username, email = :email, role_id = :role_id WHERE id = :id";
		$stmt = $this->conn->prepare($query);

		// Bind parameters
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':role_id', $role_id);

		return $stmt->execute();
	}

	// Delete a user
	public function deleteUser($id) {
		$query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $id);
		return $stmt->execute();
	}

	public function getUserByEmail($email) {
		$query = "SELECT id, username, email, password, role_id FROM " . $this->table_name . " WHERE email = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $email);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
}
