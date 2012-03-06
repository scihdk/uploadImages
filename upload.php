<?php

require_once ('UPLOAD/UPLOAD.php');

$upload = new UPIMAGES();

$images = array();
$errors = array();


if(is_array($_FILES['images']['name'])){
    for($i = 0; $i < COUNT($_FILES['images']['name']); $i++){
	
	//ファイルのアップが失敗していればcontinue
	if($_FILES['images']['error'][$i] != UPLOAD_ERR_OK) continue;
	
	//画像ファイル以外ならcontinue
	if(strpos($_FILES['images']['type'][$i], 'image') != 0) continue;

	$image = array();
	$error = array();
	
	foreach($_FILES['images'] AS $key => $value){
	    //errorであればスキップ
	    $image[$key] = $value[$i];
	}
	
	$images[] = $image;
    }
}else{
    $images = array($_FILES['images']);
}


$upload->upload($images);

?>
