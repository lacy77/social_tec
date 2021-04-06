<?php

session_start() ;
require("db.php");
function securisation ($input) { //XML ATTACK, SQL injection  
    $input = htmlspecialchars($input);
    return $input;

}



if(isset($_POST['submit_btn'])) {
    if(!empty($_POST["user_name"]) AND !empty($_POST["e_mail"]) AND !empty($_POST["pwd1"]) AND !empty($_POST["pwd2"]) ) {
        $userName=securisation($_POST['user_name']);
        $e_mail=securisation($_POST['e_mail']);
        $pwd1=($_POST['pwd1']);
        $pwd2=($_POST['pwd2']);
        $current_timestamp = date('Y-m-d H:i:s');
        echo $current_timestamp;

        $bio = "pas de description";
        $classe = "" ;
        $age =  0;

        settype($userName, "string"); //  type string
        settype($e_mail, "string"); 
        
        if($pwd1 == $pwd2) {
            if(strlen($pwd1) > 7) {
                if(filter_var($e_mail, FILTER_VALIDATE_EMAIL)) {         // is a valid email address
                    if(preg_match("#^[a-z0-9A-Z_]{3,23}#i", $userName)){ //no special char on the name
                        $pwd = password_hash($pwd1, PASSWORD_DEFAULT);   //password_hash, salt depreciated
                        
                        $re = $conn->prepare("SELECT * FROM member where e_mail = ?");
                        $re->execute(array($e_mail));
                        if($re->rowCount() == 0) { //mail alreday exist
                            $insert_db =  $conn->prepare("INSERT INTO member (nom, e_mail, pwd, age, date_inscription, bio, classe) VALUES ( ?, ?, ?, ?, ?, ?, ?)");
                            $insert_db->execute(array($userName, $e_mail, $pwd,$age, $current_timestamp, $bio, $classe ));
                            echo 'connexion réussie';
                            header("Location:connexion.php");



                        } else {
                            echo "Ce mail existe déjà !";
                        }
                        

                    } else {
                        echo ("Ce pseudo n'est pas valide!");
                    }
                } else {
                    echo ("Mail invalide");
                }


            }else {
                echo ("Le mot de passe doit contenir au moins 8 caractères");
            }

        }else {
            echo ("Les mots de passe ne sont pas identique");

        }


        
    } else {
        echo ("tous les champs ne sont pas complétés");
    }
}



?>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/login.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>    
    
    </head>

    <body>
        <form method="post" action='#'>
            <div class="form">
            <div class="form-toggle"></div>
            <div class="form-panel one">
                <div class="form-header">
                <h1>Inscription - Social Tec</h1>
                </div>
                <div class="form-content">
                <form>
                    <div class="form-group">
                    <label for="username">Nom :</label>
                    <input type ="text" placeholder="nom" name="user_name" id="name" required="required"> 
                    </div>
                    
                    <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="pwd2" required="required"/>
                    </div>

                    <div class="form-group">
                    <label for="password">Mot de passe (confirmation):</label>
                    <input type="password" id="password" name="pwd1" required="required"/>
                    </div>

                    <div class="form-group">
                    <label for="password">E-mail:</label>
                    <input type="email" id="e-mail" name="e_mail" required="required"/>
                    </div>

                    <div class="form-group">
                    <label class="form-remember">
                        <input type="checkbox"/>Remember Me
                    </label><a class="form-recovery" href="#">Forgot Password?</a>
                    </div>
                    <div class="form-group">
                    <button type ="submit" value="soumettre" name='submit_btn' id="submit_btn">S'inscrire</button>
                    </div>
                </form>
                </div>
            </div> 
            
            <!-- Footer   -->

        
    </body>
</html>