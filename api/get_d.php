<?php

include "../NDA.php";

if (isset($_GET['id']) && $_GET['id'] != "" && $_GET['id'] != null) {
    $id = $_GET['id'];
    $query = "SELECT ViewCount, DownCount FROM wallpaperaccess WHERE id=$id";
    $res = mysqli_query($connection, $query);
    $res_row = mysqli_fetch_all($res)[0];
    $jsonArr = array(
        "view" => $res_row[0],
        "down" => $res_row[1]
    );
    print_r(json_encode($jsonArr));
}

?>