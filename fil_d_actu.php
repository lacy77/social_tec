<?php

session_start();
require("db.php");
function securisation ($input) { //XML ATTACK, SQL injection  
    $input = htmlspecialchars($input);
    return $input;

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

        if(strlen  ($_POST['publication']) > 360 ) {
            echo"360 caractèrs autorisé";
        } else {

            $publication = securisation (($_POST['publication'])  );
            $publication = nl2br($publication);
            $target_dir = "uploads_img/";
            $randomNameFile = randomName();
            $insert_db =  $conn->prepare("INSERT INTO publication (contenu, date_de_publication, admin_id, nom) VALUES ( ?, ?, ?, ?)");
            $insert_db->execute(array($publication, $current_timestamp, $id, $user_info['nom'], ));
          //  if(!empty($_FILES['fileToUpload']['name'])) { // upload file
                $fileImage = $_FILES['fileToUpload']['name'] ;
                $extension = pathinfo($fileImage, PATHINFO_EXTENSION);
                $tmp_name = $_FILES["fileToUpload"]["tmp_name"];

              //  if((exif_imagetype($tmp_name) == 2) || ( exif_imagetype($tmp_name) == 3) ) { // verfiy if it s a jpeg or gif
                    $fileName .=  randomName(). '.' . $extension;
                    $uploadDestination = $target_dir . $fileName;
                    $insertFile= $db->prepare("INSERT INTO publication ( postFileName ) VALUES(?)");
                    $insertFile->execute(array($fileName, $fileName)); // file name, file_id
                    move_uploaded_file($tmp_name, $uploadDestination);
                   // header('Location:profil.php?id='.$_SESSION['id']); 

               // }  else {
             //       $error ='Format inconnu!';
              //  }
         //   }

}

       // echo 'Envoyé';
        }
         
       
    } else  {
        echo " une erreur est survenue";
    }


        $publication_affichage =  $conn->prepare("SELECT * FROM publication WHERE admin_id = ? ORDER BY id DESC");
        $publication_affichage->execute(array($id));
        if($publication_affichage->rowCount() == 0) { // si le fil d'actu est vide on redirige vers la page de groupe. 
          //  header("Location:ami_et_groupe.php");

        }





?>

<html>
<head>
  <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
  <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/publication.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/fil.css">
</head>
<body class="w3-theme-l5">

<!-- Navbar -->
<header class="mdc-top-app-bar">
  <div class="mdc-top-app-bar__row">
    <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
      <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button" aria-label="Close"></button>
      <span class="mdc-top-app-bar__title">Contextual title</span>
    </section>
    <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end" role="toolbar">
      <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button" aria-label="Close"></button>
      <span class="mdc-top-app-bar__title">Contextual title</span>
      <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button" aria-label="Close"></button>
      <span class="mdc-top-app-bar__title">Contextual title</span>
      <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button" aria-label="Close"></button>
      <span class="mdc-top-app-bar__title">Contextual title</span>
    </section>
  </div>
</header>
<main class="mdc-top-app-bar--fixed-adjust">
  
</main>


        <!-- Middle Column -->
        <div class="container" style="width:600px; overflow:auto;">

                                <p>Bonjour <?php echo $user_info[1] ?></p>
                                <form action="#" method="POST" >

                                            <!-- text area -->
                                    <label class="mdc-text-field mdc-text-field--filled mdc-text-field--textarea mdc-text-field--no-label">
                                    <span class="mdc-text-field__ripple"></span>
                                    <span class="mdc-text-field__resizer"  style="border:2px solid #6200ee">
                                        <textarea class="mdc-text-field__input" rows="20" cols="50" aria-label="Label" name="publication" id="publication"></textarea>
                                    </span>

  <input type="file" name="fileToUpload" id="fileToUpload">
                                    <span class="mdc-line-ripple"></span>
                                    </label> <br>
                                    <div class="mdc-card__actions">
                                            <!-- interact icon -->
                                    <button class="mdc-icon-button mdc-card__action mdc-card__action--icon"
                                        aria-pressed="false"
                                        aria-label="Add to favorites"
                                        title="Add to favorites">
                                    <i class="material-icons mdc-icon-button__icon mdc-icon-button__icon--on">favorite</i>
                                    <i class="material-icons mdc-icon-button__icon">favorite_border</i>
                                    </button>
                                    <button class="material-icons mdc-icon-button mdc-card__action mdc-card__action--icon" title="Share">share</button>
                                    <button class="material-icons mdc-icon-button mdc-card__action mdc-card__action--icon" title="More options">more_vert</button>
                                    </div>
                                            <!-- submit button -->


                                    <button class="mdc-button mdc-button--raised" id="btn" name="submit_btn">
                                        <span class="mdc-button__label">Envoyer</span>
                                    </button>
                                    
                       
                                </form>
                            <h6 class="w3-opacity">Poster ce que vous voulez</h6>
                             </div>
                    </div>
                </div>
            </div>

                

                <?php
                // afficher les publications !
                
             while($row =  $publication_affichage->fetch(PDO::FETCH_ASSOC)){
                    
            ?>

                <div class="mdc-card container container-grid " style="width:600px;margin-bottom:12px;">
                    <div class="mdc-card__primary-action">
                        <div class="mdc-card__media mdc-card__media--square">
                            <div class="mdc-card__media-content"> 
                                <p>  <?= ($row['contenu']); ?></p> <!-- //publish content  --->
                            </div>
                        </div> 
                        <p>Publié le :<?= htmlspecialchars($row['date_de_publication']); ?> par    <?= ($row['nom']); ?></p> <!-- //nom et date -->
                    
                    </div>
                    <div class="mdc-card__actions">
                        <div class="mdc-card__action-buttons">
                        <button class="mdc-button mdc-card__action mdc-card__action--button">
                            <div class="mdc-button__ripple"></div>
                            <span class="mdc-button__label">Action 1</span>
                        </button>
                        <button class="mdc-button mdc-card__action mdc-card__action--button">
                            <div class="mdc-button__ripple"></div>
                            <span class="mdc-button__label">Action 2</span>
                        </button>
                        </div>
                        <div class="mdc-card__action-icons">
                        <button class="material-icons mdc-icon-button mdc-card__action mdc-card__action--icon" title="Share">share</button>
                        <button class="material-icons mdc-icon-button mdc-card__action mdc-card__action--icon" title="More options">more_vert</button>
                        </div>
                    </div>
                </div>

                


                    <?php 
                    }
                    
                ?>




         

            <!-- End Middle Column -->
        </div>

<footer class="w3-container w3-theme-d5"></footer>

<script>
    // Accordion
    function myFunction(id) {
        var x = document.getElementById(id);
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
            x.previousElementSibling.className += " w3-theme-d1";
        } else {
            x.className = x.className.replace("w3-show", "");
            x.previousElementSibling.className =
                x.previousElementSibling.className.replace(" w3-theme-d1", "");
        }
    }

    // Used to toggle the menu on smaller screens when clicking on the menu button
    function openNav() {
        var x = document.getElementById("navDemo");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }
</script>

</body>
</html>



<script>
// stop form resubmission on page refresh?
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
