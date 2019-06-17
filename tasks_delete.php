<html>
<head>
<meta charset="UTF-8">
<title>tasks_delete</title>
</head>
<body>

<form action="tasks.php" method="post">
<div><input type="submit" value="一覧に戻る"></div>
</form>

<?php
$pdo=new PDO('mysql:host=localhost;dbname=data;charset=utf8', 'user', 'password');

$sql=$pdo->prepare('select * from task where task_id=?');
$sql->execute([$_REQUEST['task_id']]);
foreach ($sql as $row_task){
}

if(empty($row_task)){
	exit('入力されたメンバーIDは存在しません。');
}

$sql=$pdo->prepare('delete from task where task_id=?');
$sql->execute([$_REQUEST['task_id']]);

$sql=$pdo->prepare('delete from participant where task_id=?');
$sql->execute([$_REQUEST['task_id']]);

echo '削除しました。';
?>

</body>
</html>