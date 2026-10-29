<?php require_once __DIR__ . '/data.php';

try{
    if(isset($_POST['supprimer']) && isset($_SESSION['id'])){
    if(!empty($_POST['mdpSup'])){
        $password = $_POST['mdpSup'];
        $idUtilisateur = $_SESSION['id'];

        $rCheckCo=$pdoAniManga->prepare("SELECT c.id_compte , c.mdp_compte FROM compte c WHERE c.id_compte = ?");
        $rCheckCo->bindParam(1,$idUtilisateur,PDO::PARAM_INT);
        $rCheckCo->execute();
        $user = $rCheckCo->fetch(PDO::FETCH_ASSOC);

        if(password_verify($password , $user['mdp_compte'])){
            $rSupprimer=$pdoAniManga->prepare("DELETE FROM compte WHERE id_compte = ?");
            $rSupprimer->bindParam(1,$idUtilisateur,PDO::PARAM_INT);
            $rSupprimer->execute();

            header('Location: deconnection.php');
            exit;
        }else{
            $_SESSION['erreurSuppression'] = "Mot de passe incorrect !";
            header('Location: ../html/compte.php');
        }
    }}
    $_SESSION['erreurSuppression'] = "Mot de passe incorrect !";
    header('Location: ../html/compte.php');
    exit;
}catch(EXCEPTION $error){
    $_SESSION['erreurSuppression'] = "Mot de passe incorrect !";
    header('Location: ../html/compte.php');
    exit;
}?>