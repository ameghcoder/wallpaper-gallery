<?php

include_once($_SERVER["SERVER_NAME"] . "/NDA.php");

$_query = "SELECT id, URL FROM 'wallpaperaccess";
$_res = mysqli_query($connection, $_query);

if ($_res) {
    $_data = mysqli_fetch_all($_res);
    $_numRow = mysqli_num_rows($_res);

    for ($i = 0; $i < $_numRow; $i++) {
        $_imgURL = $_data[$i][1];
        print_r(getimagesize($_SERVER["SERVER_NAME"] . "/uploads/" . $_imgURL));
    }
}

?>