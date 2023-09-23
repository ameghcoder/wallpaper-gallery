<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Best Image resizer to resize your image High resolution to Low, or Low resolution to High. Resize and also set the compression ratio of Image.">
    <meta name="keywords" content="image resizer, image editing, photo resizing, resize image, crop image, reduce image size, simple image resizer, online image resizer, resize image low to high, resize image high to low">
    <meta property="og:title" content="Image Resizer Online || Resize Low to High or Vice Versa" />
    <meta property="og:description" content="Best Image resizer to resize your image High resolution to Low, or Low resolution to High. Resize and also set the compression ratio of Image." />
    <meta property="og:image" content="https://www.wallpaper-access.com/ico/assets/resizer-poster.jpg" />
    <meta property="og:type" content="website" />
    <link rel="canonical" href="https://www.wallpaper-access.com/imageresizer" />
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/ico/fix/' . 'hl.html') ?>
    <title>Image Resizer Online || Resize Low to High or Vice Versa</title>
</head>
<body>

    <?php include($_SERVER['DOCUMENT_ROOT'] . '/ico/fix/' . 'h.html') ?>
    <h1>Image Resizer<br>Resize Image in High and Low Resolution</h1>
    <main>
        <ul class="list-btn">
            <li><a href="/imagecompressor" title="Image Compressor">Compressor</a></li>
            <li><a class="active" href="/imageresizer" title="Image Resizer">Resizer</a></li>
            <li><a href="/imageconverter" title="Image Converter">Converter</a></li>
            <li><a href="/cropimageincircle" title="Image Crop in Circle">Crop in Circle</a></li>
        </ul>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/ico/fix/' . 'wide.html'); ?>
        <section class="input-box input-file-area">
            <div class="input-group">
                <label for="file">Click here to Upload</label>
                <input type="file" id="file" hidden maxlength="5" accept="image/*">
                <br>
                <em>You can upload 1 image at a time</em>
            </div>
        </section>
        <section class="grid-img-box">
            <h2>Uploaded Preview</h2>
            <div class="grid-img-box-inside">
                <img class="uploaded-img" src="" alt="image">
            </div>
            <strong>Dimension : <em style="text-decoration: underline;" id="original-width-height"></em></strong>
            <div class="settings compression-ratio-box">
                <div class="input-group">
                    <strong>Compression Detail</strong>
                    <p style="width: 100%;">0% (Worst Quality, Smaller File)</p>
                    <p style="width: 100%;">100% (High Quality, Bigger File)</p>
                </div>
            </div>
        </section>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/ico/fix/' . 'wide1.html'); ?>
        <section class="settings-box sb-dimension">
            <strong>Enter Width & Height that you want</strong>
            <div class="settings">
                <div class="input-group">
                    <label for="newWidth">Width</label>
                    <br>
                    <input type="number" value="" class="new-Width" id="newWidth" min="0" max="15000" maxlength="15000">
                </div>
                <div class="input-group">
                    <label for="newHeight">Height</label>
                    <br>
                    <input type="number" value="" class="new-Height" id="newHeight" min="0" max="15000" maxlength="15000">
                </div>
            </div>
            <div class="settings compression-ratio-box">
                <div class="input-group">
                    <strong>Compression <span class="info-icon"></span> <span id="compression-precent">70%</span></strong>
                </div>
                <div class="input-group">
                    <input type="range" name="compression" id="compression" value="75" min="0" max="100">
                </div>
            </div>
            <div class="submit-btns">
                <button type="button" class="start-btn" data-tool="res">Resize</button>
            </div>
        </section>
        <section class="settings-box img-process">
            <div class="progress-bar-0-100">
                <strong class="pb-count"></strong>
                <div class="progress-bar">
                    <div class="pb-inside bar-0-100" id="progressBar"></div>
                </div>
            </div>
        </section>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/ico/fix/' . 'wide2.html'); ?>
        <section class="settings-box additional-info">
            <div class="additional-info-box">
                <div class="img-download-btn">
                    <a href="https://wallpaper-access.com" class="img-execution-link" download="imageconverteronline">Download</a>
                </div>
                <?php include($_SERVER['DOCUMENT_ROOT'] . '/ico/fix/' . 'wide.html'); ?>
                <strong>Image Details</strong>
                <div class="img-new-size">
                    <table class="exe-data">
                        <thead>
                            <tr>
                                <th>Before</th>
                                <th>After</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="img-before-size"></td>
                                <td class="img-after-size"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="exe-data">
                        <thead>
                            <tr>
                                <th>Compression Ratio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2" class="img-compression-ratio"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="exe-data">
                        <thead>
                            <tr>
                                <th>Time of Execution</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2" class="img-time-of-exe"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <section class="text-container">
            <h2 class="heading">About this tool</h2>
            <p class="paragraph" role="contentinfo">
            An image resizer tool is a website that provides a quick and easy way to resize your images online. This tool allows you to adjust the dimensions of your images, making them smaller or larger, depending on your needs. With an image resizer tool, you can easily resize your images without having to install any software on your computer.
            </p>
            <p class="paragraph">To use an image resizer tool website, simply upload your image, select the desired size, and click the resize button. The website will then process your image and provide you with a new, resized version of your image that you can download.</p>
            <p class="paragraph">Image resizer tool websites are particularly useful for bloggers, website owners, and social media managers who need to optimize their images for faster load times and better user experience. By using an image resizer tool, you can reduce the file size of your images without sacrificing quality, making your website or social media profile faster and more responsive.</p>
            <p class="paragraph">Overall, an image resizer tool website is a convenient and efficient way to resize your images for various online platforms.</p>

        </section>
    </main>
        
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/ico/fix/' . 'f.html') ?>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/ico/fix/' . 'extra.html') ?>
</body>
</html>