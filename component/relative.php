<div class="img-box">
    <?php

    include_once '../NDA.php';
    // $currentPageUrl = $_SERVER["REQUEST_URI"]; 
    // $last = explode('/', $currentPageUrl);
    $keywords = "";
    // $keywords = strtolower($last[2]);
    $keywords = $_GET['w'];
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
    $html_01_close = '</div><div class="ir-1-bb"><div class="ir-1-tb-loader" style="text-align : center; margin : auto;"><img width="50px" src="/assets/loader.gif" alt="loading animation gif" /></div><div class="hidden-end-checker-01" data-id="ir-1" style="visibility:hidden;">checker</div></div></div>';
    $html_02_close = '</div><div class="ir-2-bb"><div class="ir-2-tb-loader" style="text-align : center; margin : auto;"><img width="50px" src="/assets/loader.gif" alt="loading animation gif" /></div><div class="hidden-end-checker-02" data-id="ir-2" style="visibility:hidden;">checker</div></div></div>';
    $html_03_close = '</div><div class="ir-3-bb"><div class="ir-3-tb-loader" style="text-align : center; margin : auto;"><img width="50px" src="/assets/loader.gif" alt="loading animation gif" /></div><div class="hidden-end-checker-03" data-id="ir-3" style="visibility:hidden;">checker</div></div></div>';
    if (isset($_GET['w']) && $_GET['w'] != "" && $_GET['w'] != null) {

        $query = "SELECT * FROM wallpaperaccess WHERE MATCH(tag, category) AGAINST('$keywords') ORDER BY 1 DESC LIMIT 0, 15";
        $res = mysqli_query($connection, $query);
        $Allres = mysqli_fetch_all($res);
        $num = mysqli_num_rows($res);
        if ($num == 0) {
            echo "Sorry, We have no Wallpapers to show in this category.";
        }

        clearstatcache();
        for ($i = 0; $i < $num; $i++) {
            $userId = $Allres[$i][0];
            $urlDis = $Allres[$i][4];
            $PAGEURL = explode("w/", $Allres[$i][7])[1];
            $altName = str_replace('-', ' ', $PAGEURL);
            $PAGEURL = "/watch?w=" . $PAGEURL;
            $ImgNameDock = explode('.', $urlDis);
            $ImgNameDock01 = $ImgNameDock[0];
            $tags = $Allres[$i][3];
            $_img_dimension = $Allres[$i][10];
            $_img_size = $Allres[$i][11];

            if (file_exists('../uploads/' . $urlDis) && file_exists('../webp-500/' . $ImgNameDock01 . '.webp')) {
                list($width, $height) = getimagesize('../uploads/' . $urlDis);
                $sizeInByte = filesize('../uploads/' . $urlDis);
                $showImgURL = '/webp-500/' . $ImgNameDock01 . '.webp';
                if ($i >= 0 && $i <= 4) {
                    $lastid = 5;
                    $html_01 .= '<li itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                        <meta itemprop="fileFormat" content="image/jpeg">
                        <meta itemprop="keywords" content="' . $tags . '">
                        <meta itemprop="description" content="' . $altName . ". Original wallpaper Dimension is " . $_img_dimension . "px, file size is " . $_img_size . '.">
                        <meta itemprop="contentSize" content="' . $sizeInByte . '">
                        <div class="img-info-box">                        
                            <span itemprop="width" itemscope="" itemtype="http://schema.org/QuantitativeValue">
                                <span itemprop="value">' . $width . '</span>
                                <meta itemprop="unitText" content="px">
                            </span>x
                            <span itemprop="height" itemscope="" itemtype="http://schema.org/QuantitativeValue">
                                <span itemprop="value">' . $height . '</span>
                                <meta itemprop="unitText" content="px">
                            </span>
                        </div>
                        <figure>
                            <a itemprop="url" class="img-anchor" data-id=' . $lastid . ' href="' . $PAGEURL . '">
                                <img class="small-img lazyload" itemprop="contentUrl" alt="' . $altName . '" title="' . $altName . '" src="/assets/lazyload.webp" data-src="' . $showImgURL . '" data-id="' . $userId . '">
                            </a>
                            <figcaption itemprop="caption">' . $altName . '</figcaption>
                        </figure>
                    </li>';
                } else if ($i >= 5 && $i <= 9) {
                    $lastid = 10;
                    $html_02 .= '<li itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                    <meta itemprop="fileFormat" content="image/jpeg">
                    <meta itemprop="keywords" content="' . $tags . '">
                    <meta itemprop="description" content="' . $altName . ". Original wallpaper Dimension is " . $_img_dimension . "px, file size is " . $_img_size . '.">
                    <meta itemprop="contentSize" content="' . $sizeInByte . '">
                    <div class="img-info-box">                        
                        <span itemprop="width" itemscope="" itemtype="http://schema.org/QuantitativeValue">
                            <span itemprop="value">' . $width . '</span>
                            <meta itemprop="unitText" content="px">
                        </span>x
                        <span itemprop="height" itemscope="" itemtype="http://schema.org/QuantitativeValue">
                            <span itemprop="value">' . $height . '</span>
                            <meta itemprop="unitText" content="px">
                        </span>
                    </div>
                    <figure>
                        <a itemprop="url" class="img-anchor" data-id=' . $lastid . ' href="' . $PAGEURL . '">
                            <img class="small-img lazyload" itemprop="contentUrl" alt="' . $altName . '" title="' . $altName . '" src="/assets/lazyload.webp" data-src="' . $showImgURL . '" data-id="' . $userId . '">
                        </a>
                        <figcaption itemprop="caption">' . $altName . '</figcaption>
                    </figure>
                </li>';
                } else if ($i >= 10 && $i <= 14) {
                    $lastid = 15;
                    $html_03 .= '<li itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                    <meta itemprop="fileFormat" content="image/jpeg">
                    <meta itemprop="keywords" content="' . $tags . '">
                    <meta itemprop="description" content="' . $altName . ". Original wallpaper Dimension is " . $_img_dimension . "px, file size is " . $_img_size . '.">
                    <meta itemprop="contentSize" content="' . $sizeInByte . '">
                    <div class="img-info-box">                        
                        <span itemprop="width" itemscope="" itemtype="http://schema.org/QuantitativeValue">
                            <span itemprop="value">' . $width . '</span>
                            <meta itemprop="unitText" content="px">
                        </span>x
                        <span itemprop="height" itemscope="" itemtype="http://schema.org/QuantitativeValue">
                            <span itemprop="value">' . $height . '</span>
                            <meta itemprop="unitText" content="px">
                        </span>
                    </div>
                    <figure>
                        <a itemprop="url" class="img-anchor" data-id=' . $lastid . ' href="' . $PAGEURL . '">
                            <img class="small-img lazyload" itemprop="contentUrl" alt="' . $altName . '" title="' . $altName . '" src="/assets/lazyload.webp" data-src="' . $showImgURL . '" data-id="' . $userId . '">
                        </a>
                        <figcaption itemprop="caption">' . $altName . '</figcaption>
                    </figure>
                </li>';
                }
            }
        }
        echo $html_01 . $html_01_close . $html_02 . $html_02_close . $html_03 . $html_03_close;
    }
    ?>
</div>