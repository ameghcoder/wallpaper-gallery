<?php
include '../SDC.php';

// this is a message sender that will send return message in json format
function msgSender($MSG, $FLAG){
    $msgArr = array(
        "msg" => $MSG, 
        "flag" => $FLAG
    );
    if($FLAG == 's'){
        echo json_encode($msgArr);
        exit;
    } else if($FLAG == 'e' || $FLAG == 'w'){
        echo json_encode($msgArr);
    }
}
if($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['which'] == "recent"){
    $type_of_os = $_GET['flag'];
    // msgSender($type_of_os, 's');
    if($type_of_os != 'c' && $type_of_os != 'a'){
        return false;
    }
    $_goto = $_edit_page_name = $_open_html = $_close_html = $_final_html = '';
    $_close_html = '';
    if($type_of_os == 'c'){
        $_open_html = '<div class="img-section-inside isi-desktop"><h2>Desktop Wallpapers</h2><ul itemscope itemtype="http://schema.org/ImageGallery" class="desktop wallpaper-gallery">';
        $_edit_page_name = 'desktop-wallpapers.html';
        $_close_html = '</ul></div>';
        // $_close_html = '</ul><div class="go-to-swdom-btn"><a href="/desktop-wallpapers">Show All Desktop Wallpapers</a><span class="gtwb-middle-line"></span></div></div>';
    } else{
        $_open_html = '<div class="img-section-inside isi-mobile"><h2>Mobile Wallpapers</h2><ul itemscope itemtype="http://schema.org/ImageGallery" class="mobile wallpaper-gallery">';
        $_edit_page_name = 'mobile-wallpapers.html';
        $_close_html = '</ul></div>';
        // $_close_html = '</ul><div class="go-to-swdom-btn"><a href="/mobile-wallpapers">Show All Mobile Wallpapers</a><span class="gtwb-middle-line"></span></div></div>';
    }
    $_middle_html = $_final_html = "";
    $_query_01 = "SELECT * FROM wallpaperaccess WHERE type_os='$type_of_os' ORDER BY 1 DESC LIMIT 0, 16";
    $_res_01 = mysqli_query($connection, $_query_01);
    $_num_01 = mysqli_num_rows($_res_01);
    $_res_01 = mysqli_fetch_all($_res_01);

    for($i = 0; $i < $_num_01; $i++){
        $_FILE_ID = $_res_01[$i][0];
        $_FILE_URL = $_res_01[$i][4];
        $_PAGE_URL = $_res_01[$i][7];
        $_FILE_TAGS = $_res_01[$i][3];
        $_FILE_EXT = explode('.', $_FILE_URL)[1];
        $_FILE_NAME = $_FILE_NAME_WH = explode('.', $_FILE_URL)[0];
        $_FILE_NAME = str_replace('-', ' ', $_FILE_NAME);
        list($_WIDTH, $_HEIGHT) = getimagesize('../../uploads/'.$_FILE_URL);
        $_FILE_SIZE = filesize('../../uploads/'.$_FILE_URL);

        $_query_02 = "SELECT wall_desc FROM wallpaperaccessdesc WHERE wall_id=$_FILE_ID";
        $_res_02 = mysqli_query($connection, $_query_02);
        $_res_02 = mysqli_fetch_row($_res_02);

        if($type_of_os == 'c'){
            if($i <= 7 && $i >= 0){
                $_img_html = '<img itemprop="contentUrl" alt="'.$_FILE_NAME.'" title="'.$_FILE_NAME.'" src="/webp-500/'.$_FILE_NAME_WH.'.webp">';
            } else{
                $_img_html = '<img class="lazyload" itemprop="contentUrl" alt="'.$_FILE_NAME.'" title="'.$_FILE_NAME.'" data-src="/webp-500/'.$_FILE_NAME_WH.'.webp" src="/assets/android-lazyload.webp">';
            }
        } else{
            $_img_html = '<img class="lazyload" itemprop="contentUrl" alt="'.$_FILE_NAME.'" title="'.$_FILE_NAME.'" data-src="/webp-500/'.$_FILE_NAME_WH.'.webp" src="/assets/android-lazyload.webp">';
        }

        $_middle_html .= '<li itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject" class="gird-items">'.
        '<meta itemprop="fileFormat" content="image/'.$_FILE_EXT.'">'.
        '<meta itemprop="keywords" content="'.$_FILE_TAGS.'">'.
        '<meta itemprop="description" content="'.$_res_02[0][0].'">'.
        '<meta itemprop="contentSize" content="'.$_FILE_SIZE.'">'.
        '<div class="res"><span itemprop="width" itemscope="" itemtype="http://schema.org/QuantitativeValue">'.
        '<span itemprop="value">'.$_WIDTH.'</span>'.
        '<meta itemprop="unitText" content="px">'.
        '</span>x<span itemprop="height" itemscope="" itemtype="http://schema.org/QuantitativeValue">'.
        '<span itemprop="value">'.$_HEIGHT.'</span>'.
        '<meta itemprop="unitText" content="px">'.
        '</span>px</div>'.
        '<figure>'.
        '<a itemprop="url" href="'.$_PAGE_URL.'">'.$_img_html.
        '</a>'.
        '<figcaption itemprop="caption">'.$_FILE_NAME.'</figcaption>'.
        '</figure>'.
        '</li>';
    }
    
    $_final_html = $_open_html . $_middle_html . $_close_html;

    $_file_open_ = fopen($_edit_page_name, "w");
    fwrite($_file_open_, $_final_html);

    fclose($_file_open_);
    if(rename('../red_zone/' . $_edit_page_name, '../../component/' . $_edit_page_name)){
        msgSender("Edited Successfully", "s");
    } else {
        msgSender("Not Edited Successfully", "e");
    }
} else if($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['which'] == "recentisi"){

    $type_of_os = $_GET['flag'];
    // msgSender($type_of_os, 's');
    if($type_of_os != 'c' && $type_of_os != 'a'){
        return false;
    }
    $_goto = $_edit_page_name = $_open_html = $_close_html = $_final_html = '';
    $_close_html = '';
    if($type_of_os == 'c'){
        $_open_html = '<div class="img-section-inside isi-desktop isi-desktop-mobile-display"><h2>Desktop Wallpapers</h2><ul itemscope itemtype="http://schema.org/ImageGallery" class="desktop wallpaper-gallery">';
        $_edit_page_name = 'desktop-wallpapers-isi.html';
        $_close_html = '</ul></div>';
        // $_close_html = '</ul><div class="go-to-swdom-btn"><a href="/desktop-wallpapers">Show All Desktop Wallpapers</a><span class="gtwb-middle-line"></span></div></div>';
    } else{
        $_open_html = '<div class="img-section-inside isi-mobile isi-desktop-mobile-display"><h2>Mobile Wallpapers</h2><ul itemscope itemtype="http://schema.org/ImageGallery" class="mobile wallpaper-gallery">';
        $_edit_page_name = 'mobile-wallpapers-isi.html';
        $_close_html = '</ul></div>';
        // $_close_html = '</ul><div class="go-to-swdom-btn"><a href="/mobile-wallpapers">Show All Mobile Wallpapers</a><span class="gtwb-middle-line"></span></div></div>';
    }
    $_middle_html = $_final_html = "";
    $_query_01 = "SELECT * FROM wallpaperaccess WHERE type_os='$type_of_os' ORDER BY 1 DESC LIMIT 0, 16";
    $_res_01 = mysqli_query($connection, $_query_01);
    $_num_01 = mysqli_num_rows($_res_01);
    $_res_01 = mysqli_fetch_all($_res_01);

    for($i = 0; $i < $_num_01; $i++){
        $_FILE_ID = $_res_01[$i][0];
        $_FILE_URL = $_res_01[$i][4];
        $_PAGE_URL = $_res_01[$i][7];
        $_FILE_TAGS = $_res_01[$i][3];
        $_FILE_EXT = explode('.', $_FILE_URL)[1];
        $_FILE_NAME = $_FILE_NAME_WH = explode('.', $_FILE_URL)[0];
        $_FILE_NAME = str_replace('-', ' ', $_FILE_NAME);
        list($_WIDTH, $_HEIGHT) = getimagesize('../../uploads/'.$_FILE_URL);
        $_FILE_SIZE = filesize('../../uploads/'.$_FILE_URL);

        $_query_02 = "SELECT wall_desc FROM wallpaperaccessdesc WHERE wall_id=$_FILE_ID";
        $_res_02 = mysqli_query($connection, $_query_02);
        $_res_02 = mysqli_fetch_row($_res_02);

        if($type_of_os == 'c'){
            if($i <= 7 && $i >= 0){
                $_img_html = '<img itemprop="contentUrl" alt="'.$_FILE_NAME.'" title="'.$_FILE_NAME.'" src="/webp-500/'.$_FILE_NAME_WH.'.webp">';
            } else{
                $_img_html = '<img class="lazyload" itemprop="contentUrl" alt="'.$_FILE_NAME.'" title="'.$_FILE_NAME.'" data-src="/webp-500/'.$_FILE_NAME_WH.'.webp" src="/assets/android-lazyload.webp">';
            }
        } else{
            $_img_html = '<img class="lazyload" itemprop="contentUrl" alt="'.$_FILE_NAME.'" title="'.$_FILE_NAME.'" data-src="/webp-500/'.$_FILE_NAME_WH.'.webp" src="/assets/android-lazyload.webp">';
        }

        $_middle_html .= '<li itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject" class="gird-items">'.
        '<meta itemprop="fileFormat" content="image/'.$_FILE_EXT.'">'.
        '<meta itemprop="keywords" content="'.$_FILE_TAGS.'">'.
        '<meta itemprop="description" content="'.$_res_02[0][0].'">'.
        '<meta itemprop="contentSize" content="'.$_FILE_SIZE.'">'.
        '<div class="res"><span itemprop="width" itemscope="" itemtype="http://schema.org/QuantitativeValue">'.
        '<span itemprop="value">'.$_WIDTH.'</span>'.
        '<meta itemprop="unitText" content="px">'.
        '</span>x<span itemprop="height" itemscope="" itemtype="http://schema.org/QuantitativeValue">'.
        '<span itemprop="value">'.$_HEIGHT.'</span>'.
        '<meta itemprop="unitText" content="px">'.
        '</span>px</div>'.
        '<figure>'.
        '<a itemprop="url" href="'.$_PAGE_URL.'">'.$_img_html.
        '</a>'.
        '<figcaption itemprop="caption">'.$_FILE_NAME.'</figcaption>'.
        '</figure>'.
        '</li>';
    }
    
    $_final_html = $_open_html . $_middle_html . $_close_html;

    $_file_open_ = fopen($_edit_page_name, "w");
    fwrite($_file_open_, $_final_html);

    fclose($_file_open_);
    if(rename('../red_zone/' . $_edit_page_name, '../../component/' . $_edit_page_name)){
        msgSender("Edited Successfully", "s");
    } else {
        msgSender("Not Edited Successfully", "e");
    }
} else if($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['which'] == "hmcatenum"){
    $_query_03 = $_res_03 = $_num_03 = "";
    $_cate_array = ['ai', '3d', '4k', 'abstruct', 'actor', 'actress', 'art', 'animal', 'android', 'anime', 'avengers', 'bts', 'baby', 'building', 'bike', 'cars', 'cartoon', 'christmas', 'computer', 'freefire', 'city', 'gods', 'galaxy', 'gym', 'gun', 'gaming', 'house', 'mountain', 'nature', 'planet', 'webseries'];
    $_first_html = '<ul class="cnbt-inside">';
    $_last_html = '</ul>';
    $_middle_html = '';
    for($i = 0; $i < count($_cate_array); $i++){
        $_query_03 = "SELECT id FROM wallpaperaccess WHERE category='$_cate_array[$i]'";
        $_res_03 = mysqli_query($connection, $_query_03);
        $_num_03 = mysqli_num_rows($_res_03);
        $_middle_html .= '<li><a href="/category/'.$_cate_array[$i].'"><span>'.$_cate_array[$i].'</span><span>'.$_num_03.'</span></a></li>';
    }
    $_final_html_03 = $_first_html . $_middle_html . $_last_html;
    $_edit_page_name_03 = 'cnbt-inside.html';
    $_file_open_03 = fopen($_edit_page_name_03, "w");

    fwrite($_file_open_03, $_final_html_03);
    fclose($_file_open_03);
    if(rename('../red_zone/' . $_edit_page_name_03, '../../component/' . $_edit_page_name_03)){
        msgSender("Edited Successfully", "s");
    } else {
        msgSender("Not Edited Successfully", "e");
    }
} else if($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['which'] == 'sitemap'){
    $query_sitemap = "SELECT URL, PAGE FROM wallpaperaccess";
    $res_sitemap = mysqli_query($connection, $query_sitemap);
    $res_sitemap_num = mysqli_num_rows($res_sitemap);
    $res_sitemap_fetch = mysqli_fetch_all($res_sitemap);
    
    $start_xml = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
    $middle_xml = '';    
    $end_xml = '</urlset>';
    for($i = 0; $i < $res_sitemap_num; $i++){
        $middle_xml .=  '<url>
                            <loc>https://www.wallpaper-access.com'.$res_sitemap_fetch[$i][1].'</loc>
                            <image:image>
                            <image:loc>https://www.wallpaper-access.com/uploads/'.$res_sitemap_fetch[$i][0].'</image:loc>
                            </image:image>
                        </url>';
    }
    $_final_sitemap = $start_xml . $middle_xml . $end_xml;
    $_sitemap_name = 'imgSitemap.xml';
    $_file_open_sitemap = fopen($_sitemap_name, "w");

    fwrite($_file_open_sitemap, $_final_sitemap);

    fclose($_file_open_sitemap);
    if(rename('../red_zone/' . $_sitemap_name, '../../' . $_sitemap_name)){
        msgSender("Sitemap Updated Successfully", "s");
    } else {
        msgSender("Sitemap not updated Successfully", "e");
    }
}
?>