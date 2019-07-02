<html>
<head>
<meta charset="UTF-8">
<title>tasks</title>
</head>
<body>

<form action="tasks_add.php" method="post">
<div><input type="submit" value="タスク追加"></div>
</form>

<form action="tasks_edit.php" method="post">
<div>パラメーターを変更したいタスクのIDを入力してください。</div>
<div><input type="text" name="task_id"></div>
<div><input type="submit" value="検索"></div>
</form>

<form action="tasks_delete.php" method="post">
<div>削除したいタスクのIDを入力してください。</div>
<div><input type="text" name="task_id"></div>
<div><input type="submit" value="削除"></div>
</form>

<form action="tasks_search.php" method="post">
<div>タスクのステータスを選択してください。</div>
<div><input type="radio" name="task_status" value="0">未着手<input type="radio" name="task_status" value="1">処理中<input type="radio" name="task_status" value="2">完了</div>
<div><input type="submit" value="ソート"></div>
</form>

<table border='1'>
<tr><th>タスクID</th><th>タイトル</th><th>ステータス</th><th>参加メンバー</th></tr>

<?php
require './connect.php';
foreach ($pdo->query('select * from task') as $row_task) {
?>

<tr>
<th><?php echo $row_task['task_id'] ?></th>
<th><?php echo $row_task['task_name'] ?></th>
<th><?php
		if($row_task['task_status']==0){
			echo '未着手';}
		else if($row_task['task_status']==1){
			echo '処理中';}
		else {
			echo '完了';}?></th>
<th><?php
		$sql=$pdo->prepare('select * from participant where task_id=?');
		$sql->execute([$row_task['task_id']]);
		foreach ($sql as $row_participant) {
			$sql=$pdo->prepare('select * from member where id=?');
			$sql->execute([$row_participant['member_id']]);
			foreach ($sql as $row_member) {
				echo $row_member['name'],',';
			}
		}
	?>
</th></tr>
<?php
}
?>

</table>

</body>
</html>