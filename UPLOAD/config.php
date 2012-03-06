<?

define('IMG_DIR',dirname($_SERVER['SCRIPT_FILENAME']) . '/UPLOAD/images');
define('THM_DIR',dirname($_SERVER['SCRIPT_FILENAME']) . '/UPLOAD/thumbnails');

define('MAX_FILE_SIZE', 307200);
error_reporting(E_ALL & ~E_NOTICE);

?>
