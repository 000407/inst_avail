<?php
include 'init.php';
include 'db.php';

$instructor_id = null;

if(isset($_GET['index'])) {
	$instructor_id = $_GET['index'];
}

try {
	$pdo = getDb();
	$data = [];

	$sql = 'SELECT * FROM instructor_availability i INNER JOIN app_user a ON a.id=i.id';

	$params = [];

	if ($instructor_id) {
		$sql .= " WHERE i.id=:id";
		$params["id"] = $instructor_id;
	}

	$stmt = $pdo->prepare($sql);
	$stmt->execute($params);

	while ($row = $stmt->fetch())
	{
		$data[] = [
			'index' => $row['id'],
			'name' => $row['name'],
			'available' => $row['available'] ? true : false,
			'meetingRoomUrl' => $row['meeting_room_url']
		];
	}

	echo json_encode($data);
}
catch(Exception $e) {
	header("HTTP/1.1 500 Internal Error");
	echo "<pre>{$e->getMessage()}</pre>";
	if ($debug) {
		echo "<pre>{$e->getTraceAsString()}</pre>";
	}
}