<?php

class wdwd_fileup {
  function upload(){
    $data = array();
    // Define directory
    $dir = dirname(__FILE__).'/';
    if (isset($this->base_dir)) $dir .= $this->base_dir;
    if (isset($this->dir)) $dir .= $this->dir;
    if (!file_exists($dir)) mkdir($dir); # If directory doesn't exist, create it.

    // Get file information
    $filename = $this->file['name'];
    $pathinfo = pathinfo($this->file['name']);
    $filename = $pathinfo['filename'];
    $fileext = '.'.$pathinfo['extension'];
    $filepath = $dir.$filename.$fileext;
    // If file already exists, create new name.
    $i = 1;
    while (file_exists($filepath)) {
      $filepath = $dir.$filename.'_'.$i.$fileext;
      $i++;
    }

    // Move the file then return it's path.
    if (move_uploaded_file($this->file['tmp_name'], $filepath)) {
      $data['file_path'] = str_replace(dirname(__FILE__).'/', '', $filepath);
      $data['result'] = true;
    }

    return $data;
  }
}

class fileup extends wdwd_fileup {
  function __construct(){
    $this->base_dir = 'files/';
  }
}

// Example
if (isset($_FILES['file_upload'])) {
$upload_file = new fileup();
$upload_file->file = $_FILES['file_upload'];
$upload_file->dir = 'files2/';
print_r($upload_file->upload());
}
?>
<form action="" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="file_upload">
    <input type="submit" value="Upload Image" name="submit">
</form>