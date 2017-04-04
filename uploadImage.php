<?php

$targetPath = 'uploads/' . basename( $_FILES['file']['name']);
if(@move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
    $success = 1;
    $uploadedFile = $targetPath;
    $filePath = __DIR__ . '/' . $targetPath;
	chmod($filePath, 0777);
	chown($filePath, 'Users');
}

?>