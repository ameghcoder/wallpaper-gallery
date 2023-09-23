<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="description" content="WallpaperAccess is the best website to download high-quality wallpapers and background pictures for desktops, phones and tables, for free.">
<meta name="keywords" content="4k wallpapers, android wallpapers, cool hd wallpapers, iphone wallpaper, gaming wallpaper, Search Any Wallpaper, nature wallpapers, desktop wallpapers, wallpapers, Full hd wallpapers">
<meta itemprop="name" content="Search Any Wallpaper || Thousands for Wallpapers">
<meta itemprop="description" content="WallpaperAccess is the best website to download high-quality wallpapers and background pictures for desktops, phones and tables, for free.">
<meta itemprop="image" content="https://www.wallpaper-access.com/assets/android.webp">
<meta name="twitter:title" content="Search Any Wallpaper || Thousands for Wallpapers">
<meta name="twitter:description" content="WallpaperAccess is the best website to download high-quality wallpapers and background pictures for desktops, phones and tables, for free.">
<meta name="twitter:image:src" content="https://www.wallpaper-access.com/assets/android.webp">
<?php
    $actual_link = "https://www.wallpaper-access.com$_SERVER[REQUEST_URI]";
    $actual_link = htmlspecialchars($actual_link);
    $actual_link =trim($actual_link);
    echo '<link rel="canonical" href="'.$actual_link.'" />';
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/component/' . 'homepage_link.html'); ?>
<title>Search Any Wallpaper</title>
</head>
<body>
    <div class="page-container">
        <div class="page-container-inside">
            <section class="page-section-left">
                <?php include($_SERVER['DOCUMENT_ROOT'] . '/component/' . 'header.html'); ?>
            </section>
            <section class="page-section-right">
                <div class="page-section-right-inside">
                    <div class="psri-content">
                        <div class="psric-top">
                            <div class="heading-and-search-box">
                                <h1 style="font-size : 3rem;">Search Wallpaper</h1>
                            </div>
                            <main class="main-content">
<div style="width : 100%; margin : 10px auto; ">
                <?php include($_SERVER['DOCUMENT_ROOT'] . '/component/' . 'search-box.html'); ?>

