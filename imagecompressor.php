<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Compress your images quickly and easily with our online image Compressor tool. Simply upload your image and adjust the level of compression to suit your needs.">
    <meta name="keywords" content="online image compressor, image compression tool, online image compression, compress images online, image compressor online, online image compress, image compression online, online image size reducer, online image resize tool, image resize online">
    <meta property="og:title" content="Image Compressor Online ||  Image Compressor" />
    <meta property="og:description" content="Compress your images quickly and easily with our online image Compressor tool. Simply upload your image and adjust the level of compression to suit your needs." />
    <meta property="og:image" content="https://www.wallpaper-access.com/ico/assets/compress-poster.jpg" />
    <meta property="og:type" content="website" />
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/ico/fix/' . 'hl.html') ?>
    <link rel="canonical" href="https://www.wallpaper-access.com/imagecompressor" />
    <title>Image Compressor Online ||  Image Compressor</title>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/ico/fix/' . 'h.html') ?>
    <h1>Image Compressor<br>Compressor Image in Many Level</h1>
    <main>
        <ul class="list-btn">
            <li><a class="active" href="/imagecompressor" title="Image Compressor">Compressor</a></li>
            <li><a href="/imageresizer" title="Image Resizer">Resizer</a></li>
            <li><a href="/imageconverter" title="Image Converter">Converter</a></li>
            <li><a href="/cropimageincircle" title="Image Crop in Circle">Crop in Circle</a></li>
        </ul>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/ico/fix/' . 'wide.html'); ?>
        <section class="input-box input-file-area">
            <div class="input-group">
                <label for="file">Click here to Upload</label>
                <input type="file" id="file" hidden maxlength="5" accept=".jpeg, .jpg, .jfif, .jif, .png, .webp, .bmp, .gif">
                <br>
                <em>You can upload 1 image at a time</em>
            </div>
        </section>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/ico/fix/' . 'wide1.html'); ?>
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
        
        <section class="settings-box sb-dimension">
            <div class="settings compression-ratio-box">
                <div class="input-group">
                    <strong>Compression<span class="info-icon"></span> <span id="compression-precent">70%</span></strong>
                </div>
                <div class="input-group">
                    <input type="range" name="compression" id="compression" value="75" min="0" max="100">
                </div>
            </div>
            <div class="submit-btns">
                <button type="button" class="start-btn" data-tool="com">Compress</button>
            </div>
        </section>
        <?php include($_SERVER['DOCUMENT_ROOT'] . '/ico/fix/' . 'wide2.html'); ?>
        <section class="settings-box img-process">
            <div class="progress-bar-0-100">
                <strong class="pb-count"></strong>
                <div class="progress-bar">
                    <div class="pb-inside bar-0-100" id="progressBar"></div>
                </div>
            </div>
        </section>
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
                                <td class="img-before-size">0KB</td>
                                <td class="img-after-size">0KB</td>
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
                                <td colspan="2" class="img-compression-ratio">2.5%</td>
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
                                <td colspan="2" class="img-time-of-exe">0.02s</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <section class="text-container">
        <h2 class="heading">Follow these steps </h2>
            <ol>
                <li style="list-style-type:square !important;">Click on "Click here to upload" green text</li>
                <li style="list-style-type:square !important;">Then adjust the compression ratio</li>
                <li style="list-style-type:square !important;">And, click on compress button.</li>
                <li style="list-style-type:square !important;">Now your image is ready to download</li>
            </ol>
            <h2 class="heading">About this tool</h2>
            <p>An image compression tool is a website that allows you to reduce the file size of your images without sacrificing quality. This tool uses various techniques to compress your images, such as reducing the number of colors, removing unnecessary metadata, and optimizing the image for web use.</p>
            <p>To use an image compression tool website, simply upload your image, and the website will process the image and provide you with a new, compressed version of your image that you can download. The amount of compression can be adjusted based on your needs and preferences.</p>
            <p>Image compression tools are particularly useful for website owners, bloggers, and social media managers who need to optimize their images for faster load times and better user experience. By using an image compression tool, you can significantly reduce the file size of your images without sacrificing quality, resulting in faster page load times and better performance.</p>
            <p>Overall, an image compression tool website is a convenient and efficient way to compress your images for various online platforms, allowing you to optimize your images for faster loading times and better user experience.</p>
        </section>
    </main>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/ico/fix/' . 'f.html') ?>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/ico/fix/' . 'extra.html') ?>
</body>
</html>