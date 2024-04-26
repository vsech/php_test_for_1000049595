<?php
require_once 'UserGroupManager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userGroupManager = new UserGroupManager();

    $requestData = json_decode(file_get_contents('php://input'), true);

    switch ($_GET['action']) {
        case 'addUserToGroup':
            $response = $userGroupManager->addUserToGroup($requestData['userId'], $requestData['groupId']);
            break;
        case 'removeUserFromGroup':
            $response = $userGroupManager->removeUserFromGroup($requestData['userId'], $requestData['groupId']);
            break;
        default:
            $response = "Invalid action";
    }

    header('Content-Type: application/json');
    echo json_encode($response);

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $userGroupManager = new UserGroupManager();

    switch ($_GET['action']) {
        case 'getUserGroupsAndPermissions':
            $response = $userGroupManager->getUserGroupsAndPermissions($_GET['userId']);
            break;
        default:
            $response = "Invalid action";
    }

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    http_response_code(405);
    echo json_encode(array("error" => "Method Not Allowed"));
}

?>
