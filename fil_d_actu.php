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

    if(!empty ($_POST['publication']) &&  ($_FILES['fileToUpload']["tmp_name"]!="")  ){//if user uploaded an image 

        if(strlen  ($_POST['publication']) > 360 ) {
            echo"360 caractèrs autorisé";
        } else {

            $publication = securisation (($_POST['publication'])   );
            $publication = nl2br($publication);
            $target_dir = "uploads_img/";
            $randomNameFile = randomName();



            //====================== upload image ===================



                $target_dir = "upload_img/";
                $ext = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
                $randomNameFile .=".".$ext;

                $target_file = $target_dir . basename($randomNameFile);
                echo $target_file;
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                
                
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
                
                
                // Check if file already exists
                if (file_exists($target_file)) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }
                
                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 5000000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                
                // Allow certain file formats 
                /*
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }*/
                
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $randomNameFile)) {
                    // insert image name on the database

                    $insert_db =  $conn->prepare("INSERT INTO publication (contenu, date_de_publication, admin_id, nom, postFileName) VALUES ( ?, ?, ?, ?, ?)");
                    $insert_db->execute(array($publication, $current_timestamp, $id, $user_info['nom'], $randomNameFile ));
                    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                    echo "option 1";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
                }
            
            }



            //===================== upload image =====================
     

    }

       // echo 'Envoyé';
        
         
       
    else if(!empty ($_POST['publication'])   ){ //if user doesn't upload any image
    
            if(strlen  ($_POST['publication']) > 360 ) {
                echo"360 caractèrs autorisé";
            } else {
    
                $publication = securisation (($_POST['publication'])   );
                $publication = nl2br($publication);
                $target_dir = "uploads_img/";
                $randomNameFile = randomName();
                $insert_db =  $conn->prepare("INSERT INTO publication (contenu, date_de_publication, admin_id, nom, postFileName) VALUES ( ?, ?, ?, ?, ?)");
                $insert_db->execute(array($publication, $current_timestamp, $id, $user_info['nom'], "NULL" ));

                echo "option 2";
            }
        }
    
    
    
    
    else  {
        echo " une erreur est survenue, veuillez rafraichir la page"; die();
    }
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
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/publication.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/fil.css">
    <link rel="stylesheet" href="css/dark-theme.css">
    <style>
 img {
    width: 100%;
    height: 100%;    
}.container-grid {
    padding: 13px;
    height: auto;
    font-size: large;
    font-size:23px;

}

</style>
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
                                <form action="#" method="POST"enctype="multipart/form-data" >

                                            <!-- text area -->
                                    <label class="mdc-text-field mdc-text-field--filled mdc-text-field--textarea mdc-text-field--no-label">
                                    <span class="mdc-text-field__ripple"></span>
                                    <span class="mdc-text-field__resizer"  style="border:2px solid #6200ee">
                                        <textarea class="mdc-text-field__input" rows="20" cols="50" aria-label="Label" name="publication" id="publication"></textarea>

                                    <img src="#"  alt="" class="viewer img-thumbnail img-fluid " id="viewer">
                                    </span>

                                    <span class="mdc-line-ripple"></span>
                                    </label> <br>
                                    <div class="mdc-card__actions">
                                            <!-- upload file icon -->
                                    <label class="material-icons mdc-icon-button mdc-card__action mdc-card__action--icon" title="Ajouter une image">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                        </svg>
                                        <input type="file" name="fileToUpload" id="fileToUpload"style="display:none">
                                    </label>


                                    
                      
                                    <button class="material-icons mdc-icon-button mdc-card__action mdc-card__action--icon" title="image">share</button>
                                    <button class="material-icons mdc-icon-button mdc-card__action mdc-card__action--icon" title="More options">more_vert</button>
                                    </div>
                                            <!-- submit button -->


                                    <button class="mdc-button mdc-button--raised mdc-button__label " id="btn" name="submit_btn">
                                        Envoyer
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
                 $postID =$row['id'];
                    
            ?>

                <div class="mdc-card container container-grid " style="width:600px;margin-bottom:12px;">
                    <div class="mdc-card__primary-action">
                        <div class="mdc-card__media mdc-card__media--square">
                            <div class="mdc-card__media-content"> 
                                <p>  <?= ($row['contenu']); ?></p> <!-- //publish content  --->
                                <?php if($row["postFileName"] !="NULL") { ?>
                                    <img src="upload_img/<?=$row["postFileName"]?>"  onError="removeElement(this);" alt="" class="viewer img-thumbnail img-fluid " id="viewer">
                                <?php
                                     }
                                ?>
                                
                                
                            </div>
                        </div> 
                        <p>Publié le :<?= htmlspecialchars($row['date_de_publication']); ?> par    <?= ($row['nom']); ?></p> <!-- //nom et date -->
                    
                    </div>
                    <div class="mdc-card__actions">
                        <div class="mdc-card__action-buttons">
                        <button class="mdc-button mdc-card__action mdc-card__action--button">
                            <div class="mdc-button__ripple"></div>
                            <?php if($row["admin_id"] ==$_SESSION['id']) { //if this is the user post ?>
                               <!-- trash file option -->
                               <label class="material-icons mdc-icon-button mdc-card__action mdc-card__action--icon" title="Ajouter une image" onClick="window.location.href='delete.php?id=<?= ($postID); ?>'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg> 
                                </label>
                                <?php
                                     }
                                ?>
                                
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


// stop form resubmission on page refresh?
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<script src="js/viewer.js"></script>

</body>
</html>
