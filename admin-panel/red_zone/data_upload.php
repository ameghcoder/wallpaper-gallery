<?php

include_once '../SDC.php';

$_wallpaper = $_wallpaper_path = $_wallpaper_type = $_wallpaper_error = $_wallpaper_size = $_wallpaper_name = $_wallpaper_category = $_wallpaper_tags = $_wallpaper_description = "";
$_wFile_name = $_wFile_title = $_Img_extension = $_check_file_size = $done_task = "";
if($_SERVER['REQUEST_METHOD'] == "POST" || !empty($_FILES['wallpaperData'])){
    $_wallpaper = $_FILES['wallpaperData'];
    // wallpaper details variable
    $_wallpaper_path = test_input($_wallpaper['full_path']);
    $_wallpaper_temp_name = $_wallpaper['tmp_name'];
    $_wallpaper_type = $_wallpaper['type'];
    $_wallpaper_size = $_wallpaper['size'];
    $_wallpaper_error = $_wallpaper['error'];

    $_uploader_username = test_input($_POST['username']);
    $_wallpaper_name = test_input($_POST['wallpaperName']);
    $_wallpaper_category = test_input($_POST['wallpaperCategory']);
    $_wallpaper_tags = test_input($_POST['wallpaperTags']);
    $_wallpaper_description = test_input($_POST['wallpaperDescription']);

    list($original_width, $original_height) = getimagesize($_wallpaper_temp_name);
    
    $type_os = "";
    if($original_width > $original_height){
        $type_os = "c";
    } else if($original_height > $original_width){
        $type_os = "a";
    } else{
        $type_os = "s";
    }

    // Now here we declare variables for file
    $_wFile_title = trim($_wallpaper_name); // Page Title Only
    $_wFile_name = str_replace(' ', '-', $_wFile_title); // This is File name and Wallpaper Name
    $_Img_extension = explode('/', $_wallpaper_type)[1];

    if($_Img_extension == "jpg" || $_Img_extension == "jfif"){
        $_Img_extension = "jpeg";
    }

    $URL = $_wFile_name . '.jpeg';
    $PAGE = '/w/' . $_wFile_name;

    if(!file_exists('../../w/' . $_wFile_name . '.php') && !file_exists('../../webp-500/' . $_wFile_name . '.webp') && !file_exists('../../webp-500/' . $_wFile_name . '.webp') && !file_exists('../../uploads/' . $_wFile_name . '.jpeg')){
        $_check_file_size = fileSizeChecker($_wallpaper_size);
        if($_check_file_size){
            if(webp500($_wFile_name, $_wallpaper_temp_name, $_Img_extension, $original_width, $original_height)){
                $done_task .= "Webp 500 image created,";
                if(webp1000($_wFile_name, $_wallpaper_temp_name, $_Img_extension, $original_width, $original_height)){
                    $done_task .= "Webp 1000 image created,";
                    if(originalImg($_wFile_name, $_wallpaper_temp_name, $_Img_extension, $original_width, $original_height)){
                        $done_task .= "Original image uploaded,";
                        // Add Data in Database
                        $query_01 = "INSERT INTO wallpaperaccess(username, category, tag, URL, PAGE, type_os) values('$_uploader_username', '$_wallpaper_category', '$_wallpaper_tags', '$URL', '$PAGE', '$type_os')";
                        $res_01 = mysqli_query($connection, $query_01);
                        if($res_01){
                            $query_02 = "SELECT id FROM wallpaperaccess WHERE URL='$URL'";
                            $res_02 = mysqli_query($connection, $query_02);
                            $res_02 = mysqli_fetch_row($res_02);
                            // we create a web 500, webp 1000 and upload original image and create page
                            $img_id = $res_02[0];
                            
                            $query_03 = "INSERT INTO wallpaperaccessdesc(wall_id, wall_desc) values($img_id, '$_wallpaper_description')";
                            $res_03 = mysqli_query($connection, $query_03);
                            if($res_03){
                                if(createPage($_wallpaper_tags, $_wallpaper_description, $_wFile_name, $_wallpaper_name, $img_id)){
                                    $done_task .= "Page Created Successfully";
                                    msgSender($done_task, "s");
                                }
                            } else{
                                msgSender("Error in res_03 response", "e");
                            }
                        } else{
                            msgSender("Error in res_01 response", "e");
                        }
                    }
                }
            }           
        }
    } else{
        msgSender("Change the file name this file name is already exists", "w");
    }
    
    // echo $_Img_extension;
}

