<?php
require_once 'utils.php';
require_once 'db.php';

session_start();
$username = $_SESSION['name'];
if (!isset($_SESSION['id'])) { // ログインしていなければログインフォームへ飛ばす
    header('Location: login_form.php');
    exit();
}

//ユーザーデータの取得
$pdo = get_pdo();
$sql = "SELECT * FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $_SESSION['id']);
$stmt->execute();
$member = $stmt->fetch();

//チャットログの取得
$pdo = get_pdo();
$sql = "SELECT * FROM chat_logs order by datetime desc limit 10";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$chat_logs = $stmt->fetchAll();
?>
<h2>会員制チャット</h2>
<form action="chat_send.php" method="post">
<input type="text" name="comment" size="50">
&nbsp;
<input type="submit" value="発言">
</form>
<br>
<?php foreach ($chat_logs as $key => $val) : ?>
<?php echo h($val['name']) ?>：<?php echo h($val['comment']) ?> <?php echo h($val['datetime']) ?><hr size="1">
<?php endforeach; ?>
<br>
<p><a href="logout.php">ログアウト</a></p>