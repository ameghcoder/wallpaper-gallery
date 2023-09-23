<?php
ini_set('memory_limit', '1024M');
$aj = file_get_contents("./d.json");
$ajd = json_decode($aj);
$ajdArr = $ajd->domain;
$request_headers = getallheaders();
if (isset($_SERVER['HTTP_HOST']) && in_array($_SERVER['HTTP_HOST'], $ajdArr) && in_array($request_headers['Host'], $ajdArr) && in_array($_SERVER['SERVER_NAME'], $ajdArr)) {
    auth($_SERVER['SERVER_NAME']);
} else {
    msgSender("your are not in the list", "e");
}
// used for authenticate a domain and token id
function auth($domain)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $td = file_get_contents('./t-d-m.json');
        $tdd = json_decode($td);
        $tddArr = $tdd->td;
        $tokenNum =  $tddArr->$domain;
        if($_POST['token'] == $tokenNum && !empty($_FILES['file'])){
            app();
        } else{
            msgSender("Please provide correct information.", "e");
        }
    } else {
        // print_r($_SERVER['SERVER_NAME']);
        msgSender("You have not permission to access this.", "e");
    }
}

// used for checking image tool request
function app(){
    $file = $_FILES['file'];
    if(isset($_POST['tool'])){
        if($_POST['tool'] == "con"){
            converter($file);
        } else if($_POST['tool'] == "com"){
            compressor($file);
        } else if($_POST['tool'] == 'res'){
            preResizer($file);
        } else{
            msgSender("Parameter is wrong, try right one.", "e");
        }
    }
}

// used for collecting image information for resizing
function preResizer($file){
    $cWid = $_POST['imgWid'];
    $cHei = $_POST['imgHei'];
    $compression = $_POST['compress'];
    // File Details
    $fileTmpName = $file['tmp_name'];
    $fileError = $file['error'];
    $size = $file['size'];
    $fileType = $file['type'];

    // image extension
    $imgExt = (explode('/', $fileType))[1];
    if($imgExt == 'jpg' || $imgExt == 'jfif' || $imgExt == 'jif'){
        $imgExt = 'jpeg';
    }

    $sizeImg = is($size, 'fs');

    if($fileError == 0){
        resizer($fileTmpName, $imgExt, $cWid, $cHei, $sizeImg, $compression);
    } else{
        msgSender("Your image is invalid, Please try another image or retry.", "e");
    }
}
function compressor($file){
    $fileTmpName = $file['tmp_name'];
    $fileError = $file['error'];
    $size = $file['size'];
    $fileType = $file['type'];
    $compression = $_POST['compress'];
    // image extension
    $imgExt = (explode('/', $fileType))[1];
    if($imgExt == 'jpg' || $imgExt == 'jfif' || $imgExt == 'jif'){
        $imgExt = 'jpeg';
    }
    
    $size = is($size, 'fs');
    if($fileError == 0){
        $sourceImage = sourceImg($fileTmpName, $imgExt);    
        // Image New Name
        if(folderCheck('../../ImageBin/')){
            $imgNewName = '../../ImageBin/' . md5(uniqid('ico')) . '.' . $imgExt;
        } else{ 
            if(mkdir('../ImageBin/')){
                $imgNewName = '../../ImageBin/' . md5(uniqid('ico')) . '.' . $imgExt;
            } else{
                msgSender("Something went wrong, Try again", "e");
            }
        }
        if(!$sourceImage){
            msgSender("Enter a valid Image or this type of image not supported yet.", "e");
        } else{
            // Finally Resizing Image
            finalImg($sourceImage, $imgNewName, $compression, $size, $imgExt, "Compressed");
        }        
    } else{
        msgSender("Your image is invalid, Please try another image or retry.", "e");
    }
}
function converter($file){
    $fileTmpName = $file['tmp_name'];
    $fileError = $file['error'];
    $size = $file['size'];
    $fileType = $file['type'];
    $compression = $_POST['compress'];
    $convertto = $_POST['convertto'];
    // image extension
    $imgExt = (explode('/', $fileType))[1];
    if($imgExt == 'jpg' || $imgExt == 'jfif' || $imgExt == 'jif'){
        $imgExt = 'jpeg';
    }
    
    $size = is($size, 'fs');
    
    if($fileError == 0){
        $sourceImage = sourceImg($fileTmpName, $imgExt);
        // Image New Name
        if(folderCheck('../../ImageBin/')){
            $imgNewName = '../../ImageBin/' . md5(uniqid('ico')) . '.' . $convertto;
        } else{ 
            if(mkdir('../../ImageBin/')){
                $imgNewName = '../../ImageBin/' . md5(uniqid('ico')) . '.' . $convertto;
            } else{
                msgSender("Something went wrong, Try again", "e");
            }
        }
        if(!$sourceImage){
            msgSender("Enter a valid Image or this type of image not supported yet.", "e");
        } else{
            // Finally Resizing Image
            finalImg($sourceImage, $imgNewName, $compression, $size, $convertto, "Converted");
        }        
    } else{
        msgSender("Your image is invalid, Please try another image or retry.", "e");
    }
}

