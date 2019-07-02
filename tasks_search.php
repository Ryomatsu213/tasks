<html>
<head>
<meta charset="UTF-8">
<title>tasks</title>
</head>
<body>

<form action="tasks.php" method="post">
<div><input type="submit" value="一覧に戻る"></div>
</form>

<table border='1'>
<tr><th>タスクID</th><th>タイトル</th><th>ステータス</th><th>参加メンバー</th></tr>

<?php
require './connect.php';
$sql=$pdo->prepare('select * from task where task_status=?');
$sql->execute([$_REQUEST['task_status']]);
foreach ($sql as $row_task) {
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


