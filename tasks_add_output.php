<html>
<head>
<meta charset="UTF-8">
<title>tasks_add_output</title>
</head>
<body>

<?php
require './connect.php';
$sql=$pdo->prepare('insert into task values(null,?,?)');
$sql->execute([htmlspecialchars($_REQUEST['name']), $_REQUEST['status']]);

$sql=$pdo->prepare('select * from task where task_name=?');
$sql->execute([$_REQUEST['name']]);
foreach($sql as $row){
}

foreach($_REQUEST['participants'] as $id){
	$sql=$pdo->prepare('insert into participant values(?,?)');
	$sql->execute([$row['task_id'], $id]);
}

echo '入力情報をを追加しました。';
?>

<form action="tasks.php" method="post">
<div><input type="submit" value="一覧に戻る"></div>
</form>

<form action="tasks_add.php" method="post">
<div><input type="submit" value="入力画面に戻る"></div>
</form>

</body>
</html>