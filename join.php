<?php
include './NDA.php';
// Define Variables

// checking For a Post request
if(isset($_GET["personEmail"]) && $_GET["personName"] && $_GET["personMessage"]){
    $name = $email = $query = $msg = "";
    $email = test_input($_GET["personEmail"]);
    $name = test_input($_GET["personName"]);
    $query = test_input($_GET["personMessage"]);

    $subject = "$name want to Contact.";
    $to = "learnbeyondthink@gmail.com";
    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: $email";
    $message = "Message from $name : $query." ;

    $selectQuery = "INSERT INTO contact (NAME, EMAIL, MESSAGE) values('$name', '$email', '$query')";
    $res = mysqli_query($connection, $selectQuery);
    if($res){        
        if(mail($to, $subject, $message, $headers)){
            echo 'We have been received your message. We will contact you as soon as possible.';
        }else{
            echo 'Something went wrong. Try again later';
        }
    } else{
        echo 'Something went wrong. Try again later';
    }
} else if(isset($_GET["urn"])){
    $name = $email = $query = $msg = "";
    $email = test_input($_GET["urn"]);

    $subject = "A new subscriber will be want to get new wallpaper updates.";
    $to = "learnbeyondthink@gmail.com";
    
    $message = "Subscriber Email : $email";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: $email";

    $selectQuery = "SELECT * FROM subscriber WHERE EMAIL='$email'";
    $res = mysqli_query($connection, $selectQuery);
    $num = mysqli_fetch_array($res);
    if($num == 0){        
        if(mail($to, $subject, $message, $headers)){
            $selectQuery = "INSERT INTO subscriber (EMAIL) values('$email')";
            $res = mysqli_query($connection, $selectQuery);
            if($res){
                echo 'You have subscribed successfully.<br>Thanks For Coming!';
            } else{
                echo 'Something went wrong. Try again later';
            }
        }else{
            echo 'Something went wrong. Try again later';
        }
    } else{
        echo 'You have already subscribed.';
    }
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars(($data));
    return $data;
}
?>