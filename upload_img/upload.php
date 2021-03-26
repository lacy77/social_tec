
<?php

require("../db.php");

function securisation ($input) { //XML ATTACK, SQL injection  
    $input = htmlspecialchars($input);
    return $input;

}



if(isset($_POST['submit_btn'])) {

    if(!empty ($_POST['publication'])){

        if(strlen  ($_POST['publication']) > 360 ) {
            echo"360 caractèrs autorisé";
        } else {

            $publication = securisation (($_POST['publication'])  );
            $publication = nl2br($publication);
            $insert_db =  $conn->prepare("INSERT INTO publication (contenu, date_de_publication, admin_id, nom) VALUES ( ?, ?, ?, ?)");
            $insert_db->execute(array($publication, $current_timestamp, $id, $user_info['nom']));

       // echo 'Envoyé';
        }
         
       
    } else  {
        echo " une erreur est survenue";
    }
}

        $publication_affichage =  $conn->prepare("SELECT * FROM publication WHERE admin_id = ? ORDER BY id DESC");
        $publication_affichage->execute(array($id));
        if($publication_affichage->rowCount() == 0) { // si le fil d'actu est vide on redirige vers la page de groupe. 
          //  header("Location:ami_et_groupe.php");

        }



//random string for file file char
function randomName () {
    $rand ="azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN1234567890";
    $randStringToReturn ='';
    for($ii=0; $ii < 7; ++$ii){
        $index = rand(0, 51); // strlen $rand-1
        $randStringToReturn .= $rand[$index];

    }


    return $randStringToReturn;
}

$target_dir = "uploads_img/";
if(!empty($_FILES['avatar']['name'])) {
      

    $fileImage = $_FILES['avatar']['name'] ;
    $extension = pathinfo($fileImage, PATHINFO_EXTENSION);
    $tmp_name = $_FILES["avatar"]["tmp_name"];

    if((exif_imagetype($tmp_name) == 2) || ( exif_imagetype($tmp_name) == 3) ) { // verfiy if it s a jpeg or gif
          $fileName =  randomName(). '.' . $extension;
          $uploadDestination = $target_dir . $fileName;
          $insertFile= $db->prepare("UPDATE member SET avatar = ? WHERE id = ?");
          $insertFile->execute(array($userAvatar, $_SESSION['id']));
          move_uploaded_file($tmp_name, $uploadDestination);
          header('Location:profil.php?id='.$_SESSION['id']); 

    }  else {
        $error ='Ce format n\'est pas pris en compte!';
    }

}

?>
