<?php
require_once __DIR__ . '/../config/database.php';

class Role 
{
	private $conn;
	private $table_name = 'roles';

	public $id;
	public $role_name;
	public $description;

	public function __construct($db) {
		$this->conn = $db;
	}
}
