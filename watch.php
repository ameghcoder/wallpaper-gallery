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

        // Tag, Image_url, Page_url, Description, Title, Dimension, Size
        $_temp_title = explode("w/", $_row_data[7])[1];
        $_title = str_replace("-", " ", $_temp_title);

        $_img_dimension = $_row_data[10];
        $_img_size = $_row_data[11];

        $_id = $_row_data[0];
        $_tag = $_row_data[3];

        $_img_url = $_SITE_URL . "uploads/" . $_row_data[4];

        $_img_url_webp = explode(".", $_row_data[4])[0];
        $_img_url_webp = $_SITE_URL . "webp-1000/" . $_img_url_webp . ".webp";

        $_page_url = $_SITE_URL . "watch?w=" . $_GET['w'];

        $_description = $_title . ". Original wallpaper Dimension is " . $_img_dimension . "px, file size is " . $_img_size . ".";

        // create HTML for Tag
        $_tag_array = explode(",", $_tag);

        for ($i = 0; $i < count($_tag_array); $i++) {
            $_tag_html .= '<li><a rel="tag" href="/search?wallpaper=' . $_tag_array[$i] . '">' . $_tag_array[$i] . '</a></li>';
        }
    } else {
        echo "Failed DB";
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php if (!empty($_tag)) {
        echo $_tag;
    } ?>">
    <meta name="description" content="<?php if (!empty($_description)) {
        echo $_description;
    } ?>">
    <meta itemprop="name" content="<?php if (!empty($_title)) {
        echo $_title;
    } ?>">
    <meta itemprop="description" content="<?php if (!empty($_description)) {
        echo $_description;
    } ?>">
    <meta itemprop="image" content="<?php if (!empty($_img_url)) {
        echo $_img_url;
    } ?>">
    <meta property="og:title" content="<?php if (!empty($_title)) {
        echo $_title;
    } ?>">
    <meta property="og:url" content="<?php if (!empty($_page_url)) {
        echo $_page_url;
    } ?>">
    <meta property="og:description" content="<?php if (!empty($_description)) {
        echo $_description;
    } ?>">
    <meta property="og:image" content="<?php if (!empty($_img_url)) {
        echo $_img_url;
    } ?>" />
    <meta property="og:image:secure_url" content="<?php if (!empty($_img_url)) {
        echo $_img_url;
    } ?>" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:alt" content="<?php if (!empty($_title)) {
        echo $_title;
    } ?>" />
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/component/img_link.html'); ?>
    <!-- Image Link -->
    <link rel="canonical" href="<?php if (!empty($_page_url)) {
        echo $_page_url;
    } ?>" />
    <title>
        <?php if (!empty($_title)) {
            echo $_title;
        } ?>
    </title>
</head>

