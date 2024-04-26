<?php

require_once 'UserManager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userManager = new UserManager();

    $requestData = json_decode(file_get_contents('php://input'), true);

    switch ($_GET['action']) {
        case 'addUser':
            $response = $userManager->addUser($requestData['userId'], $requestData['name']);
            break;
        case 'deleteUser':
            $response = $userManager->deleteUser($requestData['userId']);
            break;
        default:
            $response = "Invalid action";
    }

    header('Content-Type: application/json');
    echo json_encode($response);

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $userManager = new UserManager();

    switch ($_GET['action']) {
        case 'getUserInfo':
            $response = $userManager->getUserInfo($_GET['userId']);
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
