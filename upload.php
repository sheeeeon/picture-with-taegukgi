<?php
// 4.1.0 이전의 PHP에서는, $_FILES 대신에 $HTTP_POST_FILES를
// 사용해야 합니다.

$opacity = $_POST["opacity"];
$uploaddir = 'img/data/';

//　저장될 디렉토리 변경 시 실제 디렉토리가 있는지 확인한 후 변경하세요!
// 에러 메시지에서는 0을 반환, 즉 에러가 일어나지 않아도 실제 폴더에는 저장이 되지 않습니다.
$uploadfile = "1_" . time() . "_".basename($_FILES['userfile']['name']);

$return["uploadfile"] = $uploadfile;
//echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir.$uploadfile)) {
    $return['uploadfile'] = $uploadfile;
} else {
    print "error";
}

$save = "img/data/2_";
 

//기본값
$ImageOriginal = $uploadfile;
$original="img/stamp/taegukgi.jpg";
$im = imagecreatefromjpeg($uploaddir.$ImageOriginal);
$stamp = imagecreatefromjpeg($original);

$marge_right = 10;
$marge_bottom = 10;
$sx = imagesx($stamp); //image size
$sy = imagesy($stamp); //image size

$white=ImageColorAllocate($dst_img,255,255,255);
imagecolortransparent($stamp,$white);


//이미지 겹치기.
//imagecopy($im, $stamp, 0, 0, 0, 0, imagesx($stamp), imagesy($stamp));

imagecopymerge($im, $stamp,0,0,0,0,imagesx($stamp), imagesy($stamp),$opacity);


// Save the image as 'simpletext.jpg' in set directory.
imagejpeg($im, $save.$ImageOriginal);

// Free up memory (IMPORTANT!)
imagedestroy($im);
imagedestroy($im2);
imagedestroy($stamp);

imagedestroy($dst_img);

$return['savefile'] = $save.$ImageOriginal;


//echo json_encode($return);


echo $return['savefile'];
        
        


?>