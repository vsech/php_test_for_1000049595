<?php
require_once 'UserGroupManager.php';

class UserGroupManagerTest extends \PHPUnit\Framework\TestCase
{
    private $userGroupManager;

    protected function setUp(): void
    {
        $this->userGroupManager = new UserGroupManager();
    }

    public function testAddUserToGroup()
    {
        $expected = "User added to group successfully";
        $actual = $this->userGroupManager->addUserToGroup(1, 1);
        $this->assertEquals($expected, $actual);
    }

    public function testRemoveUserFromGroup()
    {
        $expected = "User removed from group successfully";
        $actual = $this->userGroupManager->removeUserFromGroup(1, 1);
        $this->assertEquals($expected, $actual);
    }

    public function testGetUserGroupsAndPermissions()
    {
        $expected = [
            'Group1' => ['send_messages', 'service_api'],
            'Group2' => ['send_messages', 'debug']
        ];
        $actual = $this->userGroupManager->getUserGroupsAndPermissions(1);
        $this->assertEquals($expected, $actual);
    }
}

?>
