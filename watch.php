<?php

include "./NDA.php";

$_SITE_URL = "https://gallery.coastweb.online/";

$_title = $_description = $_id = $_tag = $_img_url_webp = $_img_url = $_page_url = $_img_size = $_img_dimension = '';
$_tag_html = '';

if (isset($_GET['w']) && $_GET['w'] != "" && $_GET['w'] != null) {
    $_w_para = "/w/" . $_GET['w'];

    $_query = "SELECT * FROM wallpaperaccess WHERE img_page='$_w_para'";
    $_res = mysqli_query($connection, $_query);
    if ($_res) {
        $_row_data = mysqli_fetch_array($_res);

        print_r($_row_data);

        // Tag, Image_url, Page_url, Description, Title, Dimension, Size
        // $_temp_title = explode("w/", $_row_data[7])[1];
        // $_title = str_replace("-", " ", $_temp_title);

        // $_img_dimension = $_row_data[10];
        // $_img_size = $_row_data[11];

        // $_id = $_row_data[0];
        // $_tag = $_row_data[3];

        // $_img_url = $_SITE_URL . "uploads/" . $_row_data[4];

        // $_img_url_webp = explode(".", $_row_data[4])[0];
        // $_img_url_webp = $_SITE_URL . "webp-1000/" . $_img_url_webp . ".webp";

        // $_page_url = $_SITE_URL . "watch?w=" . $_GET['w'];

        // $_description = $_title . ". Original wallpaper Dimension is " . $_img_dimension . "px, file size is " . $_img_size . ".";

        // // create HTML for Tag
        // $_tag_array = explode(",", $_tag);

        // for ($i = 0; $i < $_tag_array; $i++) {
        //     $_tag_html .= '<li><a rel="tag" href="/search?wallpaper=' . $_tag_arry[$i] . '" rel="tag">' . $_tag_arry[$i] . '</a></li>';
        // }

        // echo $_title;
        // echo "<br>";
        // echo $_tag;
        // echo "<br>";
        // echo $_img_url;
        // echo "<br>";
        // echo $_img_url_webp;
        // echo "<br>";
        // echo $_page_url;
        // echo "<br>";
        // echo $_description;
        // echo "<br>";
        // echo $_tag_html;
        // echo "<br>";
    } else {
        echo "Failed DB";
    }

}
?>