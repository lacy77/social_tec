<?php
require("db.php");

function securisation ($input) { //XML ATTACK, SQL injection  
    $input = htmlspecialchars($input);
    return $input;

}



session_start() ;



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
                    <label for="password">E-mail:</label>
                    <input type="email" id="e-mail" name="e_mail" required="required"/>
                    </div>

                    
                    <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="pwd2" required="required"/>
                    </div>

                    <div class="form-group">
                    <button type ="submit" value="soumettre" name='submit_btn' id="submit_btn">Se connecter</button>
                    </div>
                </form>
                </div>
            </div> 
            
            <!-- Footer   -->

        
    </body>
</html>