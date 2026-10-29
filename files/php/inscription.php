<?php require_once __DIR__ . '/data.php';

try{
    if(isset($_POST['inscription'])){
    if(!empty($_POST['emailIn']) && !empty($_POST['mdpIn'])){
    if(filter_var($_POST['emailIn'],FILTER_VALIDATE_EMAIL) && strlen($_POST['mdpIn']) >= 8){
        $email = trim($_POST['emailIn']);
        $password = password_hash($_POST['mdpIn'],PASSWORD_DEFAULT);

        $rCheckCo=$pdoAniManga->prepare("SELECT c.id_compte FROM compte c WHERE c.email_compte = ?");
        $rCheckCo->bindParam(1,$email,PDO::PARAM_STR);
        $rCheckCo->execute();
        $user = $rCheckCo->fetch(PDO::FETCH_ASSOC);

        if(!empty($user)){
            $_SESSION['erreurInscription'] = "Cette adresse E-mail n'est pas disponible.";
            header('Location: ../html/compte.php');
            exit;
        }else{

            $creationCompte=$pdoAniManga->prepare("INSERT INTO compte (email_compte , mdp_compte) VALUE (?,?)");
            $creationCompte->bindParam(1,$email,PDO::PARAM_STR);
            $creationCompte->bindParam(2,$password,PDO::PARAM_STR);
            $creationCompte->execute();

            $rId=$pdoAniManga->prepare("SELECT c.id_compte FROM compte c WHERE c.email_compte = ?");
            $rId->bindParam(1,$email,PDO::PARAM_STR);
            $rId->execute();
            $user = $rId->fetch(PDO::FETCH_ASSOC);

            session_regenerate_id(true);
            $_SESSION['id'] = $user['id_compte'];
            header('Location: ../html/compte.php');
            exit;
        }
    }}}
    $_SESSION['erreurInscription'] = "Champ(s) invalide(s).";
    header('Location: ../html/compte.php');
    exit;
}catch (Exception $error) {
    die($error->getMessage());
}?>