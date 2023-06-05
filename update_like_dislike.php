<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION["username"])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$postId = isset($_POST['postId']) ? intval($_POST['postId']) : 0;
$userId = isset($_POST['userId']) ? intval($_POST['userId']) : 0;
$action = isset($_POST['action']) ? $_POST['action'] : '';
$remove = isset($_POST['remove']) ? intval($_POST['remove']) : 0;

if ($postId <= 0 || $userId <= 0 || !in_array($action, ['like', 'dislike'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Bad Request']);
    exit();
}

$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "forum";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Internal Server Error']);
    exit();
}

if ($remove) {
    if ($action === 'like') {
        $delete_sql = "DELETE FROM likes WHERE idp = '{$postId}' AND idu = '{$userId}'";
    } else {
        $delete_sql = "DELETE FROM dislikes WHERE idp = '{$postId}' AND idu = '{$userId}'";
    }
} else {
    if ($action === 'like') {
        $insert_sql = "INSERT INTO likes (idp, idu) VALUES ('{$postId}', '{$userId}')";
        $conn->query($insert_sql);
        $delete_sql = "DELETE FROM dislikes WHERE idp = '{$postId}' AND idu = '{$userId}'";
    } else {
        $insert_sql = "INSERT INTO dislikes (idp, idu) VALUES ('{$postId}', '{$userId}')";
        $conn->query($insert_sql);
        $delete_sql = "DELETE FROM likes WHERE idp = '{$postId}' AND idu = '{$userId}'";
    }
}

$conn->query($delete_sql);

$likes_sql = "SELECT COUNT(*) as likes_count FROM likes WHERE idp = '{$postId}'";
$dislikes_sql = "SELECT COUNT(*) as dislikes_count FROM dislikes WHERE idp = '{$postId}'";

$likes_result = $conn->query($likes_sql);
$dislikes_result = $conn->query($dislikes_sql);

$likes_data = $likes_result->fetch_assoc();
$dislikes_data = $dislikes_result->fetch_assoc();

$conn->close();

echo json_encode([
    'postId' => $postId,
    'likes' => $likes_data['likes_count'],
    'dislikes' => $dislikes_data['dislikes_count'],
]);
