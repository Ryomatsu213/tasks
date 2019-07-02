<html>
<head>
<meta charset="UTF-8">
<title>tasks_add</title>
</head>
<body>

<form action="tasks.php" method="post">
<div><input type="submit" value="戻る"></div>
</form>

<form action="tasks_add_output.php" method="post">
<div>タイトル<input type="text" name="name"></div>
<div>ステータス<input type="radio" name="status" value="0">未着手
<input type="radio" name="status" value="1">処理中
<input type="radio" name="status" value="2">完了</div>

<div>参加メンバー<br>
<?php
require './connect.php';
$sql=$pdo->prepare('select * from member');
$sql->execute();
foreach ($sql as $row) {
?>
<input type="checkbox" name="participants[]" value="<?php echo $row['id'];?>"><?php echo $row['name'];?>
<?php
}
?>
</div>

<div><input type="submit" value="追加"></div>
</form>

</body>
</html>