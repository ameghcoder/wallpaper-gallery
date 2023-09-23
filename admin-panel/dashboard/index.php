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
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <header class="top-header">
            <div class="th-left">Admin Panel <Strong>Home</Strong></div>
            <?php include($_SERVER['DOCUMENT_ROOT'] . '/admin-panel/component/' . 'in_top_header.html') ?>
        </header>
        <div class="container-inside">
            <?php include($_SERVER['DOCUMENT_ROOT'] . '/admin-panel/component/' . 'in_left_header.html'); ?>
            <main class="main-content">
                <section class="content">
                    <div class="user-details">
                        <div class="ud-inside">
                            <div class="ud-top">
                            </div>
                            <div class="ud-btm">
                                <div class="ud-btm-user-image">
                                    <img src="../assets/channel.png" alt="ocean of code logo">
                                </div>
                                <div class="ud-btm-user-name">Ankit</div>
                            </div>
                        </div>
                    </div>
                    <div class="dt-in-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Total Uploads</th>
                                    <th>Your Uploads</th>
                                    <th>Views</th>
                                    <th>Downloads</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    include_once '../SDC.php';
                                        $query = "SELECT * FROM wallpaperaccess";
                                        $res = mysqli_query($connection, $query);
                                        $total_wall = mysqli_num_rows($res);
                                        $query_01 = "SELECT ViewCount, DownCount FROM wallpaperaccess WHERE username='Akki6377'";
                                        $res_01 = mysqli_query($connection, $query_01);
                                        $total_current_user_wall = mysqli_num_rows($res_01);
                                        $res_01 = mysqli_fetch_all($res_01);
                                        $views = $downloads = 0;
                                        for($i = 0; $i < $total_current_user_wall; $i++){
                                            $views += $res_01[$i][0];
                                            $downloads += $res_01[$i][1];
                                        }
                                        echo '<td>'.$total_wall.'</td><td>'.$total_current_user_wall.'</td><td>'.$views.'</td><td>'.$downloads.'</td>'

                                    ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
                <?php include($_SERVER['DOCUMENT_ROOT'].'/admin-panel/component/'.'footer.html') ?>
            </main>
        </div>
    </div>
</body>
</html>