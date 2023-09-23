<?php
// Start the session
session_start();
if(isset($_SESSION['username'])){
    $usernameTeam = $_SESSION['username'];
} else{
    header('location: /admin-panel/');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/admin-panel/component/' . 'in_head_file.html') ?>
    <title>Sitemap >> Wallpaper Access</title>
    <style>
        .btn{
            margin: 10px;
            padding: 5px 10px;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="top-header">
            <div class="th-left">Admin Panel <Strong>About</Strong></div>
           <?php include($_SERVER['DOCUMENT_ROOT'] . '/admin-panel/component/' . 'in_top_header.html') ?>
        </header>
        <div class="container-inside">
            <?php include($_SERVER['DOCUMENT_ROOT'] . '/admin-panel/component/' . 'in_left_header.html'); ?>
            <main class="main-content">
                <h2 style="padding-left:5px;border-left:5px solid black;font-size:19px;margin:0px 0px 10px 0px;">Update Recent Section</h2>
                <button type="button" class="btn update-recent-section-code-d">update desktop wallpapers</button>
                <button type="button" class="btn update-recent-section-code-d-isi">update desktop wallpapers [ISI]</button>
                <button type="button" class="btn update-recent-section-code-a">update Android wallpapers</button>
                <button type="button" class="btn update-recent-section-code-a-isi">update Android wallpapers [ISI]</button>
                <h2 style="padding-left:5px;border-left:5px solid black;font-size:19px;margin:0px 0px 10px 0px;">Update Category Number on Homepage</h2>
                <button type="button" class="btn update-cnbt-number">Update Category Number</button>
                <h2 style="padding-left:5px;border-left:5px solid black;font-size:19px;margin:0px 0px 10px 0px;">Update Sitemap</h2>
                <button type="button" class="btn update-sitemap-code">Image Sitemap Update</button>
                <h2 style="padding-left:5px;border-left:5px solid black;font-size:19px;margin:0px 0px 10px 0px;">Submit URL on Google, Bing & Yahoo</h2>
                <button type="button" class="btn submit-url-on-google">Submit sitemap on Google</button>
                <button type="button" class="btn submit-url-on-google-img">Submit image sitemap on Google</button>
            </main>
        </div>
    </div>
<div class="message-printer-box">
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.js" integrity="sha512-nO7wgHUoWPYGCNriyGzcFwPSF+bPDOR+NvtOYy2wMcWkrnCNPKBcFEkU80XIN14UVja0Gdnff9EmydyLlOL7mQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="/admin-panel/script/sitemap_v01.js"></script>
</body>
</html>