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

        print_r($_row_data);
        echo "<br>";
        echo $_title;

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
    <!-- Image Link -->
    <meta name="robots" content="max-image-preview:large">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#202020">
    <meta name="apple-mobile-web-app-title" content="Wallpaper Access">
    <meta name="application-name" content="Wallpaper Access">
    <meta name="msapplication-TileColor" content="#202020">
    <meta name="theme-color" content="#202020">
    <link async rel="stylesheet" type="text/css" href="/style/style_v04.css">
    <link async rel="stylesheet" type="text/css" href="/style/style_preview_min_v03.css">
    <link async rel="stylesheet" type="text/css" href="/style/style_three_line_col_v04.css">

    <style>
        div:empty {
            display: none;
        }

        .ipib-view,
        .ipib-download {
            display: none !important;
        }

        body {
            overflow-x: hidden !important;
        }
    </style>
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

                <header>
                    <div class="hamburger">
                        <form action="/search" method="get" enctype="text/plain">
                            <input title="Enter your wallpaper name" type="search" name="wallpaper" id="wall_search_per"
                                placeholder="Search your wallpaper">
                            <button type="submit" role="button" title="Search Wallpaper">
                                <i class="image-search-icon nav-logo-css" title="Image Search Icon"></i>
                            </button>
                        </form>
                        <span class="hamburger-icon"
                            onclick="document.querySelector('.page-section-left').classList.toggle('left-0px');document.querySelector('.hamburger').classList.toggle('back-fill');document.querySelector('.side-menu-container').classList.remove('left-70px');document.querySelector('.hamburger').classList.toggle('hamburger-responsive-width')">
                            <span class="hi-f"></span>
                            <span class="hi-m"></span>
                            <span class="hi-l"></span>
                        </span>
                    </div>
                    <div class="page-left-side-box">
                        <div class="plsb-inside">
                            <nav>
                                <a href="/" title="wallpaper-access.com"
                                    style="margin-right: 10px !important; background: none !important; opacity: 1 !important;">
                                    <i class="web-logo" title="website logo"></i>
                                </a>
                                <div class="side-menu">
                                    <button title="category" class="side-menu-btn clear-btn-css"
                                        onclick="document.querySelector('.side-menu-container').classList.toggle('left-70px')">
                                        <i class="nav-logo-css category-icon" title="category icon"></i>
                                    </button>
                                    <div class="side-menu-container">
                                        <div class="side-menu-container-inside">
                                            <strong>Category</strong>
                                            <div class="smci-grid-box">
                                                <a itemprop="item" href="/category/ai">🤖 AI Created</a>
                                                <a itemprop="item" href="/category/3d">↔️ 3D</a>
                                                <a itemprop="item" href="/category/4k">↔️ 4K</a>
                                                <a itemprop="item" href="/category/abstruct">🌀 Abstruct</a>
                                                <a itemprop="item" href="/category/actor">👥 Actor</a>
                                                <a itemprop="item" href="/category/actress">👥 Actress</a>
                                                <a itemprop="item" href="/category/android">📱 Android</a>
                                                <a itemprop="item" href="/category/art">🎨 Art</a>
                                                <a itemprop="item" href="/category/animal">🐶 Animal</a>
                                                <a itemprop="item" href="/category/anime">💥 Anime</a>
                                                <a itemprop="item" href="/category/avengers">🦸 Avengers</a>
                                                <a itemprop="item" href="/category/baby">👶 Baby</a>
                                                <a itemprop="item" href="/category/building">🏢 Building</a>
                                                <a itemprop="item" href="/category/bike">🛵 Bike</a>
                                                <a itemprop="item" href="/category/bts">💜 BTS Army</a>
                                                <a itemprop="item" href="/category/cars">🚗 Cars</a>
                                                <a itemprop="item" href="/category/cartoon">🐻 Cartoon</a>
                                                <a itemprop="item" href="/category/christmas">🎄 Christmas</a>
                                                <a itemprop="item" href="/category/city">🌆 City</a>
                                                <a itemprop="item" href="/category/computer">🖥️️ Computer</a>
                                                <a itemprop="item" href="/category/freefire">🎮 FreeFire</a>
                                                <a itemprop="item" href="/category/gods">🔱 Gods</a>
                                                <a itemprop="item" href="/category/galaxy">🌌 Galaxy</a>
                                                <a itemprop="item" href="/category/gym">🏋️ Gym</a>
                                                <a itemprop="item" href="/category/gun">🔫 Gun</a>
                                                <a itemprop="item" href="/category/gaming">🎮 Gaming</a>
                                                <a itemprop="item" href="/category/house">🏠 House</a>
                                                <a itemprop="item" href="/category/mountain">⛰️ Mountain</a>
                                                <a itemprop="item" href="/category/nature">🌳 Nature</a>
                                                <a itemprop="item" href="/search?wallpaper=year">New Year</a>
                                                <a itemprop="item" href="/category/planet">🌹 Planet</a>
                                                <a itemprop="item" href="/search?wallpaper=texture">Texture</a>
                                                <a itemprop="item" href="/search?wallpaper=villain">🦹 Villain</a>
                                                <a itemprop="item" href="/category/webseries">🎥 Web Series</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a title="Contact" href="/contact"><i class="nav-logo-css contact-icon"
                                        title="contact icon"></i></a>
                                <a title="About" href="/about"><i class="nav-logo-css about-icon"
                                        title="about icon"></i></a>
                                <a title="Help" href="/personaluseonly"><i class="nav-logo-css help-icon"
                                        title="help icon"></i></a>
                                <button class="toggle-btn" style="border: none" title="Change Theme Color"
                                    type="button"></button>
                                <strong style="writing-mode: vertical-rl;transform: rotate(180deg); cursor: pointer;"
                                    class="toggle-btn-text">Dark</strong>
                            </nav>
                        </div>
                    </div>
                </header>
                <script>
                    let toggleBtn = document.querySelector("button.toggle-btn"), navLogoCss = document.querySelectorAll(".nav-logo-css"), toggleBtnText = document.querySelector(".toggle-btn-text"), theme_ = !0; function toggleMode() { document.querySelector("body").classList.toggle("light"), toggleBtn.classList.toggle("toggle-btn-light"); for (let t = 0; t < navLogoCss.length; t++)navLogoCss[t].classList.toggle("nav-logo-css-light"); theme_ = theme_ ? (localStorage.setItem("theme", "light"), !(document.querySelector(".toggle-btn-text").innerHTML = "Light")) : (localStorage.setItem("theme", "dark"), document.querySelector(".toggle-btn-text").innerHTML = "Dark", !0) } function checkLS() { if ("light" == localStorage.getItem("theme")) { document.querySelector("body").classList.add("light"), toggleBtn.classList.add("toggle-btn-light"); for (let t = 0; t < navLogoCss.length; t++)navLogoCss[t].classList.add("nav-logo-css-light"); document.querySelector(".toggle-btn-text").innerHTML = "Light", theme_ = !1 } else { document.querySelector("body").classList.remove("light"), toggleBtn.classList.remove("toggle-btn-light"); for (let t = 0; t < navLogoCss.length; t++)navLogoCss[t].classList.remove("nav-logo-css-light"); document.querySelector(".toggle-btn-text").innerHTML = "Dark" } } checkLS(), toggleBtn.addEventListener("click", toggleMode), toggleBtnText.addEventListener("click", toggleMode);
                </script>
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
                                                        {{TAG_HTML}}
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
                                                <!--<div class="ipfc-box" style="background: #151210;">-->
                                                <!--    <a href="https://aiwallpaper.online">Best Ai & Android wallpaper</a>-->
                                                <!--</div>-->
                                                <div class="ipfc-box"
                                                    style="background: url('../webp-500/Tesla-2022-Model-Red-Car-Wallpaper-4k.webp');">
                                                    <a href="https://www.wallpaper-access.com/search?wallpaper=tesla">Tesla
                                                        Wallpapers</a>
                                                </div>
                                                <div class="ipfc-box"
                                                    style="background: url('/webp-500/Kim-taehyung-best-android-wallpaper.webp');">
                                                    <a href="https://www.wallpaper-access.com/search?wallpaper=android">Android
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

                                    </div>
                                </section>
                            </main>
                        </div>
                        <div class="psric-btm">

                            <footer>
                                <div class="footer-inside">
                                    <div class="footer-top-section">
                                        <strong>Download 10,000+ wallpaper with Love ❤️</strong>
                                    </div>
                                    <div class="footer-mid-section">
                                        <div class="links-box">
                                            <div class="lb-links">
                                                <a title="Terms of use" href="/termsandconditions">Terms of use</a>
                                                <a title="Privacy Policy" href="/privacypolicy">Privacy Policy</a>
                                                <a title="Disclaimer" href="/disclaimer">Disclaimer</a>
                                                <a title="Report a Link" href="/contact">Report a Link</a>
                                                <a title="FAQs" href="/personaluseonly">FAQs</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer-btm-section">
                                        Copyright : 2022 - <span class="current-year"></span> All Rights Reserved.
                                    </div>
                                </div>
                            </footer>
                            <div class="bottom-to-top" onclick="window.scrollTo(0, 0)" role="button">
                                <i class="nav-logo-css chevron-up"></i>
                            </div>
                            <!-- model image container -->
                            <style>
                                .model-img::-webkit-scrollbar {
                                    display: none;
                                }

                                .model-img {
                                    -ms-overflow-style: none;
                                    scrollbar-width: none;
                                }
                            </style>
                            <div class="model-img" style="display: none;">
                                <img class="model-img-url" style="width : unset;" alt="Preview Image">
                                <div class="close-model">&#10005; close</div>
                            </div>
                            <!-- date and spinner background -->

                            <script>
                                document.addEventListener("DOMContentLoaded", () => { let e = document.querySelector(".ipt-left > div.img-box") ? document.querySelector(".ipt-left > div.img-box") : 0; function t() { let t = e.firstChild; t.classList.contains("landscape") || 500 <= window.innerWidth ? (e.style.width = e.clientWidth + "px", e.style.height = .5625 * e.clientWidth + "px") : (e.style.width = e.clientWidth + "px", e.style.height = 1.77 * e.clientWidth + "px") } 0 != e && t(), window.onresize = () => { 0 != e && t() } });
                                let date = new Date(); document.querySelector('.current-year').innerText = date.getFullYear();
                            </script>
                            <script async type="text/javascript" src="/script/production_v07_class.js"></script>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>

</html>