<!--
//ページのTOPに貼付ける
<?php
require_once ('UPLOAD/config.php');

?>
-->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
</head>

<form action='upload.php' method='POST' enctype='multipart/form-data'>
    <input type='hidden' name='MAX_FILE_SIZE' value='<?php echo MAX_FILE_SIZE;?>'>
    <input type='file' name='images[]'><br>
    <input type='file' name='images[]'><br>
    <input type='file' name='images[]'><br>
    <input type='submit' value='アップロード'>
</form>
<hr>

</html>
