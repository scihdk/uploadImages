<?php

require_once ('config.php');


class UPIMAGES{

    var $THM_WIDTH;

    function __construct($width = 99){
	$this->THM_WIDTH = $width;
    }

    //セッター
    function setThmWidth($width = 99){
	$this->THM_WIDTH = $width;
    }



    function upload($images = null){
	foreach($images AS $key => $value){
	    $imagesize = getimagesize($images[$key]['tmp_name']);
	    $image = $this->saveImage($imagesize, $value);
	    
	    //サムネイルの作成
	    $thumbImage = $this->makeThumbnail($imagesize, $image['path']);
	    $this->saveThumbnail($imagesize, $thumbImage, $image['name']);

	}
    }





    function makeThumbnail($imagesize = null, $imageFilePath){
	$width = $imagesize[0];
	$height = $imagesize[1];

	if($width > $this->THM_WIDTH){
	    switch($imagesize['mime']){
		case 'image/gif' :
		    $srcImage = imagecreatefromgif($imageFilePath);
		    break;
		case 'image/jpeg' :
		    $srcImage = imagecreatefromjpeg($imageFilePath);
		    break;
		case 'image/png' :
		    $srcImage = imagecreatefrompng($imageFilePath);
		    break;
	    }

	    // 新しいサイズを作る
	    $thumbHeight = round($height * $this->THM_WIDTH / $width);
	    $thumbImage = imagecreatetruecolor($this->THM_WIDTH, $thumbHeight);
	    imagecopyresampled($thumbImage, $srcImage, 0, 0, 0, 0, 72, $thumbHeight, $width, $height);}
	    return $thumbImage;
    }



    function saveThumbnail($imagesize, $thumbImage, $imageFileName){
	switch($imagesize['mime']){
	    case 'image/gif' :
		imagegif($thumbImage, THM_DIR . '/' . $imageFileName);
		break;
	    case 'image/jpeg' :
		imagejpeg($thumbImage, THM_DIR . '/' . $imageFileName);
		break;
	    case 'image/png' :
		imagepng($thumbImage, THM_DIR . '/' . $imageFileName);
		break;
	}
    }




    function saveImage($imagesize, $value){
	//Imagesディレクトリへのアップロード
	switch($imagesize['mime']){
	    case 'image/gif' :
		$ext = '.gif';
		break;
	    case 'image/jpeg' :
		$ext = '.jpg';
		break;
	    case 'image/png' :
		$ext = '.png';
		break;
	    default :
		exit;
	}

	$imageFileName = sha1(time() . mt_rand()) . $ext;
	$imageFilePath = IMG_DIR . '/' . $imageFileName;

	$rs = move_uploaded_file($value['tmp_name'], $imageFilePath);

	if(!$rs){
	    echo 'could not upload!'; 
	    exit;
	}

	return array(
	    'name' => $imageFileName,
	    'path' => $imageFilePath
	    );
    }
}
?>
