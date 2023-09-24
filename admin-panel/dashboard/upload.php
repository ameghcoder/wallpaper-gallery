<?php
// Start the session
session_start();
if (isset($_SESSION['username'])) {
    $usernameTeam = $_SESSION['username'];
} else {
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
    <title>Upload >> Wallpaper Access</title>
</head>

<body>
    <div class="container">
        <header class="top-header">
            <div class="th-left">Admin Panel <Strong>Upload</Strong></div>
            <?php include($_SERVER['DOCUMENT_ROOT'] . '/admin-panel/component/' . 'in_top_header.html') ?>
        </header>
        <div class="container-inside">
            <?php include($_SERVER['DOCUMENT_ROOT'] . '/admin-panel/component/' . 'in_left_header.html'); ?>
            <main class="main-content">
                <section class="content">
                    <div class="upload-image-section">
                        <div class="uis-top">
                            <div class="click-here">
                                <label for="wallpaper">
                                    Click Here to Upload
                                </label>
                                <input type="file" name="wallpaper" id="wallpaper" accept="image/*" hidden>
                                <strong id="username" hidden>
                                    <?php
                                    session_start();
                                    if (isset($_SESSION['username'])) {
                                        echo $_SESSION['username'];
                                    } else {
                                        echo "Akki6377";
                                    }
                                    ?>
                                </strong>
                            </div>
                            <div class="preview-image">
                                <img class="preview" src="">
                            </div>
                        </div>
                        <div class="uis-mid">
                            <input type="text" name="wallpaper-name" id="wallpaper-name"
                                placeholder="Enter Wallpaper Name">
                            <select name="category" id="category">
                                <option value="3d">3D</option>
                                <option value="4k">4k</option>
                                <option value="ai">A.I.</option>
                                <option value="abstruct">Abstruct</option>
                                <option value="actor">Actor</option>
                                <option value="actress">Actress</option>
                                <option value="art">Art</option>
                                <option value="animal">Animal</option>
                                <option value="android">Android</option>
                                <option value="anime">Anime</option>
                                <option value="avengers">Avengers</option>
                                <option value="bts">BTS Army</option>
                                <option value="baby">Baby</option>
                                <option value="building">Building</option>
                                <option value="bike">Bike</option>
                                <option value="cars">Cars</option>
                                <option value="cartoon">Cartoon</option>
                                <option value="christmas">Christmas</option>
                                <option value="computer">Computer</option>
                                <option value="city">City</option>
                                <option value="gods">Gods</option>
                                <option value="galaxy">Galaxy</option>
                                <option value="gym">Gym</option>
                                <option value="gun">Gun</option>
                                <option value="gaming">Gaming</option>
                                <option value="house">House</option>
                                <option value="mountain">Mountain</option>
                                <option value="nature">Nature</option>
                                <option value="planet">Planet</option>
                            </select>
                        </div>
                        <div class="uis-btm">
                            <strong>Keywords Length : <em class="_keyword_length"></em>, Not more than 250
                                characters</strong>
                            <textarea name="tags" id="tags" cols="30" rows="10"
                                placeholder="Enter Wallpaper Tags"></textarea>
                            <strong>Description Length : <em class="_description_length"></em>, Not more than 160
                                characters or Less than 100 characters</strong>
                            <textarea name="description" id="description" cols="30" rows="10"
                                placeholder="Write something about wallpaper"></textarea>
                            <button type="button" class="uploadBtn">Upload</button>
                        </div>
                    </div>
                </section>
                <?php include($_SERVER['DOCUMENT_ROOT'] . '/admin-panel/component/' . 'footer.html') ?>
            </main>
        </div>
    </div>
</body>

</html>