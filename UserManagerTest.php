<?php

require_once 'UserManager.php';

class UserManagerTest extends \PHPUnit\Framework\TestCase
{
    private $userManager;

    protected function setUp(): void
    {
        $this->userManager = new UserManager();
    }

    public function testAddUser()
    {
        $expected = "User added successfully";
        $actual = $this->userManager->addUser(1, "Ivan");
        $this->assertEquals($expected, $actual);
    }


    public function testGetUserInfo()
    {
        $expected = ['user_id' => 1, 'name' => 'Ivan'];
        $actual = $this->userManager->getUserInfo(1);
        $this->assertEquals($expected, $actual);
    }

    public function testDeleteUser()
    {
        $expected = "User deleted successfully";
        $actual = $this->userManager->deleteUser(1);
        $this->assertEquals($expected, $actual);
    }
}
