<?php
session_start();
require("db.php");
if(empty($_GET['id']))
 {
     die();
 }

$user_id = $_SESSION['id'];


if(!empty($_GET['id'])) {     $id = $_GET['id'];
    settype($id, "integer"); 
  //  echo $id;


    $req = $conn->prepare("SELECT * FROM publication WHERE id = ?");
    $req->execute(array($id));
    
    $publish_info = $req->fetch();
    echo $publish_info['admin_id'] . " = " . $id;

    if($_SESSION['id'] == $publish_info['admin_id']) {
        if(isset($_POST["submit_btn"]) ) {
            $supp = $conn->prepare("DELETE FROM publication WHERE id= ?");
            $supp->execute(array($id)); echo "supprié";

        } else {
            echo "non";
        }

        

    } else {
        echo "publication inexistante";
       // header("Location:erreur404.html");
        die();
    }
} else {
    die();
}


?>

<!DOCTYPE html>
<html>
<body>

<h1>Une suppression est définitive!</h1>

<p>Etes vous sur de vouloir supprimer le poste ?</p>
<form action="" method="POST">
                                    <button class="mdc-button mdc-button--raised mdc-button__label " id="btn" name="submit_btn">
                                        Oui
                                    </button>

</form>

<button type="submit" form="nameform" name="non" value="Submit" onclick="window.location.href='fil_d_actu.php?id= <?=$user_id; ?>'">Non</button>

</body>
</html>
