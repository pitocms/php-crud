<?php
session_start();

require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/controllers/AuthController.php';

$userController = new UserController();
$authController = new AuthController();

if (isset($_GET['action'])) 
{
	$action = $_GET['action'];
	$id = isset($_GET['id']) ? $_GET['id'] : null;
} else {
	$action = 'list';
}

switch ($action) {
	case 'create':
		$userController->create();
		break
	;

	case 'edit':
		if ($id) {
			$userController->update($id);
		}
		break
	;

	case 'update':
		if ($id) $userController->update($id);
		break
	;

	case 'delete':
		if ($id) $userController->delete($id);
		break
	;

	case 'login':
		$authController->login();
		break
	;
	
	case 'logout':
		$authController->logout();
		break
	;

	case 'list':
	default:
		// Check if user is logged in before listing users
		if (isset($_SESSION['user_id'])) {
			if( $_SESSION['role_id'] != '1' ) {
				exit("Only admin able to access!");
			}
			
			$userController->index();
		} else {
			header("Location: index.php?action=login");
		}
		break
	;

}

?>
