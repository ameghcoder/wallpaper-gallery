<?php

include "./NDA.php";

$_SITE_URL = "https://gallery.coastweb.online/";

$_title = $_description = $_id = $_tag = $_img_url_webp = $_img_url = $_page_url = $_img_size = $_img_dimension = '';
$_tag_html = '';

if (isset($_GET['w']) && $_GET['w'] != "" && $_GET['w'] != null) {
    $_w_para = "/w/" . $_GET['w'];

    $_query = "SELECT * FROM wallpaperaccess WHERE img_page='$_w_para'";
    $_res = mysqli_query($connection, $_query);
    $_row_data = mysqli_fetch_array($_res);
    echo "<h2>Details</h2><br>";
    print_r($_row_data);

}
?>