#Rename the file in php

$fileInfo = pathinfo('admin/assets/uploads/file_name');
$name = $fileInfo['filename'];
$extension = $fileInfo['extension'];

$oldName = $name . '.' . $extension;
$newName = "" .$extension;

rename("admin/assets/uploads/{$oldName}", "admin/assets/uploads/{$newName}");