</div>
<section class="img-section">
<div class="img-section-inside">
<div class="img-box" id="Gallery">
<?php
    include_once './NDA.php';
    $currentPageUrl = "https://www.wallpaper-access.com/".$_SERVER["REQUEST_URI"]; 
    $url_components = parse_url($currentPageUrl);
    parse_str($url_components['query'], $params);
    $query0 = $params['wallpaper'];
    $query0 = htmlspecialchars($query0);
    $query0 =trim($query0);
    $query0 = str_replace('-', ' ', $query0);
    $query0 = str_replace('/', ' ', $query0);
    $query0 = str_replace('wallpaper', '', $query0);
    $query0 = str_replace('image', '', $query0);
    $query0 = str_replace('pic', '', $query0);
    $query0 = str_replace('picture', '', $query0);
    $query0 = str_replace('free', '', $query0);
    
    if($query0 == "all" || $query0 == ""){
        $query = "SELECT * FROM wallpaperaccess ORDER BY 1 DESC LIMIT 0, 15";
        $res = mysqli_query($connection, $query);
        $Allres = mysqli_fetch_all($res);
        $num = mysqli_num_rows($res);
    } else{
        $query = "SELECT * FROM wallpaperaccess WHERE MATCH(tag, category) AGAINST('$query0') ORDER BY 1 DESC LIMIT 0, 15";
        $res = mysqli_query($connection, $query);
        $Allres = mysqli_fetch_all($res);
        $num = mysqli_num_rows($res);
    }
    
    if($num == 0){
        $query = "SELECT * FROM wallpaperaccess WHERE category='$query0' ORDER BY 1 DESC LIMIT 0, 15";
        $res = mysqli_query($connection, $query);
        $Allres = mysqli_fetch_all($res);
        $num = mysqli_num_rows($res);
    }
    if($num == 0){
        echo "<p style='text-align : center; display : inline-block; margin : auto;'>Sorry, We have no Wallpapers to show for this Keywords, Change it or type all for recent wallpapers</p>";
    }
    clearstatcache();
    $html = '';
    $html_01 = '<div class="img-row-i1"><div class="ir-1-tb">';
    $html_02 = '<div class="img-row-i2"><div class="ir-2-tb">';
    $html_03 = '<div class="img-row-i3"><div class="ir-3-tb">';
    $html_01_close = '</div><div class="ir-1-bb"><div class="ir-1-tb-loader" style="text-align : center; margin : auto;"><img width="50px" src="/assets/loader.gif" /></div><div class="hidden-end-checker-01" data-id="ir-1" style="visibility:hidden;">checker</div></div></div>';
    $html_02_close = '</div><div class="ir-2-bb"><div class="ir-2-tb-loader" style="text-align : center; margin : auto;"><img width="50px" src="/assets/loader.gif" /></div><div class="hidden-end-checker-02" data-id="ir-2" style="visibility:hidden;">checker</div></div></div>';
    $html_03_close = '</div><div class="ir-3-bb"><div class="ir-3-tb-loader" style="text-align : center; margin : auto;"><img width="50px" src="/assets/loader.gif" /></div><div class="hidden-end-checker-03" data-id="ir-3" style="visibility:hidden;">checker</div></div></div>';
    for($i = 0; $i < $num; $i++){
        $userId = $Allres[$i][0];      
        $urlDis = $Allres[$i][4];
        $PAGEURL = $Allres[$i][7];
        $altName = str_replace( '-', ' ' , substr($PAGEURL, 3));
        $ImgNameDock = explode('.', $urlDis);
        $ImgNameDock01 = $ImgNameDock[0];
        if(file_exists('./uploads/' . $urlDis) && file_exists('./webp-500/'.$ImgNameDock01.'.webp')){
            $tags = $Allres[$i][3];
            list($width, $height) = getimagesize('./uploads/' . $urlDis);
            $sizeInByte = filesize('./uploads/' . $urlDis);
            $showImgURL = '/webp-500/'.$ImgNameDock01.'.webp';
            if($i >= 0 && $i <= 4){
                $lastid = 5;
                $html_01 .= '<li itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                    <meta itemprop="fileFormat" content="image/jpeg">
                    <meta itemprop="keywords" content="'.$tags.'">
                    <meta itemprop="description" content="'.$altName.'. '.$tags.' wallpaper by wallpaper access.">
                    <meta itemprop="contentSize" content="'.$sizeInByte.'">
                    <div class="img-info-box">                        
                        <span itemprop="width" itemscope="" itemtype="http://schema.org/QuantitativeValue">
                            <span itemprop="value">'.$width.'</span>
                            <meta itemprop="unitText" content="px">
                        </span>x
                        <span itemprop="height" itemscope="" itemtype="http://schema.org/QuantitativeValue">
                            <span itemprop="value">'.$height.'</span>
                            <meta itemprop="unitText" content="px">
                        </span>
                    </div>
                    <figure>
                        <a itemprop="url" class="img-anchor" data-id='.$lastid.' href="'.$PAGEURL.'">
                            <img class="small-img lazyload" itemprop="contentUrl" alt="'.$altName.'" title="'.$altName.'" src="/assets/lazyload.webp" data-src="'.$showImgURL.'" data-id="'.$userId.'">
                        </a>
                        <figcaption itemprop="caption">'.$altName.'</figcaption>
                    </figure>
                </li>';
            } else if($i >= 5 && $i <= 9){
                $lastid = 10;
                $html_02 .= '<li itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                <meta itemprop="fileFormat" content="image/jpeg">
                <meta itemprop="keywords" content="'.$tags.'">
                <meta itemprop="description" content="'.$altName.'. '.$tags.' wallpaper by wallpaper access.">
                <meta itemprop="contentSize" content="'.$sizeInByte.'">
                <div class="img-info-box">                        
                    <span itemprop="width" itemscope="" itemtype="http://schema.org/QuantitativeValue">
                        <span itemprop="value">'.$width.'</span>
                        <meta itemprop="unitText" content="px">
                    </span>x
                    <span itemprop="height" itemscope="" itemtype="http://schema.org/QuantitativeValue">
                        <span itemprop="value">'.$height.'</span>
                        <meta itemprop="unitText" content="px">
                    </span>
                </div>
                <figure>
                    <a itemprop="url" class="img-anchor" data-id='.$lastid.' href="'.$PAGEURL.'">
                        <img class="small-img lazyload" itemprop="contentUrl" alt="'.$altName.'" title="'.$altName.'" src="/assets/lazyload.webp" data-src="'.$showImgURL.'" data-id="'.$userId.'">
                    </a>
                    <figcaption itemprop="caption">'.$altName.'</figcaption>
                </figure>
            </li>';  
            } else if($i >= 10 && $i <= 14){
                $lastid = 15;
                $html_03 .= '<li itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                <meta itemprop="fileFormat" content="image/jpeg">
                <meta itemprop="keywords" content="'.$tags.'">
                <meta itemprop="description" content="'.$altName.'. '.$tags.' wallpaper by wallpaper access.">
                <meta itemprop="contentSize" content="'.$sizeInByte.'">
                <div class="img-info-box">                        
                    <span itemprop="width" itemscope="" itemtype="http://schema.org/QuantitativeValue">
                        <span itemprop="value">'.$width.'</span>
                        <meta itemprop="unitText" content="px">
                    </span>x
                    <span itemprop="height" itemscope="" itemtype="http://schema.org/QuantitativeValue">
                        <span itemprop="value">'.$height.'</span>
                        <meta itemprop="unitText" content="px">
                    </span>
                </div>
                <figure>
                    <a itemprop="url" class="img-anchor" data-id='.$lastid.' href="'.$PAGEURL.'">
                        <img class="small-img lazyload" itemprop="contentUrl" alt="'.$altName.'" title="'.$altName.'" src="/assets/lazyload.webp" data-src="'.$showImgURL.'" data-id="'.$userId.'">
                    </a>
                    <figcaption itemprop="caption">'.$altName.'</figcaption>
                </figure>
            </li>';
            }
        }
    }
    echo $html_01 . $html_01_close . $html_02 . $html_02_close . $html_03 . $html_03_close;
?>                          
</div>
</div>
</section>
                            </main>
                        </div>
                        <div class="psric-btm">
                            <?php include($_SERVER['DOCUMENT_ROOT'] . '/component/' . 'footer.html'); ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>

</html>