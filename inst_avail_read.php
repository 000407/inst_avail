<?php
$row = 1;
if (($handle = fopen("inst_avail.csv", "r")) !== FALSE) {
	$data = [];

	while (($rowData = fgetcsv($handle, 1000, ",")) !== FALSE) {
		$data[] = [
			'index' => $rowData[0],
			'name' => $rowData[1],
			'available' => $rowData[2] ? true : false,
			'meetingRoomUrl' => $rowData[3]
		];
		$row++;
	}
	fclose($handle);

	echo json_encode($data);
}
else {
	header("HTTP/1.1 404 Configuration file not found!");
}