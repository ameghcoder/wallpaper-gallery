<?php

include "../NDA.php";

$_query = "SELECT id, img_url FROM wallpaperaccess";
$_res = mysqli_query($connection, $_query);

if ($_res) {
    $_data = mysqli_fetch_all($_res);
    $_numRow = mysqli_num_rows($_res);

    for ($i = 0; $i < $_numRow; $i++) {
        $_imgURL = $_data[$i][1];
        $_imgID = $_data[$i][0];
        // $_imgInfo = getimagesize("../uploads/" . $_imgURL);
        $_imgSize = filesize("../uploads/" . $_imgURL);

        if ($_imgSize < 1000000) {
            $_imgSize = round($_imgSize * 0.001, 2) . "KB";
        } else if ($_imgSize >= 1000000) {
            $_imgSize = round($_imgSize * 0.000001, 2) . "MB";
        }

        // $_dim = $_imgInfo[0] . 'x' . $_imgInfo[1];
        $_query_01 = "UPDATE wallpaperaccess SET size='$_imgSize' WHERE id=$_imgID";
        $_res_01 = mysqli_query($connection, $_query_01);

        if ($_res_01) {
            continue;
        } else {
            echo "Faild on id number " . $_imgID;
            break;
        }
    }
} else {
    echo "<h2>Failed</h2>";
}

?>

<!-- x -->