// convert a image into webp format and resize at 500px
function webp500($RawImgName, $OldImg, $ext, $wid, $hei){
    $NewImg = "../../webp-500/" . $RawImgName .'.webp';

    $wantedSize = 500;
    $newWid = $newHei = "";

    // Creating Source Image
    $sourceImage = sourceImg($OldImg, $ext);
    if(!$sourceImage){
        msgSender("Enter a valid Image or this type of image not supported yet or Call the developer.", "w");
        return false;
    } else{
        // calculate size
        if($wid < $wantedSize){
            $newWid = $wid;
            $newHei = $hei;
        } else{
            $newWid = $wantedSize;
            $newHei = ($hei * $newWid)/$wid; 
        }
    
        $BlankImage = imagecreatetruecolor($newWid, $newHei);
        if($BlankImage){
            if(imagecopyresized($BlankImage, $sourceImage, 0, 0, 0, 0, $newWid, $newHei, $wid, $hei)){
                imagedestroy($sourceImage);
                if(imagewebp($BlankImage, $NewImg, 90)){
                    imagedestroy($BlankImage);
                    return true;
                } else{
                    msgSender("Image not Converted in webp-500. Call the developer.", "w");
                    return false;
                }
            } else{
                msgSender("Image copy resized function is not working for webp-500. Call the developer.", "w");
                return false;
            }
        } else{
            msgSender("Image Create True Color function is not working for webp-500. Call the developer.", "w");
            return false;
        }
    }
}

// convert a image into webp format and resize at 1000px
function webp1000($RawImgName, $OldImg, $ext, $wid, $hei){
    $NewImg = "../../webp-1000/" . $RawImgName .'.webp';
    $wantedSize = 1000;
    $newWid = $newHei = "";
    // Creating Source Image
    $sourceImage = sourceImg($OldImg, $ext);
    if(!$sourceImage){
        msgSender("Enter a valid Image or this type of image not supported yet or Call the developer.", "w");
        return false;
    } else{
        // calculate size
        if($wid < $wantedSize){
            $newWid = $wid;
            $newHei = $hei;
        } else{
            $newWid = $wantedSize;
            $newHei = ($hei * $newWid)/$wid; 
        }
        
        $BlankImage = imagecreatetruecolor($newWid, $newHei);
        if($BlankImage){
            if(imagecopyresized($BlankImage, $sourceImage, 0, 0, 0, 0, $newWid, $newHei, $wid, $hei)){
                imagedestroy($sourceImage);
                if(imagewebp($BlankImage, $NewImg, 90)){
                    imagedestroy($BlankImage);
                    return true;
                } else{
                    msgSender("Image not Converted in webp-1000. Call the developer.", "w");
                    return false;
                }
            } else{
                msgSender("Image copy resized function is not working for webp-1000. Call the developer.", "w");
                return false;
            }
        } else{
            msgSender("Image Create True Color function is not working for webp-1000. Call the developer.", "w");
            return false;
        }
    }
}

// convert a image into jpeg for download
function originalImg($RawImgName, $OldImg, $ext, $wid, $hei){
    $NewImg = "../../uploads/" . $RawImgName .'.jpeg';

    // Creating Source Image
    $sourceImage = sourceImg($OldImg, $ext);
    if(!$sourceImage){
        msgSender("Enter a valid Image or this type of image not supported yet or Call the developer.", "w");
        return false;
    } else{
        $BlankImage = imagecreatetruecolor($wid, $hei);
        if($BlankImage){
            if(imagecopyresized($BlankImage, $sourceImage, 0, 0, 0, 0, $wid, $hei, $wid, $hei)){
                imagedestroy($sourceImage);
                if(imagejpeg($BlankImage, $NewImg, 75)){
                    imagedestroy($BlankImage);
                    return true;
                } else{
                    msgSender("Image jpeg function doesn't work in orignial image function. Call the developer.", "w");
                    return false;
                }
            } else{
                msgSender("Image Copy Resized function doesn't work in original Image function. Call the developer.", "w");
                return false;
            }
        } else{
            msgSender("Image create true color function doesn't work in original Image function. Call the developer.", "w");        
            return false;
        }
    }
}

function fileSizeInMB($size){
    if($size > 1000 && $size < 1000000){
        return round($size / 1000) . 'KB';
    } else if ($size > 0 && $size < 1000){
        return round($size / 1000) . 'Byte';
    } else if($size > 1000000){
        return round($size / 1000000) . 'MB';
    }
}

