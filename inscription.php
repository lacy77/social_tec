<?php

function securisation ($input) { //XML ATTACK, injection SQL 
    $input = htmlspecialchars($input);
    return $input;

}



session_start() ;
if(isset($_POST['submit_btn'])) {
    if(!empty($_POST["user_name"]) AND !empty($_POST["e_mail"]) AND !empty($_POST["pwd1"]) AND !empty($_POST["pwd2"]) ) {
        $userName=securisation($_POST['user_name']);
        $e_mail=securisation($_POST['e_mail']);
        $pwd1=($_POST['pwd1']);
        $pwd2=($_POST['pwd2']);

        settype($userName, "string"); // de type string
        settype($e_mail, "string"); 
        
        if($pwd1 == $pwd2) {
            if($pwd1 < 7) {
                echo ("ok");

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

<form method="post" action='#'>
    <input type ="text" placeholder="nom" name="user_name" id="name"> 
    <input type ="email" placeholder="e-mail" name="e_mail" id="e-mail"> 
    <input type ="password" placeholder="password" name="pwd1" id="pwd2"> 
    <input type ="password" placeholder="password (confirmation)" name="pwd2" id="pwd2"> 
    <input type ="submit" value="soumettre" name='submit_btn' id="submit_btn"> 

</form>