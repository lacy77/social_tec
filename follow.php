<?php
session_start();
require_once("db.php");
if(!empty($_SESSION['id'])) {



    if(!empty($_GET['following_id']) && !empty ($_GET['follower_id']) && !empty($_GET['return_to'] )) {
        $following = ($_GET['following_id']) ;
        settype($following, "integer");
        $follower_id = ($_GET['follower_id']);
        settype($follower_id, "integer");

        $req = $conn->prepare("INSERT INTO follow_tb (following_id, follower_id) VALUES ( ?, ?)");
        $req->execute(array($_SESSION['id'], $follower_id));
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        echo "ok";   
        

    } 
    else {
        echo "nope";
        header("Location:erreur404.txt");
        die();
    }


}