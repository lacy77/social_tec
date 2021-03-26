<?php
session_start();
require("db.php");

function securisation ($input) { //XML ATTACK, SQL injection  
    $input = htmlspecialchars($input);
    return $input;

}

if(isset($_POST['submit_btn'])) {
    if(!empty($_POST['e_mail']) && !empty($_POST['pwd'])) {
        $e_mail=securisation($_POST['e_mail']);
        $pwd=($_POST['pwd']);


        $req = $conn->prepare("SELECT * FROM member WHERE e_mail = ?");
        $req->execute(array($e_mail));

        

        if($req->rowCount() == 1) {
            $user_info = $req->fetch();

            if(password_verify($pwd, $user_info[3])) {

                $_SESSION['id'] = $user_info['id'];

                header('Location:fil_d_actu.php?id='.$_SESSION['id']); 
                echo "ok";
            } else {
                echo "Ideantifiants incorrect";
            }


        } else {
            echo "Ideantifiants inexistant";
        }



    } else 
        echo "Les deux champs ne sont pas complétés!";
}










?>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/login.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>    
    
    </head>

    <body>
        <div class="content">

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
                                <label for="e_mail">E-mail:</label>
                                <input type="email" id="e-mail" name="e_mail" required="required"/>
                                </div>

                                
                                <div class="form-group">
                                <label for="password">Mot de passe :</label>
                                <input type="password" id="password" name="pwd" required="required"/>
                                </div>

                                <div class="form-group">
                                <button type ="submit" value="soumettre" name='submit_btn' id="submit_btn">Se connecter</button>
                                </div>
                            </form>
                        </div>
                </div> 
            </div>
        </div>
            
            <!-- Footer   -->

        
    </body>
</html>