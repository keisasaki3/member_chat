<?php
require_once 'utils.php';
require_once 'db.php';

$comment = $_POST['comment'];
if ($comment == '' || is_null($comment)) {
    header('Location: ./');
    exit();
}

session_start();
$username = $_SESSION['name'];
if (!isset($_SESSION['id'])) { // ログインしていなければログインフォームへ飛ばす
    header('Location: login_form.php');
}

//ユーザーデータの取得
$pdo = get_pdo();
$sql = "SELECT * FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $_SESSION['id']);
$stmt->execute();
$member = $stmt->fetch();

//チャットログに書き込む
$pdo = get_pdo();
$sql = "INSERT INTO chat_logs (name, comment) VALUES (:name, :comment)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $member['name']);
$stmt->bindValue(':comment', $comment);
$stmt->execute();

header('Location: ./');
?>