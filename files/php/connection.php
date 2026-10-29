<?php require_once __DIR__ . '/data.php';

try{
    if(isset($_POST['connection'])){
    if(!empty($_POST['emailCo']) && !empty($_POST['mdpCo'])){
    if(filter_var($_POST['emailCo'],FILTER_VALIDATE_EMAIL)){
        $email = trim($_POST['emailCo']);
        $password = $_POST['mdpCo'];

        $rCheckCo=$pdoAniManga->prepare("SELECT c.id_compte , c.mdp_compte FROM compte c WHERE c.email_compte = ?");
        $rCheckCo->bindParam(1,$email,PDO::PARAM_STR);
        $rCheckCo->execute();
        $user = $rCheckCo->fetch(PDO::FETCH_ASSOC);

        if(empty($user)){
            $_SESSION['erreurConnexion'] = "Adresse e-mail ou mot de passe incorrect.";
            header('Location: ../html/compte.php');
            exit;
        }else{
            if(password_verify($password , $user['mdp_compte'])){
                session_regenerate_id(true);
                $_SESSION['id'] = $user['id_compte'];
                header('Location: ../html/compte.php');
                exit;
            }else{
            $_SESSION['erreurConnexion'] = "Adresse e-mail ou mot de passe incorrect.";
            header('Location: ../html/compte.php');
            exit;
            }
        }
    }}}
    $_SESSION['erreurConnexion'] = "Adresse e-mail ou mot de passe incorrect.";
    header('Location: ../html/compte.php');
    exit;
}catch(EXCEPTION $error){
    $_SESSION['erreurConnexion'] = "Adresse e-mail ou mot de passe incorrect.";
    header('Location: ../html/compte.php');
    exit;
}?>