<!DOCTYPE HTML>
<html>
	<head>
		<title>Poll</title>
	</head>
<body>

	<?php 
	session_start();

$host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="alex123";
$dbname="Polls";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

	require 'run_query.php';

//$con->close();
 ?>
 	<?php if (empty($_POST)): ?>
	<h1>Which do you like best?</h1>
	<form action="poll.php" method="POST">
		<!--<label for="choice_1">Choice 1: </label>-->
		<input type="radio" id="choice_1" name="choice_1" value="choice_1" />Choice 1<br>
		<!--<label for="choice_2">Choice 2: </label>-->
		<input type="radio" id="choice_2" name="choice_2" value="choice_2" />Choice 2<br>
		<!--<label for="choice_3">Choice 3: </label>-->
		<input type="radio" id="choice_3" name="choice_3" value="choice_3" />Choise 3<br>
		<input type="submit">
	</form>
<?php else: ?>
	<?php $result = run_query('SELECT choice FROM polls.polls WHERE choice=?', $_POST); ?>
	<?php echo $_SESSION['user_data']['choice']; ?>

<?php endif; ?>

	<?php
		$result = run_query('INSERT INTO Polls.polls SET choice=?', $_POST);
	require 'redirect_poll.php';
	?>

</body>
</html>