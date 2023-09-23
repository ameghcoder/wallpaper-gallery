<?php

include_once '../NDA.php';
if(isset($_GET['id'])){
    $id = $flag = $views = $downloads = $res_all = $uView = $uDownload = "";
    $id = $_GET['id'];
    if(isset($_GET['flag']) && $_GET['flag'] == "v"){
        $query = "SELECT ViewCount FROM wallpaperaccess WHERE id=$id";
        $res = mysqli_query($connection, $query);
        $res_num = mysqli_num_rows($res);
        $res_all = mysqli_fetch_all($res);
        $views = $res_all[0][0];
        $uView = $views + 1;
        if(updateView($id, $uView)){
            echo $uView;
        } else {
            echo "Error in Updating view";
        }
    } else if(isset($_GET['flag']) && $_GET['flag'] == "d") {
        $query = "SELECT DownCount FROM wallpaperaccess WHERE id=$id";
        $res = mysqli_query($connection, $query);
        $res_num = mysqli_num_rows($res);
        $res_all = mysqli_fetch_all($res);
        $downloads = $res_all[0][0];
        $uDownload = $downloads + 1;
        if(updateDown($id, $uDownload)){
            echo $uDownload;
        } else {
            echo "Error in Updating Download";
        }
    }
}

function updateView($id, $val){
    global $connection;
    $query0 = "UPDATE wallpaperaccess SET ViewCount=$val WHERE id=$id";
    $res0 = mysqli_query($connection, $query0);
    if($res0){
        return true;
    } else {
        return false;
    }
}
function updateDown($id, $val){
    global $connection;
    $query1 = "UPDATE wallpaperaccess SET DownCount=$val WHERE id=$id";
    $res1 = mysqli_query($connection, $query1);
    if($res1){
        return true;
    } else {
        return false;
    }
}

?>