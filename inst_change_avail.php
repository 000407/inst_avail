<?php
include 'init.php';
include 'db.php';

if (!isset($_GET['index'])) {
	header("HTTP/1.1 400 Required parameter index is not present!");
}

$index = $_GET['index']; 
$status = isset($_GET['status']) ? $_GET['status'] : 1;

try {
	$pdo = getDb();
	$data = [];

	$stmt = $pdo->prepare('UPDATE instructor_availability SET available=:available WHERE id=:id');
	$stmt->execute(["id" => $index, "available" => $status]);

	echo("Operation completed successfully!");
}
catch(Exception $e) {
	header("HTTP/1.1 500 Internal Error");
	echo "<pre>{$e->getMessage()}</pre>";
	if ($debug) {
		echo "<pre>{$e->getTraceAsString()}</pre>";
	}
}