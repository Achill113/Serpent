<?php
function run_query() {
	// Get args and extract SQL
	$args = func_get_args();
	if (empty($args)) return 0;
	$sql = array_shift($args);

	// Connection details
	$host = '127.0.0.1';
	$port = 3306;
	$socket = '';
	$user = 'root';
	$password = 'alex123';
	$dbname = 'Ellegant_8';

	// Make connection
	$con = new mysqli($host, $user, $password, $dbname, $port, $socket) or
		die('Could not connect to the database server: ' . mysqli_connect_error());

	// Prepare statement
	$stmt = $con->prepare($sql) or die('A statement error occurred: ' . $con->error);

	// Check for parameters
	if (count($args)) {
		$refs = array('');
		foreach ($args as &$arg) {
			if (is_string($arg)) $refs[0] .= 's';
			elseif (is_int($arg)) $refs[0] .= 'i';
			elseif (is_double($arg)) $refs[0] .= 'd';
			else $refs[0] .= 'b';

			$refs[] = &$arg;
		}
		call_user_func_array(array($stmt, 'bind_param'), $refs) || die('Param binding failed');
	}

	// Execute statement and check for result rows
	$stmt->execute() or die('Failed to execute statement');
	$result = $stmt->get_result() or die('Failed to get result.');

	// Get result and return array or false
	if ($result->num_rows) return $result->fetch_assoc();
	elseif ($con->affected_rows) return true;
	else return false;
}