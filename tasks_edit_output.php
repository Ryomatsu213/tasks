<html>
<head>
<meta charset="UTF-8">
<title>members_edit_output</title>
</head>
<body>

<?php
$pdo=new PDO('mysql:host=localhost;dbname=data;charset=utf8', 'user', 'password');
$sql=$pdo->prepare('update task set task_name=?, task_status=? where task_id=?');
$sql->execute([htmlspecialchars($_REQUEST['name']), $_REQUEST['status'], $_REQUEST['task_id']]);

$sql=$pdo->prepare('delete from participant where task_id=?');
$sql->execute([$_REQUEST['task_id']]);

foreach($_REQUEST['participants'] as $member_id){
	$sql=$pdo->prepare('insert into participant values(?,?)');
	$sql->execute([$_REQUEST['task_id'], $member_id]);
}

echo '入力情報を更新しました。';
?>

<form action="tasks.php" method="post">
<div><input type="submit" value="一覧に戻る"></div>
</form>

</body>
</html>