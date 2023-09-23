<?php

include_once '../SDC.php';

$_update_title = $_update_description = $_update_tags = $_update_category = $_wall_id = "";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $_update_title = $_POST['update_title'];
    $_update_description = $_POST['update_description'];
    $_update_tags = $_POST['update_tags'];
    $_update_category = $_POST['update_category'];
    $_wall_id = $_POST['wall_id'];

    $_update_name = test_input($_update_title);
    $_update_name = str_replace('-', ' ', $_update_name);

    $query_01 = "SELECT URL FROM wallpaperaccess WHERE id=$_wall_id";
    $res_01 = mysqli_query($connection, $query_01);
    $res_01 = mysqli_fetch_row($res_01);
    $_db_wall_name = explode('.',$res_01[0])[0];
    $_db_wall_ext = explode('.',$res_01[0])[1];
    if($_db_wall_name == $_update_title){
        if(setData($_update_category, $_update_tags, $_wall_id)){
            if(setDesc($_update_description, $_wall_id)){
                if(createPage($_update_tags, $_update_description, $_update_title, $_update_name, $_wall_id)){
                    msgSender("Page edited successfully.", "s");
                } else{
                    msgSender("Create Page is not working, An Error Occurred", "w");
                }
            } else{
                msgSender("Set Desc is not working, An Error Occurred", "w");
            }
        } else {
            msgSender("Set Data is not working, An Error Occurred", "w");
        }
    } else{
        if(renameFunc($_update_title, $_wall_id)){
            if(setData($_update_category, $_update_tags, $_wall_id, $_update_title.'.'.$_db_wall_ext, '/w/'.$_update_title)){
                if(setDesc($_update_description, $_wall_id)){
                    if(createPage($_update_tags, $_update_description, $_update_title, $_update_name, $_wall_id)){
                        msgSender("Page edited successfully.", "s");
                    } else{
                        msgSender("Create Page is not working, in update title, An Error Occurred", "w");
                    }
                } else{
                    msgSender("Set Desc is not working, in update title, An Error Occurred", "w");
                }
            } else {
                msgSender("Set Data is not working, in update title, An Error Occurred", "w");
            }
        }
    }
    // echo $_Img_extension;
}

function renameFunc($_new_title, $_id){
    global $connection;
    $_old_title = $_old_title_wext = $_ext = "";
    $_query = "SELECT URL FROM wallpaperaccess WHERE id=$_id";
    $_res = mysqli_query($connection, $_query);
    $_res = mysqli_fetch_row($_res);
    if($_res != null || $_res){
        $_old_title = $_res[0];
        $_old_title_wext = explode('.', $_res[0])[0];
        $_ext = explode('.', $_res[0])[1];
    }
    if(rename('../../webp-500/'.$_old_title_wext.'.webp', '../../webp-500/' . $_new_title . '.webp')){
        if(rename('../../webp-1000/'.$_old_title_wext.'.webp', '../../webp-1000/' . $_new_title . '.webp')){
            if(rename('../../uploads/'.$_old_title, '../../uploads/' . $_new_title .'.'. $_ext)){
                if(rename('../../w/'.$_old_title_wext.'.php', '../../w/' . $_new_title . '.php')){
                    return true;
                }else{
                    msgSender("Rename function w folder is not working.", "w");
                }
            } else{
                msgSender("Rename function for uploads is not working.", "w");
            }
        } else{
            msgSender("Rename function for webp 1000 is not working.", "w");
        }
    } else{
        msgSender("Rename function for webp 500 is not working.", "w");
    }
}

function setData($_category, $_tag, $id, $_URL = '', $_PAGE = ''){
    global $connection;
    if($_URL == '' || $_PAGE == ''){
        $query = "UPDATE wallpaperaccess SET category='$_category', tag='$_tag' WHERE id=$id";
    } else{
        $query = "UPDATE wallpaperaccess SET category='$_category', tag='$_tag', URL='$_URL', PAGE='$_PAGE' WHERE id=$id";
    }
    $res = mysqli_query($connection, $query);
    if($res){
        return true;
    } else{
        return false;
    }
}
function setDesc($_description, $_wall_id){
    global $connection;
    $query = $res = "";
    $_get_query = "SELECT * FROM wallpaperaccessdesc WHERE wall_id=$_wall_id";
    $_get_res = mysqli_query($connection, $_get_query);
    $_get_res = mysqli_fetch_row($_get_res);
    if($_get_res){
        $query = "UPDATE wallpaperaccessdesc SET wall_desc='$_description' WHERE wall_id=$_wall_id";
        $res = mysqli_query($connection, $query);
    } else{
        $query = "INSERT INTO wallpaperaccessdesc(wall_id, wall_desc) VALUES ($_wall_id, '$_description')";
        $res = mysqli_query($connection, $query);
    }
    if($res){
        return true;
    } else{
        return false;
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
    $imgURL = $RawImageName . '.webp';
    $oriURL = $RawImageName . '.jpeg';

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
        $img_html = '<img class="preview-image lazyload landscape" data-src="/uploads/'.$oriURL.'" src="/assets/lazyloadimg.webp" onerror="'."this.style.display = 'none'".'" alt="'.$title.'" title="'.$title.'">';
    } else if($hei > $wid || $wid == $hei){
        $img_html = '<img class="preview-image lazyload portrait" data-src="/uploads/'.$oriURL.'" src="/assets/lazyloadimg.webp" onerror="'."this.style.display = 'none'".'" alt="'.$title.'" title="'.$title.'">';
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
    '<meta itemprop="image" content="https://www.wallpaper-access.com/uploads/'.$oriURL.'">'.
    '<meta property="og:title" content="'.$title.'">'.
    '<meta property="og:url" content="https://www.wallpaper-access.com/w/'.$RawImageName.'">'.
    '<meta property="og:description" content="'.$description.'. Original wallpaper dimension is '.$wid.'×'.$hei.'px, file size is '.$image_file_size_in_mb.'">'.
    '<meta property="og:image" content="https://www.wallpaper-access.com/uploads/'.$oriURL.'" />'.
    '<meta property="og:image:secure_url" content="https://www.wallpaper-access.com/uploads/'.$oriURL.'" />'.
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
    '<span data-id="'.$imgID.'" id="data-id-of-img" style="display : none" hidden>Image ID</span>'.
    '<span class="ipib-view">'.
    '<span class="ipib-txt">View</span>'.
    '<span class="digits" id="number-of-view">00</span>'.
    '</span>'.
    '<span class="ipib-reso">'.
    '<span class="ipib-txt">Resolution</span>'.
    '<span class="digits">'.$wid.'×'.$hei.'</span>'.
    '</span>'.
    '<span role="separator"></span>'.
    '<span class="ipib-download">'.
    '<span class="ipib-txt">'.
    '<a href="/uploads/'.$oriURL.'" id="img-download-btn" download>Download</a>'.
    '</span>'.
    '<span class="digits" id="number-of-downloads">00</span>'.
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
?>