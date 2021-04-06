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
    // verify if the id exist 

    $req_id = $conn->prepare("SELECT * FROM member WHERE id = ?");
    $req_id->execute(array($id)); 
    if($req_id->rowCount() == 0) { die(); }





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



<!-- profile -->
<div class="wrapper">

  
  <div class="profile-card js-profile-card">
    <div class="profile-card__img">
      <img src="https://ih1.redbubble.net/image.746085651.7876/flat,750x,075,f-pad,750x1000,f8f8f8.u2.jpg" alt="profile card">
    </div>

    <div class="profile-card__cnt js-profile-cnt">
      <div class="profile-card__name">meteor </div>
      <div class="profile-card__txt">Front-end Developer from <strong>Mesopotamia</strong></div>
      <div class="profile-card-loc">
        <span class="profile-card-loc__icon">
          <svg class="icon"><use xlink:href="#icon-location"></use></svg>
        </span>

        <span class="profile-card-loc__txt">
          Istanbul, Turkey
        </span>
      </div>

      <div class="profile-card-inf">
        <div class="profile-card-inf__item">
          <div class="profile-card-inf__title">1598</div>
          <div class="profile-card-inf__txt">Followers</div>
        </div>

        <div class="profile-card-inf__item">
          <div class="profile-card-inf__title">65</div>
          <div class="profile-card-inf__txt">Following</div>
        </div>

        <div class="profile-card-inf__item">
          <div class="profile-card-inf__title">123</div>
          <div class="profile-card-inf__txt">Articles</div>
        </div>

        <div class="profile-card-inf__item">
          <div class="profile-card-inf__title">85</div>
          <div class="profile-card-inf__txt">Works</div>
        </div>
      </div>

      <div class="profile-card-ctr">
      <?php
         // if($id != $_SESSION['id']) {
      ?> 
      <button class="btn btn-primary" >
          
 <a href="<?='follow.php?follower_id=' . $_SESSION['id'] .  '&following_id=' . $id . "&return_to=profile.php&id=" . $id?>">Suivre</a> </button>
        <?php
         // }
      ?>

        <button class="profile-card__button button--orange">Envoyer un message</button>
      </div>
    </div>

    <div class="profile-card-message js-message">
      <form class="profile-card-form">
        <div class="profile-card-form__container">
          <textarea placeholder="Say something..."></textarea>
        </div>

        <div class="profile-card-form__bottom">
          <button class="profile-card__button button--blue js-message-close">
            Send
          </button>

          <button class="profile-card__button button--gray js-message-close">
            Cancel
          </button>
        </div>
      </form>

      <div class="profile-card__overlay js-message-close"></div>
    </div>

  </div>

</div>



<style>
@import url("https://fonts.googleapis.com/css?family=Quicksand:400,500,700&subset=latin-ext");
html {
  position: relative;
  overflow-x: hidden !important;
}

* {
  box-sizing: border-box;
}

body {
  font-family: "Quicksand", sans-serif;
  color: #324e63;
}

a, a:hover {
  text-decoration: none;
}

.icon {
  display: inline-block;
  width: 1em;
  height: 1em;
  stroke-width: 0;
  stroke: currentColor;
  fill: currentColor;
}

.wrapper {
  width: 100%;
  width: 100%;
  height: auto;
  min-height: 100vh;
  padding: 50px 20px;
  padding-top: 100px;
  display: flex;
}
@media screen and (max-width: 768px) {
  .wrapper {
    height: auto;
    min-height: 100vh;
    padding-top: 100px;
  }
}

