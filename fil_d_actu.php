<?php

session_start();
require("db.php");
function securisation ($input) { //XML ATTACK, SQL injection  
    $input = htmlspecialchars($input);
    return $input;

}

if(!empty($_GET['id'])) {
    $id = $_GET['id'];
    settype($id, "integer"); 

    $current_timestamp = date('Y-m-d H:i:s');
    if($_SESSION['id'] == $id) {

        $req = $conn->prepare("SELECT * FROM member WHERE id = ?");
        $req->execute(array($id));
        
        $user_info = $req->fetch();

    } else {
        echo "compte inexistant";
        header("Location:erreur404.html");
        die();
    }
} else {
    die();
}



if(isset($_POST['submit_btn'])) {
    if(!empty ($_POST['publication'])){
       
        $publication = nl2br(securisation ($_POST['publication']) . );


        //mail alreday exist
        $insert_db =  $conn->prepare("INSERT INTO publication (contenu, date_de_publication, admin_id) VALUES ( ?, ?, ?)");
        $insert_db->execute(array($publication, $current_timestamp, $id));
        echo 'Envoyé';

        $publication_affichage =  $conn->prepare("SELECT * FROM publication WHERE admin_id = ?");
        $publication_affichage->execute(array($id));


    }
}



?>

<html>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="css/publication.css">
    <p>Bonjour <?php echo $user_info[1] ?></p>
    <form action="#" method="POST" enctype="multipart/form-data">
        <textarea name="publication" id="publication" cols="30" rows="10"></textarea>
        <button id="btn" name="submit_btn">Envoyer</button>
    </form>

    <?php
     while($row = $publication_affichage->fetch(PDO::FETCH_ASSOC)) {
         
   ?>
        <div class="container">
        


        <div class="plan-container">
        <div class="plan-header">
            <div class="icon-box"><i class="fa fa-users icon"></i></div>
            <h2>Date</h2>
            <p>
            <?= htmlspecialchars($row['date_de_publication']); ?><h/p>
        </div>
        <div class="plan-details">
            
        <?= htmlspecialchars($row['contenu']); ?>
        </div>
        </div>

        <?php 
        }
         
    ?>





</html>