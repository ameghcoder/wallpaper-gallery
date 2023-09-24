<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="{{TAG}}">
    <meta name="description" content="{{DESCRIPTION}}">
    <meta itemprop="name" content="{{TITLE}}">
    <meta itemprop="description" content="{{DESCRIPTION}}">
    <meta itemprop="image" content="{{IMAGE_URL}}">
    <meta property="og:title" content="{{TITLE}}">
    <meta property="og:url" content="{{PAGE_URL}}">
    <meta property="og:description" content="{{DESCRIPTION}}">
    <meta property="og:image" content="{{IMAGE_URL}}" />
    <meta property="og:image:secure_url" content="{{IMAGE_URL}}" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:alt" content="{{TITLE}}" />
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/component/' . 'img_link.html'); ?>
    <link rel="canonical" href="{{PAGE_URL}}" />
    <title>{{TITLE}}</title>
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
                                <h1>{{TITLE}}</h1>
                            </div>
                            <main class="main-content">
                                <section class="img-preview"><input value="{{IMG_URL}}" hidden id="img-heading" />
                                    <div class="ip-top">
                                        <div class="ipt-left">
                                            <div class="img-box"><img class="preview-image lazyload landscape"
                                                    data-src="/webp-1000/3d-black-texure-4k-wallpaper.webp"
                                                    src="/assets/lazyloadimg.webp" onerror="this.style.display = 'none'"
                                                    alt="{{TITLE}}" title="{{TITLE}}"></div>
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
                                                    href="{{IMG_URL}}" id="img-download-btn" download>Download</a>

                                                <div class="ipib-view-reso-download">
                                                    <span data-id="{{IMG_ID}}" id="data-id-of-img"
                                                        style="display : none" hidden>Image ID</span>

                                                    <span class="ipib-reso"><span class="ipib-txt">Resolution</span>
                                                        <span class="digits">{{DIMENSION}}</span></span>

                                                    <div></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ipt-right">
                                            <?php include($_SERVER['DOCUMENT_ROOT'] . '/component/' . 'side-category-code.html') ?>
                                        </div>
                                    </div>
                                </section>

                                <div class="share-box">
                                    <div class="share-box-inside"><button
                                            onclick="document.querySelector('.share-box').classList.add('zoom-out');document.querySelector('.share-box').classList.remove('zoom-in');"
                                            type="button"
                                            style="cursor : pointer; background: red; padding: 5px 10px; color: white; border: none; outline: none; font-weight: bolder; font-size: 15px;">&#9587;</button>
                                        <div class="sbi-top"><input type="text" class="pageURL" value="{{PAGE_URL}}"
                                                disabled></div>
                                        <div class="sbi-btm"><a
                                                href="https://www.facebook.com/sharer/sharer.php?u={{PAGE_URL}}"
                                                id="fb-share" role="button" style="background: #3b5998;">Facebook</a><a
                                                href="https://twitter.com/share?url={{PAGE_URL}}" id="tw-share"
                                                role="button" style="background: #00acee;">Tweet</a><a
                                                href="https://api.whatsapp.com/send?text={{PAGE_URL}}" id="wh-share"
                                                role="button" style="background: #25D366;">Whatsapp</a><button
                                                type="button" class="copy-link"
                                                style="border: none; outline: none;">Copy
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
                            <?php include($_SERVER['DOCUMENT_ROOT'] . '/component/' . 'footer.html'); ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>

</html>
<script></script>