function createPage($keywordsLine, $description, $RawImageName, $title, $imgID){
    $oriURL = $RawImageName . '.jpeg';
    $oriURLwebp = $RawImageName . '.webp';

    $wid = $hei = $image_file_size_in_mb = "";
    list($wid, $hei) = getimagesize("../../uploads/" . $oriURL);
    
    $image_file_size_in_mb = filesize("../../uploads/" . $oriURL);
    $image_file_size_in_mb = fileSizeInMB($image_file_size_in_mb);
    
    $tags = "";
    $tags = explode(',', trim($keywordsLine));
    $how_many_times = 5;
    $li_html = "";
    if(count($tags) > 5){
        $how_many_times = 5;
    }
    for($i = 0; $i < $how_many_times; $i++){
        $li_html .= '<li><a href="/search?wallpaper='.$tags[$i].'" rel="tag">'.$tags[$i].'</a></li>';
    }

    $img_html = "";
    if($wid > $hei){
        $img_html = '<img class="preview-image lazyload landscape" data-src="/webp-1000/'.$oriURLwebp.'" src="/assets/lazyloadimg.webp" onerror="'."this.style.display = 'none'".'" alt="'.$title.'" title="'.$title.'">';
    } else if($hei > $wid || $wid == $hei){
        $img_html = '<img class="preview-image lazyload portrait" data-src="/webp-1000/'.$oriURLwebp.'" src="/assets/lazyloadimg.webp" onerror="'."this.style.display = 'none'".'" alt="'.$title.'" title="'.$title.'">';
    }

    $pageName = $RawImageName . '.php';
    $fh = fopen($pageName, "w");
    $html = '<!DOCTYPE html>'.
    '<html lang="en">'.
    '<head>'.
    '<meta charset="UTF-8">'.
    '<meta http-equiv="X-UA-Compatible" content="IE=edge">'.
    '<meta name="viewport" content="width=device-width, initial-scale=1.0">'.
    '<meta name="keywords" content="'.$keywordsLine.'">'.
    '<meta name="description" content="'.$description.'. Original wallpaper dimension is '.$wid.'×'.$hei.'px, file size is '.$image_file_size_in_mb.'">'.
    '<meta itemprop="name" content="'.$title.'">'.
    '<meta itemprop="description" content="'.$description.'. Original wallpaper dimension is '.$wid.'×'.$hei.'px, file size is '.$image_file_size_in_mb.'">'.
    '<meta itemprop="image" content="https://www.wallpaper-access.com/webp-1000/'.$oriURLwebp.'">'.
    '<meta property="og:title" content="'.$title.'">'.
    '<meta property="og:url" content="https://www.wallpaper-access.com/w/'.$RawImageName.'">'.
    '<meta property="og:description" content="'.$description.'. Original wallpaper dimension is '.$wid.'×'.$hei.'px, file size is '.$image_file_size_in_mb.'">'.
    '<meta property="og:image" content="https://www.wallpaper-access.com/webp-1000/'.$oriURLwebp.'" />'.
    '<meta property="og:image:secure_url" content="https://www.wallpaper-access.com/webp-1000/'.$oriURLwebp.'" />'.
    '<meta property="og:image:type" content="image/jpeg" />'.
    '<meta property="og:image:alt" content="'.$title.'" /><?php include($'.'_SERVER'."['DOCUMENT_ROOT'] . '/component/' . 'img_link.html'); ?>".
    '<link rel="canonical" href="https://www.wallpaper-access.com/w/'.$RawImageName.'" />'.
    '<title>'.$title.'</title>'.
    '</head>'.
    '<body>'.
    '<div class="page-container">'.
    '<div class="page-container-inside">'.
    '<section class="page-section-left"><?php include($'.'_SERVER'."['DOCUMENT_ROOT'] . '/component/' . 'header.html'); ?></section>".
    '<section class="page-section-right">'.
    '<div class="page-section-right-inside">'.
    '<div class="psri-content">'.
    '<div class="psric-top">'.
    '<div class="heading-and-search-box">'.
    '<h1>'.$title.'</h1>'.
    '</div>'.
    '<main class="main-content">'.
    '<section class="img-preview">'.
    '<input value="../uploads/'.$oriURL.'" hidden id="img-heading" />'.
    '<div class="ip-top">'.
    '<div class="ipt-left">'.
    '<div class="img-box">'.
    $img_html.
    '</div>'.
    '<div class="ip-icon-box">'.
    '<div class="ipib-tags">'.
    '<ul>'.
    $li_html.
    '</ul>'.
    '</div>'.
    '<div style="width:100%;display:flex;flex-wrap:wrap;gap:5px;justify-content:center;">'.
    '<button style="border-radius:5px;padding:10px;font-size:20px;background:var(--border);border:none;width:98%;max-width:400px;margin:auto;" type="button" class="img-share-btn" title="Click or Press '."'s'".' for share">Share</button>'.
    '<button style="border-radius:5px;padding:10px;font-size:20px;background:var(--border);border:none;width:98%;max-width:400px;margin:auto;" type="button" id="preview-img" title="Click or Press '."'f'".' for preview">Preview</button>'.
    '</div>'.
    '<a style="border-radius:5px;padding:10px;font-size:20px;background:var(--border);border:none;width:100%;text-decoration:none;margin:10px 0px;display:inline-block;text-align:center;" href="/uploads/'.$oriURL.'" id="img-download-btn" download>Download</a>'.
    '<?php include($'.'_SERVER'."['DOCUMENT_ROOT'].'/component/'.'ip-display-ads.html') ?>".
    '<div class="ipib-view-reso-download">'.
    '<span class="ipib-reso">'.
    '<span class="ipib-txt">Resolution</span>'.
    '<span class="digits">'.$wid.'×'.$hei.'</span>'.
    '</span>'.
    '</div>'.
    '</div>'.
    '</div>'.
    '<div class="ipt-right">'.
    '<?php include($'.'_SERVER'."['DOCUMENT_ROOT'] . '/component/' . 'side-category-code.html') ?>".
    '</div>'.
    '</div>  '.
    '</section>'.
    '<?php include($'.'_SERVER'."['DOCUMENT_ROOT'].'/component/'.'ip-display-ads.html') ?>".
    '<div class="share-box">'.
    '<div class="share-box-inside">'.
    '<button onclick="document.querySelector('."'.share-box').classList.add('zoom-out');document.querySelector('.share-box').classList.remove('zoom-in');".'" type="button" style="cursor : pointer; background: red; padding: 5px 10px; color: white; border: none; outline: none; font-weight: bolder; font-size: 15px;">&#9587;</button>'.
    '<div class="sbi-top"><input type="text" class="pageURL" value="https://www.wallpaper-access.com/w/'.$RawImageName.'" disabled></div>'.
    '<div class="sbi-btm">'.
    '<a href="https://www.facebook.com/sharer/sharer.php?u=https://www.wallpaper-access.com/w/'.$RawImageName.'" id="fb-share" role="button" style="background: #3b5998;">Facebook</a>'.
    '<a href="https://twitter.com/share?url=https://www.wallpaper-access.com/w/'.$RawImageName.'" id="tw-share" role="button" style="background: #00acee;">Tweet</a>'.
    '<a href="https://api.whatsapp.com/send?text=https://www.wallpaper-access.com/w/'.$RawImageName.'" id="wh-share" role="button" style="background: #25D366;">Whatsapp</a>'.
    '<button type="button" class="copy-link" style="border: none; outline: none;">Copy Link</button>'.
    '</div>'.
    '</div>'.
    '</div>'.
    '<section class="img-section">'.
    '<div class="img-section-inside">'.
    '<?php include($'.'_SERVER'."['DOCUMENT_ROOT'] . '/component/relative.php'); ?>".
    '</div>'.
    '</section>'.
    '</main>'.
    '</div>'.
    '<div class="psric-btm">'.
    '<?php include($'.'_SERVER'."['DOCUMENT_ROOT'] . '/component/' . 'footer.html'); ?>".
    '</div>'.
    '</div>'.
    '</div>'.
    '</section>'.
    '</div>'.
    '</div>'.
    '</body>'.
    '</html>'.
    '<script>'.
    '</script>';

    fwrite($fh, $html);
    fclose($fh);
    $msg = rename('../red_zone/' . $pageName, '../../w/' . $pageName);
    if($msg){
        return true;
    } else{
        return false;
    }
}