.profile-card {
  width: 100%;
  min-height: 460px;
  margin: auto;
  box-shadow: 0px 8px 60px -10px rgba(13, 28, 39, 0.6);
  background: #fff;
  border-radius: 12px;
  max-width: 700px;
  position: relative;
}
.profile-card.active .profile-card__cnt {
  filter: blur(6px);
}
.profile-card.active .profile-card-message,
.profile-card.active .profile-card__overlay {
  opacity: 1;
  pointer-events: auto;
  transition-delay: 0.1s;
}
.profile-card.active .profile-card-form {
  transform: none;
  transition-delay: 0.1s;
}
.profile-card__img {
  width: 150px;
  height: 150px;
  margin-left: auto;
  margin-right: auto;
  transform: translateY(-50%);
  border-radius: 50%;
  overflow: hidden;
  position: relative;
  z-index: 0;
  box-shadow: 0px 5px 50px 0px #6c44fc, 0px 0px 0px 7px rgba(107, 74, 255, 0.5);
}
@media screen and (max-width: 576px) {
  .profile-card__img {
    width: 120px;
    height: 120px;
  }
}
.profile-card__img img {
  display: block;
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 50%;
}
.profile-card__cnt {
  margin-top: -35px;
  text-align: center;
  padding: 0 20px;
  padding-bottom: 40px;
  transition: all 0.3s;
}
.profile-card__name {
  font-weight: 700;
  font-size: 24px;
  color: #6944ff;
  margin-bottom: 15px;
}
.profile-card__txt {
  font-size: 18px;
  font-weight: 500;
  color: #324e63;
  margin-bottom: 15px;
}
.profile-card__txt strong {
  font-weight: 700;
}
.profile-card-loc {
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 18px;
  font-weight: 600;
}
.profile-card-loc__icon {
  display: inline-flex;
  font-size: 27px;
  margin-right: 10px;
}
.profile-card-inf {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  align-items: flex-start;
  margin-top: 35px;
}
.profile-card-inf__item {
  padding: 10px 35px;
  min-width: 150px;
}
@media screen and (max-width: 768px) {
  .profile-card-inf__item {
    padding: 10px 20px;
    min-width: 120px;
  }
}
.profile-card-inf__title {
  font-weight: 700;
  font-size: 27px;
  color: #324e63;
}
.profile-card-inf__txt {
  font-weight: 500;
  margin-top: 7px;
}
.profile-card-social {
  margin-top: 25px;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
}
.profile-card-social__item {
  display: inline-flex;
  width: 55px;
  height: 55px;
  margin: 15px;
  border-radius: 50%;
  align-items: center;
  justify-content: center;
  color: #fff;
  background: #405de6;
  box-shadow: 0px 7px 30px rgba(43, 98, 169, 0.5);
  position: relative;
  font-size: 21px;
  flex-shrink: 0;
  transition: all 0.3s;
}
@media screen and (max-width: 768px) {
  .profile-card-social__item {
    width: 50px;
    height: 50px;
    margin: 10px;
  }
}
@media screen and (min-width: 768px) {
  .profile-card-social__item:hover {
    transform: scale(1.2);
  }
}
.profile-card-social__item.facebook {
  background: linear-gradient(45deg, #3b5998, #0078d7);
  box-shadow: 0px 4px 30px rgba(43, 98, 169, 0.5);
}
.profile-card-social__item.twitter {
  background: linear-gradient(45deg, #1da1f2, #0e71c8);
  box-shadow: 0px 4px 30px rgba(19, 127, 212, 0.7);
}
.profile-card-social__item.instagram {
  background: linear-gradient(45deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d);
  box-shadow: 0px 4px 30px rgba(120, 64, 190, 0.6);
}
.profile-card-social__item.behance {
  background: linear-gradient(45deg, #1769ff, #213fca);
  box-shadow: 0px 4px 30px rgba(27, 86, 231, 0.7);
}
.profile-card-social__item.github {
  background: linear-gradient(45deg, #333333, #626b73);
  box-shadow: 0px 4px 30px rgba(63, 65, 67, 0.6);
}
.profile-card-social__item.codepen {
  background: linear-gradient(45deg, #324e63, #414447);
  box-shadow: 0px 4px 30px rgba(55, 75, 90, 0.6);
}
.profile-card-social__item.link {
  background: linear-gradient(45deg, #d5135a, #f05924);
  box-shadow: 0px 4px 30px rgba(223, 45, 70, 0.6);
}
.profile-card-social .icon-font {
  display: inline-flex;
}
.profile-card-ctr {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 40px;
}
@media screen and (max-width: 576px) {
  .profile-card-ctr {
    flex-wrap: wrap;
  }
}
.profile-card__button {
  background: none;
  border: none;
  font-family: "Quicksand", sans-serif;
  font-weight: 700;
  font-size: 19px;
  margin: 15px 35px;
  padding: 15px 40px;
  min-width: 201px;
  border-radius: 50px;
  min-height: 55px;
  color: #fff;
  cursor: pointer;
  backface-visibility: hidden;
  transition: all 0.3s;
}
@media screen and (max-width: 768px) {
  .profile-card__button {
    min-width: 170px;
    margin: 15px 25px;
  }
}
@media screen and (max-width: 576px) {
  .profile-card__button {
    min-width: inherit;
    margin: 0;
    margin-bottom: 16px;
    width: 100%;
    max-width: 300px;
  }
  .profile-card__button:last-child {
    margin-bottom: 0;
  }
}
.profile-card__button:focus {
  outline: none !important;
}
@media screen and (min-width: 768px) {
  .profile-card__button:hover {
    transform: translateY(-5px);
  }
}
.profile-card__button:first-child {
  margin-left: 0;
}
.profile-card__button:last-child {
  margin-right: 0;
}
.profile-card__button.button--blue {
  background: linear-gradient(45deg, #1da1f2, #0e71c8);
  box-shadow: 0px 4px 30px rgba(19, 127, 212, 0.4);
}
.profile-card__button.button--blue:hover {
  box-shadow: 0px 7px 30px rgba(19, 127, 212, 0.75);
}
.profile-card__button.button--orange {
  background: linear-gradient(45deg, #d5135a, #f05924);
  box-shadow: 0px 4px 30px rgba(223, 45, 70, 0.35);
}
.profile-card__button.button--orange:hover {
  box-shadow: 0px 7px 30px rgba(223, 45, 70, 0.75);
}
.profile-card__button.button--gray {
  box-shadow: none;
  background: #dcdcdc;
  color: #142029;
}
.profile-card-message {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  padding-top: 130px;
  padding-bottom: 100px;
  opacity: 0;
  pointer-events: none;
  transition: all 0.3s;
}
.profile-card-form {
  box-shadow: 0 4px 30px rgba(15, 22, 56, 0.35);
  max-width: 80%;
  margin-left: auto;
  margin-right: auto;
  height: 100%;
  background: #fff;
  border-radius: 10px;
  padding: 35px;
  transform: scale(0.8);
  position: relative;
  z-index: 3;
  transition: all 0.3s;
}
@media screen and (max-width: 768px) {
  .profile-card-form {
    max-width: 90%;
    height: auto;
  }
}
@media screen and (max-width: 576px) {
  .profile-card-form {
    padding: 20px;
  }
}
.profile-card-form__bottom {
  justify-content: space-between;
  display: flex;
}
@media screen and (max-width: 576px) {
  .profile-card-form__bottom {
    flex-wrap: wrap;
  }
}
.profile-card textarea {
  width: 100%;
  resize: none;
  height: 210px;
  margin-bottom: 20px;
  border: 2px solid #dcdcdc;
  border-radius: 10px;
  padding: 15px 20px;
  color: #324e63;
  font-weight: 500;
  font-family: "Quicksand", sans-serif;
  outline: none;
  transition: all 0.3s;
}
.profile-card textarea:focus {
  outline: none;
  border-color: #8a979e;
}
.profile-card__overlay {
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  pointer-events: none;
  opacity: 0;
  background: rgba(22, 33, 72, 0.35);
  border-radius: 12px;
  transition: all 0.3s;
}
</style>


<!-- profile -->


                

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
