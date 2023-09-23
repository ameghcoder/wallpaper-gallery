<?php
include_once 'db_info.php';
if(isset($_SERVER['REQUEST_METHOD']) && $_GET['query'] != ''){
    $para = $_GET['query'];
    if($para == 't'){
        $query = "SELECT * FROM ico_count_data";
        $res = mysqli_query($connection, $query);
        $num = mysqli_num_rows($res);
        $resData = mysqli_fetch_all($res);
        $countTotal = 0;
        for($i = 0; $i < $num; $i++){
            $countTotal += $resData[$i][2];
        }
        echo $countTotal;
    }
}
?>