// used for resize a image
function resizer($name, $ext, $wid, $hei, $size, $compression){
    list($oWid, $oHei) = getimagesize($name);
    // Create a blank Image
    $sourceImage = sourceImg($name, $ext);    
    // Image New Name
    if(folderCheck('../../ImageBin/')){
        $imgNewName = '../../ImageBin/' . md5(uniqid('ico')) . '.' . $ext;
    } else{ 
        if(mkdir('../../ImageBin/')){
            $imgNewName = '../../ImageBin/' . md5(uniqid('ico')) . '.' . $ext;
        } else{
            msgSender("Something went wrong, Try again", "e");
        }
    }
    if(!$sourceImage){
        msgSender("Enter a valid Image or this type of image not supported yet.", "e");
    }
    $BlankImage = imagecreatetruecolor($wid, $hei);
    // copy blank image
    if(imagecopyresized($BlankImage, $sourceImage, 0, 0, 0, 0, $wid, $hei, $oWid, $oHei)){
        imagedestroy($sourceImage);
    } else{
        msgSender("An error occurred. error code is 103. Send error code to Developer.", "e");
    }
    // Finally Resizing Image
    finalImg($BlankImage, $imgNewName, $compression, $size, $ext, "Resized");
}

// used for destroy a image and send a message via msgSender function
function onSuccess($BlankImage, $imgNewName, $size){
    imagedestroy($BlankImage);
    $cSize = is($imgNewName);
    msgSender($imgNewName, 'url', $size, $cSize);
}

// used for return message in json format, on success or failure
function msgSender($MSG, $FLAG, $psize='', $csize=''){
    $msgArr = array(
        "msg" => $MSG, 
        "flag" => $FLAG
    );
    if($FLAG == 's'){
        echo json_encode($msgArr);
        exit;
    } else if($FLAG == 'e'){
        echo json_encode($msgArr);
        exit;
    } else if($FLAG == 'url'){
        $msgArr = array(
            "msg" => $MSG, 
            "flag" => $FLAG,
            "psize" => $psize,
            "csize" => $csize
        );
       
        echo json_encode($msgArr);
       
        exit;
    }
}

// for checking folder exists
function folderCheck($path){
    if(file_exists($path)){
        return true;
    } else{
        return false;
    }
}

// for getting the image file size in kb, mb format
function is($f, $fl=''){
    if($fl == 'fs'){
        $imgs = $f;
        if($imgs < 1024){
            $imgs = round($imgs, 2) . 'byte';
        }else if($imgs >= 1024 && $imgs < 1048576){
            $imgs = round(($imgs / 1024), 2) . 'KB';
        } else if($imgs >= 1048576){
            $imgs = round(($imgs / 1048576), 2) . 'MB';
        }
        return $imgs;
    } else{
        if(!file_exists($f)){
            msgSender('Something went wrong, Try again later.', 'e');
        }
        $imgs = filesize($f);
        if($imgs < 1000){
            $imgs = round($imgs, 2) . 'byte';
        }else if($imgs >= 1000 && $imgs < 1000000){
            $imgs = round(($imgs / 1000), 2) . 'KB';
        } else if($imgs >= 1000000){
            $imgs = round(($imgs / 1000000), 2) . 'MB';
        }   
        return $imgs;
    }
}

// used for creating a final image
function finalImg($BlankImage, $imgNewName, $compression, $size, $ext, $tool){
    // $imgNewName = '../' . $imgNewName;
    if($ext == 'jpeg'){
        if(imagejpeg($BlankImage, $imgNewName, $compression)){
            onSuccess($BlankImage, $imgNewName, $size);
        } else{
            msgSender("Image can not be $tool", "e");
        }
    } else if($ext == 'png'){
        $pngCompressionValue = (9 - ($compression/100)*10);
        if(imagepng($BlankImage, $imgNewName, $pngCompressionValue)){
            onSuccess($BlankImage, $imgNewName, $size);
        } else{
            msgSender("Image can not be $tool", 'w');
        }
    } else if($ext == 'webp'){
        if(imagewebp($BlankImage, $imgNewName, $compression)){
            onSuccess($BlankImage, $imgNewName, $size);
        } else{
            msgSender("Image can not be $tool", 'w');
        }
    } else if($ext == 'wbmp'){
        if(imagewbmp($BlankImage, $imgNewName)){
            onSuccess($BlankImage, $imgNewName, $size);
        } else{
            msgSender("Image can not be $tool", 'w');
        }
    } else if($ext == 'xbm'){
        if(imagexbm($BlankImage, $imgNewName)){
            onSuccess($BlankImage, $imgNewName, $size);
        } else{
            msgSender("Image can not be $tool", 'w');
        }
    } else if($ext == 'bmp'){
        if(imagebmp($BlankImage, $imgNewName, true)){
            onSuccess($BlankImage, $imgNewName, $size);
        } else{
            msgSender("Image can not be $tool", 'w');
        }
    } else if($ext == 'avif'){
        if(imageavif($BlankImage, $imgNewName, $compression)){
            onSuccess($BlankImage, $imgNewName, $size);
        } else{
            msgSender("Image can not be $tool", 'w');
        }
    } else{
        if(imagejpeg($BlankImage, $imgNewName, $compression)){
            onSuccess($BlankImage, $imgNewName, $size);
        } else{
            msgSender("Image can not be $tool", 'w');
        }
    }
}

// used for creating a source image for operation on image
function sourceImg($OriginalImg, $extension){
    if($extension == 'jpg' || $extension == 'jfif' || $extension == 'jif' || $extension == 'jpeg'){
        return @imagecreatefromjpeg($OriginalImg);
    } else if($extension == 'png'){
        return imagecreatefrompng($OriginalImg);
    } else if($extension == 'webp'){
        return @imagecreatefromwebp($OriginalImg);
    } else if($extension == 'wbmp'){
        return @imagecreatefromwbmp($OriginalImg);
    } else if($extension == 'xbm'){
        return @imagecreatefromxbm($OriginalImg);
    } else if($extension == 'bmp'){
        return @imagecreatefrombmp($OriginalImg);    
    }else if($extension == 'avif'){
        return @imagecreatefromavif($OriginalImg);    
    }else{
        return @imagecreatefromjpeg($OriginalImg);    
    }
}
?>