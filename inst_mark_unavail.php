<?php
if (!isset($_GET['index'])) {
	header("HTTP/1.1 400 Required parameter index is not present!");
}

$index = $_GET['index']; 
$status = isset($_GET['status']) ? $_GET['status'] : 1;

// $row = 1;
$data = [];

if (($handle = fopen("inst_avail.csv", "r")) !== FALSE) {

	while (($rowData = fgetcsv($handle, 1000, ",")) !== FALSE) {
		$data[$rowData[0]] = $rowData;
		// $row++;
	}

	$data[$index][2] = $status;

	echo json_encode($data);
}
else {
	header("HTTP/1.1 404 Configuration file not found!");
}

if (($handle = fopen("inst_avail.csv", "w")) !== FALSE) {

	foreach ($data as $k => $row) {
		fputcsv($handle, $row);
	}

	fclose($handle);
}
else {
	header("HTTP/1.1 404 Configuration file not found!");
}