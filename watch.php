<?php

include "../NDA.php";

if (isset($_GET['w']) && $_GET['w'] != "" && $_GET['w'] != null) {
    $_w_para = "/w/" . $_GET['w'];

    $_query = "SELECT * FROM wallpaperaccess WHERE img_page='/w/Mazda-Car-Side-View-2k-Wallpaper'";
    $_res = mysqli_query($connection, $_query);
    if ($_res) {
        $_row_data = mysqli_fetch_array($_res);
        $_template_data = file_get_contents("./template/Wallpaper_Preview.php");

        // Tag, Image_url, Page_url, Description, Title, Dimension, Size
        $_img_id = $_row_data[0][0];
        $_img_tag = $_row_data[0][1];
        $_img_url = $_row_data[0][1];
        $_page_url = $_row_data[0][1];
        $_img_title = $_row_data[0][1];
        $_img_dimension = $_row_data[0][1];
        $_img_size = $_row_data[0][1];
        $_img_description = $_img_title . ". Original wallpaper Dimension is " . $_img_dimension . "px, file size is " . $_img_size . ".";

        // create HTML for Tag
        $_tag_array = explode(",", $_img_tag);
        $_tag_html = "";
        for ($i = 0; $i < $_tag_array; $i++) {
            $_tag_html .= '<li><a rel="tag" href="/search?wallpaper=' . $_tag_arry[$i] . '" rel="tag">' . $_tag_arry[$i] . '</a></li>';
        }

        $_template_data = str_replace("{{TITLE}}", $_img_title, $_template_data);
        $_template_data = str_replace("{{TAG}}", $_img_tag, $_template_data);
        $_template_data = str_replace("{{IMAGE_URL}}", $_img_url, $_template_data);
        $_template_data = str_replace("{{PAGE_URL}}", $_page_url, $_template_data);
        $_template_data = str_replace("{{DESCRIPTION}}", $_img_description, $_template_data);
        $_template_data = str_replace("{{TAG_HTML}}", $_tag_html, $_template_data);
        $_template_data = str_replace("{{DIMENSION}}", $_img_dimension, $_template_data);
        $_template_data = str_replace("{{IMG_ID}}", $_img_id, $_template_data);

        echo $_template_data;
    } else {
        echo "Failed DB";
    }

}
?>