<?php

use PHPUnit\Framework\TestCase;

class UserControllerTest extends TestCase
{
    protected $controller;
    protected $dbMock;
    protected $userMock;

    protected function setUp(): void
    {
        $this->dbMock = $this->createMock(Database::class);
        $this->userMock = $this->createMock(User::class);
        $this->controller = new UserController();
        $this->controller->db = $this->dbMock;
        $this->controller->user = $this->userMock;
    }

    public function testIndex()
    {
        $this->userMock->method('getAllUsers')->willReturn([
            ['id' => 1, 'username' => 'testuser', 'email' => 'test@example.com']
        ]);

        ob_start();
        $this->controller->index();
        $output = ob_get_clean();

        $this->assertStringContainsString('testuser', $output);
        $this->assertStringContainsString('test@example.com', $output);
    }

    public function testCreate()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['username'] = 'newuser';
        $_POST['email'] = 'new@example.com';
        $_POST['password'] = 'password';
        $_POST['role_id'] = 2;

        $this->userMock->method('createUser')->willReturn(true);

        ob_start();
        $this->controller->create();
        $output = ob_get_clean();

        $this->assertEmpty($output); // No output expected as it should redirect
    }
}