// image size checker, to check image is too small or too big
function fileSizeChecker($fileSize){
    $MAX_FILE_SIZE = 10485760;
    if($fileSize > $MAX_FILE_SIZE){
        msgSender("Image is too big", 'w');
        exit;
    } else if($fileSize < 20480){
        msgSender("Image is too small", 'w');
        exit;
    } else{
        return true;
    }
}

// this is a message sender that will send return message in json format
function msgSender($MSG, $FLAG){
    $msgArr = array(
        "msg" => $MSG, 
        "flag" => $FLAG
    );
    if($FLAG == 's'){
        echo json_encode($msgArr);
        exit;
    } else if($FLAG == 'w'){
        echo json_encode($msgArr);
    }
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars(($data));
    return $data;
}

function sourceImg($OriginalImg, $extension){
    if($extension == 'jpg' || $extension == 'jfif' || $extension == 'jif' || $extension == 'jpeg'){
        return @imagecreatefromjpeg($OriginalImg);
    } else if($extension == 'png'){
        return @imagecreatefrompng($OriginalImg);
    } else if($extension == 'webp'){
        return @imagecreatefromwebp($OriginalImg);
    } else if($extension == 'wbmp'){
        return @imagecreatefromwbmp($OriginalImg);
    } else if($extension == 'xbm'){
        return @imagecreatefromxbm($OriginalImg);
    } else if($extension == 'bmp'){
        return @imagecreatefrombmp($OriginalImg);    
    } else if($extension == 'avif'){
        return @imagecreatefromavif($OriginalImg);    
    }else{
        return @imagecreatefromjpeg($OriginalImg);    
    }
}

?>