<body>
    <div class="page-container">
        <div class="page-container-inside">
            <section class="page-section-left">

                <?php include($_SERVER['DOCUMENT_ROOT'] . '/component/header.html'); ?>
            </section>
            <section class="page-section-right">
                <div class="page-section-right-inside">
                    <div class="psri-content">
                        <div class="psric-top">
                            <div class="heading-and-search-box">
                                <h1>
                                    <?php if (!empty($_title)) {
                                        echo $_title;
                                    } ?>
                                </h1>
                            </div>
                            <main class="main-content">
                                <section class="img-preview"><input value="<?php if (!empty($_img_url)) {
                                    echo $_img_url;
                                } ?>" hidden id="img-heading" />
                                    <div class="ip-top">
                                        <div class="ipt-left">
                                            <div class="img-box"><img class="preview-image lazyload landscape" data-src="<?php if (!empty($_img_url_webp)) {
                                                echo $_img_url_webp;
                                            } ?>" src="/assets/lazyloadimg.webp" alt="<?php if (!empty($_title)) {
                                                 echo $_title;
                                             } ?>" title="<?php if (!empty($_title)) {
                                                  echo $_title;
                                              } ?>"></div>
                                            <div class="ip-icon-box">
                                                <div class="ipib-tags">
                                                    <ul>
                                                        <?php if (!empty($_tag_html)) {
                                                            echo $_tag_html;
                                                        } ?>
                                                    </ul>
                                                </div>
                                                <div
                                                    style="width:100%;display:flex;flex-wrap:wrap;gap:5px;justify-content:center;">
                                                    <button
                                                        style="border-radius:5px;padding:10px;font-size:20px;background:var(--border);border:none;width:98%;max-width:400px;margin:auto;"
                                                        type="button" class="img-share-btn"
                                                        title="Click or Press 's' for share">Share</button><button
                                                        style="border-radius:5px;padding:10px;font-size:20px;background:var(--border);border:none;width:98%;max-width:400px;margin:auto;"
                                                        type="button" id="preview-img"
                                                        title="Click or Press 'f' for preview">Preview</button>
                                                </div><a
                                                    style="border-radius:5px;padding:10px;font-size:20px;background:var(--border);border:none;width:100%;text-decoration:none;margin:10px 0px;display:inline-block;text-align:center;"
                                                    href="<?php if (!empty($_img_url)) {
                                                        echo $_img_url;
                                                    } ?>" id="img-download-btn" download>Download</a>

                                                <div class="ipib-view-reso-download">
                                                    <span data-id="<?php if (!empty($_id)) {
                                                        echo $_id;
                                                    } ?>" id="data-id-of-img" style="display : none" hidden>Image
                                                        ID</span>

                                                    <span class="ipib-reso"><span class="ipib-txt">Resolution</span>
                                                        <span class="digits">
                                                            <?php if (!empty($_img_dimension)) {
                                                                echo $_img_dimension;
                                                            } ?>
                                                        </span></span>

                                                    <div></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ipt-right">
                                            <style>
                                                .ip-flex-category::-webkit-scrollbar {
                                                    width: 2px
                                                }

                                                .ip-flex-category::-webkit-scrollbar-track {
                                                    background: #f1f1f1
                                                }

                                                .ip-flex-category::-webkit-scrollbar-thumb {
                                                    background: #888
                                                }

                                                .ip-flex-category::-webkit-scrollbar-thumb:hover {
                                                    background: #555
                                                }

                                                @media(max-width : 900px) {
                                                    .hide-below-900px {
                                                        display: none;
                                                    }
                                                }
                                            </style>
                                            <div class="ip-flex-category"
                                                style="overflow-x:hidden !important;width:100% !important;padding:0px !important;margin:0px !important;">
                                                <strong>Follow us</strong>
                                                <div>
                                                    <a style="margin:0px 5px;"
                                                        href="https://www.facebook.com/wallpaperaccess"
                                                        rel="external"><i class="nav-logo-css facebook-icon"></i></a>
                                                    <a style="margin:0px 5px;" href="https://twitter.com/Walls_Access"
                                                        rel="external"><i class="nav-logo-css twitter-icon"></i></a>
                                                    <a style="margin:0px 5px;"
                                                        href="https://www.instagram.com/wallpaper_access1/"
                                                        rel="external"><i class="nav-logo-css instagram-icon"></i></a>
                                                </div>
                                                <!-- <div class="ipfc-box" style="background: #151210;">-->
                                                <!--    <a href="https://aiwallpaper.online">Best Ai & Android wallpaper</a>-->
                                                <!--</div> -->
                                                <div class="ipfc-box"
                                                    style="background: url('../webp-500/Tesla-2022-Model-Red-Car-Wallpaper-4k.webp');">
                                                    <a href="https://gallery.coastweb.online/search?wallpaper=tesla">Tesla
                                                        Wallpapers</a>
                                                </div>
                                                <div class="ipfc-box"
                                                    style="background: url('/webp-500/Kim-taehyung-best-android-wallpaper.webp');">
                                                    <a href="https://gallery.coastweb.online/search?wallpaper=android">Android
                                                        Wallpapers</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <div class="share-box">
                                    <div class="share-box-inside"><button
                                            onclick="document.querySelector('.share-box').classList.add('zoom-out');document.querySelector('.share-box').classList.remove('zoom-in');"
                                            type="button"
                                            style="cursor : pointer; background: red; padding: 5px 10px; color: white; border: none; outline: none; font-weight: bolder; font-size: 15px;">&#9587;</button>
                                        <div class="sbi-top"><input type="text" class="pageURL" value="<?php if (!empty($_page_url)) {
                                            echo $_page_url;
                                        } ?>" disabled>
                                        </div>
                                        <div class="sbi-btm"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php if (!empty($_page_url)) {
                                            echo $_page_url;
                                        } ?>" id="fb-share" role="button" style="background: #3b5998;">Facebook</a><a
                                                href="https://twitter.com/share?url=<?php if (!empty($_page_url)) {
                                                    echo $_page_url;
                                                } ?>" id="tw-share" role="button"
                                                style="background: #00acee;">Tweet</a><a href="https://api.whatsapp.com/send?text=<?php if (!empty($_page_url)) {
                                                    echo $_page_url;
                                                } ?>" id="wh-share" role="button"
                                                style="background: #25D366;">Whatsapp</a><button type="button"
                                                class="copy-link" style="border: none; outline: none;">Copy
                                                Link</button></div>
                                    </div>
                                </div>
                                <section class="img-section">
                                    <div class="img-section-inside">
                                        <?php include($_SERVER['DOCUMENT_ROOT'] . '/component/relative.php'); ?>
                                    </div>
                                </section>
                            </main>
                        </div>
                        <div class="psric-btm">

                            <?php include($_SERVER['DOCUMENT_ROOT'] . '/component/footer.html'); ?>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>

</html>