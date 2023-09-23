<?php
include_once '../NDA.php';
if(isset($_GET['id'])){
    $id = $query = "";
    if(isset($_GET['type']) && ($_GET['type'] == "sr" || $_GET['type'] == "w") && !empty($_GET["keywords"])){
        $id = $_GET['id'];
        $id = mysqli_real_escape_string($connection, $id);
        $id = trim($id);
        $id = htmlspecialchars($id);
        
        $query0 = strtolower($_GET["keywords"]);
        $query0 = htmlspecialchars($query0);
        $query0 =trim($query0);
        $query0 = str_replace('-', ' ', $query0);
        $query0 = str_replace('/', ' ', $query0);
        $query0 = str_replace('+', ' ', $query0);
        $query0 = str_replace('wallpaper', '', $query0);
        $query0 = str_replace('image', '', $query0);
        $query0 = str_replace('pic', '', $query0);
        $query0 = str_replace('picture', '', $query0);
        $query0 = str_replace('free', '', $query0);
        $query0 = str_replace('best', '', $query0);
        $query0 = str_replace('full', '', $query0);
        $query = "SELECT * FROM wallpaperaccess WHERE MATCH(tag, category) AGAINST('$query0') ORDER BY 1 DESC LIMIT $id, 5";
        $res = mysqli_query($connection, $query);
        $Allres = mysqli_fetch_all($res);
        $num = mysqli_num_rows($res);
        if($num == 0){
            return false;
        }
        // clearstatcache();
        $html = $showImgURL = '';
        for($i = 0; $i < $num; $i++){
            $userId = $Allres[$i][0];      
            $urlDis = $Allres[$i][4];
            $PAGEURL = $Allres[$i][7];
            $altName = str_replace( '-', ' ' , substr($PAGEURL, 3));
            $ImgNameDock = explode('.', $urlDis);
            $ImgNameDock01 = $ImgNameDock[0];
            if(file_exists('../webp-500/' . $ImgNameDock01 . '.webp') && file_exists('../uploads/' . $urlDis)){
                $tags = $Allres[$i][3];
                list($width, $height) = getimagesize('../uploads/' . $urlDis);
                $showImgURL = '/webp-500/'.$ImgNameDock01.'.webp';
                $lastid = $id + $i + 1;
                $sizeInByte = filesize('../uploads/'.$urlDis);
                $html .= '<li itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
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
        echo $html;
    } else if(isset($_GET['type']) && ($_GET['type'] == "category") && !empty($_GET['keywords'])){
        $id = $_GET['id'];
        $id = mysqli_real_escape_string($connection, $id);
        $id = trim($id);
        $id = htmlspecialchars($id);
        $category = htmlspecialchars($_GET['keywords']);
        $query = "SELECT * FROM wallpaperaccess where category='$category' ORDER BY 1 DESC LIMIT $id, 5";
        $res = mysqli_query($connection, $query);
        $num = mysqli_num_rows($res);
        if($num == 0){
            return false;
        }
        $FetchRes = mysqli_fetch_all($res);
        $html = "";
        for($i = 0; $i < $num; $i++){
            $userId = $FetchRes[$i][0];      
            $urlDis = $FetchRes[$i][4];
            $PAGEURL = $FetchRes[$i][7];
            $altName = str_replace( '-', ' ' , substr($PAGEURL, 3));
            $ImgNameDock = explode('.', $urlDis);
            $ImgNameDock01 = $ImgNameDock[0];
            $lastid = $id + 5;
            if(file_exists('../webp-500/' . $ImgNameDock01 . '.webp') && file_exists('../uploads/' . $urlDis)){
                $tags = $FetchRes[$i][3];
                list($width, $height) = getimagesize('../uploads/' . $urlDis);
                $showImgURL = '/webp-500/'.$ImgNameDock01.'.webp';
                $lastid = $id + $i + 1;
                $sizeInByte = filesize('../uploads/'.$urlDis);
                $html .= '<li itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
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
        echo $html ;
    } else if(isset($_GET['type']) && $_GET['type'] == "index"){
        $id = $_GET['id'];
        $id = mysqli_real_escape_string($connection, $id);
        $id = trim($id);
        $id = htmlspecialchars($id);
        $query = "SELECT * FROM wallpaperaccess ORDER BY 1 DESC LIMIT $id, 5";
        $res = mysqli_query($connection, $query);
        $num = mysqli_num_rows($res);
        if($num == 0){
            return false;
        }
        $FetchRes = mysqli_fetch_all($res);
        $html = "";
        $Arr_Img_data = "";
        for($i = 0; $i < $num; $i++){
            $userId = $FetchRes[$i][0];      
            $urlDis = $FetchRes[$i][4];
            $PAGEURL = $FetchRes[$i][7];
            $altName = str_replace( '-', ' ' , substr($PAGEURL, 3));
            $ImgNameDock = explode('.', $urlDis);
            $ImgNameDock01 = $ImgNameDock[0];
            $lastid = $id + 5;
            if(file_exists('../webp-500/' . $ImgNameDock01 . '.webp') && file_exists('../uploads/' . $urlDis)){
                $tags = $Allres[$i][3];
                list($width, $height) = getimagesize('../uploads/' . $urlDis);
                $showImgURL = '/webp-500/'.$ImgNameDock01.'.webp';
                $lastid = $id + $i + 1;
                $sizeInByte = filesize('../uploads/'.$urlDis);
                $html .= '<li itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
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
        echo $html ;
    }
}
?>