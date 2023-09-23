<?php

include 'NDA.php';

if(isset($_GET['type'])){

    $type = mysqli_real_escape_string($connection, $_GET['type']);
    if(!isset($_GET['count'])){
        $selectquery = "SELECT * FROM wallpaperaccess where category='$type' ORDER BY 1 DESC";
    } else if($_GET['count'] == 'all'){
        $selectquery = "SELECT * FROM wallpaperaccess where category='$type' ORDER BY 1 DESC";
    } else{
        $wallNum = $_GET['count'];
        $selectquery = "SELECT * FROM wallpaperaccess where category='$type' ORDER BY 1 DESC LIMIT $wallNum, 20";
    }
    $res = mysqli_query($connection,$selectquery);
    $num = mysqli_num_rows($res);
    $res = mysqli_fetch_all($res);
    $html = array();
    for($i = 0; $i < $num; $i++){
        $userId = $res[$i][0];      
        $urlDis = $res[$i][4];
        $PAGEURL = $res[$i][10];

        $altName = str_replace( '-', ' ' , substr($PAGEURL, 3));
        list($width, $height) = getimagesize('uploads/' . $urlDis); 

        if(file_exists( './t/' . $urlDis)){
            $imgURL =  '/t/' . $urlDis;
        } else{
            $imgURL =  '/uploads/' . $urlDis;
        }
        
        echo    '<div class="img-wrapper">
                    <div class="img-name">' . $altName . '</div>
                    <div class="img-reso">' . $width . '×' . $height . '</div>
                    <a href="' . $PAGEURL .'">
                        <img class="small-img lazyload" itemprop="thumbnail" itemtype="https://schema.org/ImageObject" itemscope data-src="' . $imgURL . '" src="/assets/lazyload.webp" alt="' . $altName . '">
                    </a>
                </div>';
    }
} else if(isset($_GET['most'])){
    $most_cat = "";
    if($_GET['most'] == 'like'){
        $most_cat = 'LikeCount';
    } else if($_GET['most'] == 'view'){
        $most_cat = 'ViewCount';
    } else if($_GET['most'] == 'share'){
        $most_cat = 'ShareCount';
    } else if($_GET['most'] == 'download'){
        $most_cat = 'DownCount';
    }

    $selectquery = "SELECT * FROM wallpaperaccess ORDER BY $most_cat DESC LIMIT 0, 20";
    $res = mysqli_query($connection,$selectquery);
    $num = mysqli_num_rows($res);
    $res = mysqli_fetch_all($res);
    $html = array();
    for($i = 0; $i < $num; $i++){
        $userId = $res[$i][0];      
        $urlDis = $res[$i][4];
        $PAGEURL = $res[$i][10];

        $altName = str_replace( '-', ' ' , substr($PAGEURL, 3));
        list($width, $height) = getimagesize('uploads/' . $urlDis); 

        if(file_exists( './t/' . $urlDis)){
            $imgURL =  '/t/' . $urlDis;
        } else{
            $imgURL =  '/uploads/' . $urlDis;
        }

        echo    '<div class="img-wrapper">
                    <div class="img-name">' . $altName . '</div>
                    <div class="img-reso">' . $width . '×' . $height . '</div>
                    <a href="' . $PAGEURL .'">
                        <img class="small-img lazyload" itemprop="thumbnail" itemtype="https://schema.org/ImageObject" itemscope data-src="' . $imgURL . '" src="/assets/lazyload.webp" alt="' . $altName . '">
                    </a>
                </div>';
    }
} else if(isset($_GET['start'])){
    $start = mysqli_real_escape_string($connection, $_GET['start']);
    $selectquery = "SELECT * FROM wallpaperaccess ORDER BY 1 DESC LIMIT $start, 20";
    $res = mysqli_query($connection,$selectquery);
    $num = mysqli_num_rows($res);
    $res = mysqli_fetch_all($res);
    $html = array();
    for($i = 0; $i < $num; $i++){
        $userId = $res[$i][0];      
        $urlDis = $res[$i][4];
        $PAGEURL = $res[$i][10];

        $altName = str_replace( '-', ' ' , substr($PAGEURL, 3));
        list($width, $height) = getimagesize('uploads/' . $urlDis); 

        if(file_exists( './t/' . $urlDis)){
            $imgURL =  '/t/' . $urlDis;
        } else{
            $imgURL =  '/uploads/' . $urlDis;
        }
        echo    '<div class="img-wrapper">
                    <div class="img-name">' . $altName . '</div>
                    <div class="img-reso">' . $width . '×' . $height . '</div>
                    <a href="' . $PAGEURL .'">
                        <img class="small-img lazyload" itemprop="thumbnail" itemtype="https://schema.org/ImageObject" itemscope data-src="' . $imgURL . '" src="/assets/lazyload.webp" alt="' . $altName . '">
                    </a>
                </div>';
    }
} else if(isset($_GET['numberOf'])){
    if($_GET['numberOf'] == 'all'){
        $selectquery = "SELECT * FROM wallpaperaccess";
    }else if( $_GET['numberOf'] == '3d' || 
        $_GET['numberOf'] == '4k' || 
        $_GET['numberOf'] == 'actor' || 
        $_GET['numberOf'] == 'abstruct' || 
        $_GET['numberOf'] == 'actress' || 
        $_GET['numberOf'] == 'android' || 
        $_GET['numberOf'] == 'art' || 
        $_GET['numberOf'] == 'animal' || 
        $_GET['numberOf'] == 'anime' || 
        $_GET['numberOf'] == 'avengers' || 
        $_GET['numberOf'] == 'baby' || 
        $_GET['numberOf'] == 'building' || 
        $_GET['numberOf'] == 'bike' || 
        $_GET['numberOf'] == 'bts' || 
        $_GET['numberOf'] == 'cars' || 
        $_GET['numberOf'] == 'cartoon' || 
        $_GET['numberOf'] == 'computer' || 
        $_GET['numberOf'] == 'city' || 
        $_GET['numberOf'] == 'gods' || 
        $_GET['numberOf'] == 'galaxy' || 
        $_GET['numberOf'] == 'gym' || 
        $_GET['numberOf'] == 'gun' || 
        $_GET['numberOf'] == 'gaming' || 
        $_GET['numberOf'] == 'house' || 
        $_GET['numberOf'] == 'mountain' || 
        $_GET['numberOf'] == 'nature' || 
        $_GET['numberOf'] == 'planet'
        ){
        $cat_type = $_GET['numberOf'];
        $selectquery = "SELECT * FROM wallpaperaccess where category='$cat_type'";
    } else if(!empty($_GET['numberOf'])){
        $selectquery = "SELECT * FROM wallpaperaccess";
    }

    $res = mysqli_query($connection,$selectquery);
    $num = mysqli_num_rows($res);
    echo $num;
}
?>
