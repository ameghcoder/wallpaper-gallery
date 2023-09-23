<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Easily crop your images into a perfect circle with our online tool. Simply upload your image and use our simple interface to create the perfect circular crop.">
    <meta name="keywords" content="circle crop tool, image cropping in circle, circular image cropper, circular image crop, crop image to circle, circular crop tool, crop images in circles, circle image cropper, circle image crop, crop images into circles">
    <meta property="og:title" content="Crop Image in Circle || Image Cropper" />
    <meta property="og:description" content="Easily crop your images into a perfect circle with our online tool. Simply upload your image and use our simple interface to create the perfect circular crop." />
    <meta property="og:image" content="https://www.wallpaper-access.com/icon/assets/crop-poster.jpg" />
    <meta property="og:type" content="website" />
    <link rel="canonical" href="https://www.wallpaper-access.com/cropimageincircle" />
    <link href="/ico/css/bootstrap.min.css" rel="stylesheet" loading="lazy">
    <link href="/ico/css/style.css" rel="stylesheet" loading="lazy">
    <style>
        .wrapper {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .wrapper .file-upload {
            height: 100px;
            width: 100px;
            border-radius: 100px;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 4px solid #000000;
            overflow: hidden;
            background-image: linear-gradient(to bottom, #2590EB 50%, #FFFFFF 50%);
            background-size: 100% 200%;
            transition: all 1s;
            color: #FFFFFF;
            font-size: 100px;
            cursor: pointer;
        }
        .wrapper .file-upload input[type='file'] {
            height: 200px;
            width: 200px;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }
        .wrapper .file-upload:hover {
            background-position: 0 -100%;
            color: #2590EB;
        }
        a{
            text-decoration: none;
            color: var(--t-clr) !important;
        }
        a:hover{
            text-decoration: none !important;
        }
    </style>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/ico/fix/' . 'hl.html') ?>
    <title>Crop Image in Circle || Image Cropper</title>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/ico/fix/' . 'h.html') ?>
    <h1>Crop Image in Circle<br>Crop JPG, PNG, AVIF, WEBP, BMP in Circle Shape</h1>
    <main>  
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/ico/fix/' . 'wide.html'); ?>
        <div class="input-box input-file-area" style="height: 100px;">
            <label for="inputImage" style="line-height: 30px; display: inline-block; padding: 30px; margin: 10px; cursor: pointer;">
                Click Here to Upload
            </label>
            <input type="file" class="sr-only btn btn-dark" id="inputImage" name="file"
                accept="image/jpeg, image/jfif, image/jif, image/jpe, image/avif, image/png, image/bmp, image/webp, image/svg, image/ico, image/jpg, image/gif" />
        </div>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/ico/fix/' . 'wide1.html'); ?>
        <div class="settings">
            <div class="class">
                <div class="container-fluid px-lg-5">
                    <div class="row class-container">
                        <div class="col-lg-6 col-md-6 col-sm-12 class-item filter-1 wow fadeInUp" data-wow-delay="0.0s"
                            style="cursor: pointer; z-index: 10;">
                            <div class="image-upload text-center">

                            </div>
                            <div class="img-container" id="imagecontainer" style="border-radius : 10px;">
                                <img src="https://images.unsplash.com/photo-1604925589277-95fc425c68db?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxfDB8MXxyYW5kb218MHx8fHx8fHx8MTY2MjAxNjEyNA&ixlib=rb-1.2.1&q=80&utm_campaign=api-credit&utm_medium=referral&utm_source=unsplash_source&w=600"
                                    alt="Picture" loading="lazy">
                            </div>
                            <div id="control">
                                <div class="col-md-12 text-center" id="button">
                                    <button type="button" id="photobutton"
                                        class="btn btn-dark text-white font-weight-bold"> CROP
                                        CIRCLE</button>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 class-item filter-2 wow fadeInUp" data-wow-delay="0.2s">
                            <div id="finalphoto" class="text-center" style="border-radius : 10px;">
                                <div class="img-container result center">
                                    <img id="resultphoto" style="max-width:93%;" src="/ico/assets/cropimage.png"
                                        loading="lazy" alt="cropped image" />
                                </div>
                                <div class="col-md-12 text-center" id="button">
                                    <button type="button" id="download" class="btn btn-success font-weight-bold">
                                        DOWNLOAD</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/ico/fix/' . 'wide2.html'); ?>
        <section class="text-container">
            <h2 class="heading">About this Tool</h2>
            <p class="paragraph" role="contentinfo">A crop image in circle tool is a website that allows you to crop your images into a circular shape. This tool is particularly useful for creating circular profile pictures or logos for social media platforms, websites, or other online applications.</p>
            <p>To use a crop image in circle tool website, simply upload your image, select the circular crop option, and adjust the circle to fit the desired portion of your image. The website will then process your image and provide you with a new, circular version of your image that you can download.</p>
            <p>Crop image in circle tools are particularly useful for social media managers, bloggers, and website owners who want to create visually appealing circular profile pictures or logos for their online presence. By using a crop image in circle tool, you can quickly and easily create a circular version of your image, without having to use complex image editing software.</p>
            <p>Overall, a crop image in circle tool website is a convenient and efficient way to crop your images into a circular shape, allowing you to create visually appealing profile pictures and logos for your online presence.</p>
        </section>
        <strong>Related Tools</strong>
        <ul class="list-btn">
            <li><a class="link-border" href="/jpegtoanyformat" title="JPG Image Converter">JPG Converter</a></li>
            <li><a class="link-border" href="/pngtoanyformat" title="PNG Image Converter">PNG Converter</a></li>
            <li><a class="link-border" href="/webptoanyformat" title="WEBP Converter">WEBP Converter</a></li>
            <li><a class="link-border" href="/bmptoanyformat" title="BMP Converter">BMP Converter</a></li>
        </ul>
    </main>  
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/ico/fix/' . 'f.html') ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="/ico/script/b.js"></script>
    <script src="/ico/script/bootstrap.js"></script>      
    <script src="/ico/script/script.js"></script>      
</body>
</html>