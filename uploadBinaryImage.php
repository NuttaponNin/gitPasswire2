<?php
    $base = $_REQUEST['image'];
    $name = $_REQUEST['name'];
    $binary = base64_decode($base);

    // $file = fopen('uploads/' . $name . '.png', 'wb');
    // header('Content-Type: bitmap; charset=utf-8');
    // fwrite($file, $binary);
    // fclose($file);

    $status = file_put_contents('uploads/' . $name . '.jpeg', $binary);
	if ($status == false) {
	    http_response_code(500);
	} else {
	    http_response_code(200);
	}
?>