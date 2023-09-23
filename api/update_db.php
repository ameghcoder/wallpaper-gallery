<?php

include "../NDA.php";

$_query = "SELECT id, img_url FROM wallpaperaccess";
$_res = mysqli_query($connection, $_query);

if ($_res) {
    $_data = mysqli_fetch_all($_res);
    $_numRow = mysqli_num_rows($_res);

    for ($i = 0; $i < $_numRow; $i++) {
        $_imgURL = $_data[$i][1];
        $_imgInfo = getimagesize($_SERVER["SERVER_NAME"] . "/uploads/" . $_imgURL);
        echo "<h2>" . $_imgInfo[0] . '*' . $_imgInfo[1] . '</h2><br>';
    }
} else {
    echo "<h2>Failed</h2>";
}

?>