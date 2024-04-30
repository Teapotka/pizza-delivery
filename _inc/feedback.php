<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nickname = $_POST['nickname'];
    $body = $_POST['body'];
    $feedback_object = new Feedback();
    $feedback_object->createFeedback($nickname, $body);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
else {
    http_response_code(405);
    echo 'Method Not Allowed';
}
?>