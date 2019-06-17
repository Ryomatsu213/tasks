<html>
<head>
<meta charset="UTF-8">
<title>tasks_edit</title>
</head>
<body>

<form action="tasks.php" method="post">
<div><input type="submit" value="一覧に戻る"></div>
</form>

<table border='1'>
<tr><th>タスクID</th><th>タイトル</th><th>ステータス</th><th>参加メンバー</th></tr>

<?php
$pdo=new PDO('mysql:host=localhost;dbname=data;charset=utf8', 'user', 'password');

$sql=$pdo->prepare('select * from task where task_id=?');
$sql->execute([$_REQUEST['task_id']]);
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

if(empty($row_task)){
	exit('入力されたメンバーIDは存在しません。');
}
?>
</table>

<form action="tasks_edit_output.php" method="post">
<input type="hidden" name="task_id" value="<?=$_REQUEST['task_id']?>">
<div>タイトル<input type="text" name="name"></div>
<div>ステータス<input type="radio" name="status" value="0">未着手
<input type="radio" name="status" value="1">処理中
<input type="radio" name="status" value="2">完了</div>

<div>参加メンバー<br>
<?php
$pdo=new PDO('mysql:host=localhost;dbname=data;charset=utf8', 'root', 'test_mysql');
$sql=$pdo->prepare('select * from member');
$sql->execute();
foreach ($sql as $row) {
?>
<input type="checkbox" name="participants[]" value="<?php echo $row['id'];?>"><?php echo $row['name'];?>
<?php
}
?>
</div>

<div><input type="submit" value="変更"></div>
</form>

</body>
</html>