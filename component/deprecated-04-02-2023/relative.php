<div class="img-box">
<?php 

include_once '../NDA.php';
    $currentPageUrl = $_SERVER["REQUEST_URI"]; 
    $last = explode('/', $currentPageUrl);
    $keywords = "";
    $keywords = strtolower($last[2]);
    $keywords = str_replace(".php", "", $keywords);
    $keywords = str_replace("-", " ", $keywords);
    $keywords = str_replace("/", "", $keywords);
    $keywords = str_replace("+", " ", $keywords);
    $keywords = str_replace("image", "", $keywords);
    $keywords = str_replace("picture", "", $keywords);
    $keywords = str_replace("free", "", $keywords);
    $keywords = str_replace("best", "", $keywords);
    $keywords = str_replace("full", "", $keywords);
    $keywords = str_replace("wallpaper", "", $keywords);
    $keywords = str_replace("hd", "", $keywords);
    $html_01 = '<div class="img-row-i1"><div class="ir-1-tb">';
    $html_02 = '<div class="img-row-i2"><div class="ir-2-tb">';
    $html_03 = '<div class="img-row-i3"><div class="ir-3-tb">';
    $html_01_close = '</div><div class="ir-1-bb"><div class="ir-1-tb-loader" style="text-align : center; margin : auto;"><img width="50px" src="/assets/loader.gif" /></div><div class="hidden-end-checker-01" data-id="ir-1" style="visibility:hidden;">checker</div></div></div>';
    $html_02_close = '</div><div class="ir-2-bb"><div class="ir-2-tb-loader" style="text-align : center; margin : auto;"><img width="50px" src="/assets/loader.gif" /></div><div class="hidden-end-checker-02" data-id="ir-2" style="visibility:hidden;">checker</div></div></div>';
    $html_03_close = '</div><div class="ir-3-bb"><div class="ir-3-tb-loader" style="text-align : center; margin : auto;"><img width="50px" src="/assets/loader.gif" /></div><div class="hidden-end-checker-03" data-id="ir-3" style="visibility:hidden;">checker</div></div></div>';
    if($last[1] == "w"){
        
        $query = "SELECT * FROM wallpaperaccess WHERE MATCH(tag, category) AGAINST('$keywords') ORDER BY 1 DESC LIMIT 0, 15";
        $res = mysqli_query($connection, $query);
        $Allres = mysqli_fetch_all($res);
        $num = mysqli_num_rows($res);
        if($num == 0){
            echo "Sorry, We have no Wallpapers to show in this category.";
        }

        clearstatcache();
        for($i = 0; $i < $num; $i++){
            $userId = $Allres[$i][0];      
            $urlDis = $Allres[$i][4];
            $PAGEURL = $Allres[$i][7];
            $altName = str_replace( '-', ' ' , substr($PAGEURL, 3));
            $ImgNameDock = explode('.', $urlDis);
            $ImgNameDock01 = $ImgNameDock[0];
            if(file_exists('../uploads/' . $urlDis) && file_exists('../webp-500/'.$ImgNameDock01.'.webp')){
                list($width, $height) = getimagesize('../uploads/' . $urlDis);
                $showImgURL = '/webp-500/'.$ImgNameDock01.'.webp';
                if($i >= 0 && $i <= 4){
                    $lastid = $i + 1;
                    $html_01 .= '<a class="img-anchor" data-id='.$lastid.' href="'.$PAGEURL.'" itemprop="url">
                    <div class="img-info-box">
                    <strong class="img-name">'.$altName.'</strong>
                    <span class="reso-name">
                    <span class="reso-name-width">'.$width.'</span>
                    <span role="separator">×</span>
                    <span class="reso-name-height">'.$height.'</span>
                    </span>
                    </div>
                    <img class="small-img lazyload" itemprop="thumbnail"
                    src="/assets/lazyload.webp" data-src="'.$showImgURL.'" alt="'.$altName.'" data-width="'.$width.'" data-height="'.$height.'" data-id="'.$userId.'">
                    </a>';
                } else if($i >= 5 && $i <= 9){
                    $lastid = $i + 1;
                    $html_02 .= '<a class="img-anchor" data-id='.$lastid.' href="'.$PAGEURL.'" itemprop="url">
                    <div class="img-info-box">
                    <strong class="img-name">'.$altName.'</strong>
                    <span class="reso-name">
                    <span class="reso-name-width">'.$width.'</span>
                    <span role="separator">×</span>
                    <span class="reso-name-height">'.$height.'</span>
                    </span>
                    </div>
                    <img class="small-img lazyload" itemprop="thumbnail"
                    src="/assets/lazyload.webp" data-src="'.$showImgURL.'" alt="'.$altName.'" data-width="'.$width.'" data-height="'.$height.'" data-id="'.$userId.'">
                    </a>';  
                } else if($i >= 10 && $i <= 14){
                    $lastid = $i + 1;
                    $html_03 .= '<a class="img-anchor" data-id='.$lastid.' href="'.$PAGEURL.'" itemprop="url">
                    <div class="img-info-box">
                    <strong class="img-name">'.$altName.'</strong>
                    <span class="reso-name">
                    <span class="reso-name-width">'.$width.'</span>
                    <span role="separator">×</span>
                    <span class="reso-name-height">'.$height.'</span>
                    </span>
                    </div>
                    <img class="small-img lazyload" itemprop="thumbnail"
                    src="/assets/lazyload.webp" data-src="'.$showImgURL.'" alt="'.$altName.'" data-width="'.$width.'" data-height="'.$height.'" data-id="'.$userId.'">
                    </a>';
                }
            }
        }
        echo $html_01 . $html_01_close . $html_02 . $html_02_close . $html_03 . $html_03_close;
    }
?>
</div>