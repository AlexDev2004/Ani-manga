<?php require_once __DIR__ . '/../php/data.php';?>

<!-- ------------------------------------------------------------------- -->

<?php include '../includes/header.php';?>
    <main>
        <section id="compte">
            <?php if(isset($_SESSION['id'])){
                try{
                    $idUtilisateur = $_SESSION['id'];
                    $rUser=$pdoAniManga->prepare("SELECT c.email_compte , c.date_creation_compte FROM compte c WHERE c.id_compte = ?");
                    $rUser->bindParam(1,$idUtilisateur,PDO::PARAM_INT);
                    $rUser->execute();
                    $user = $rUser->fetch(PDO::FETCH_ASSOC);
                    $email = $user['email_compte'];
                    $date = date('d/m/Y à H:i', strtotime($user['date_creation_compte']));
                }catch(EXCEPTION $error){die($error->getMessage());}
                
                echo("<article class='log'>
                    <h2>Mon compte :</h2>
                    <p>E-mail du compte : $email </p>
                    <p>Compte créé le : $date </p>
                    <a href='../php/deconnection.php'>Se déconnecter</a>
                </article>
                <article class='log'>
                    <h2>Supprimer le compte</h2>
                    <form method='post' action='../php/supprimer.php'>
                        <label for='mdpSup'>Confirmer votre mot de passe</label>
                        <input type='password' name='mdpSup' id='mdpSup' required>
                        <button type='submit' name='supprimer'>Supprimer</button>
                        "); if (isset($_SESSION['erreurSuppression'])) {
                        echo ("<p class='erreurConnexion'>$_SESSION[erreurSuppression]</p>");
                        unset($_SESSION['erreurSuppression']);
                        } echo("                        
                    </form>
                </article>
            ");}else{ echo("
                <article class='unlog'>
                    <h2>Connection :</h2>
                    <form action='../php/connection.php' method='post'>
                        <label for='emailCo'>Adresse E-mail</label>
                        <input type='email' name='emailCo' id='emailCo' required>
                        <label for='mdpCo'>Mot de passe</label>
                        <input type='password' name='mdpCo' id='mdpCo' required>
                        <button type='submit' name='connection'>Se connecter</button>
                        "); if (isset($_SESSION['erreurConnexion'])) {
                            echo ("<p class='erreurConnexion'>$_SESSION[erreurConnexion]</p>");
                            unset($_SESSION['erreurConnexion']);
                        } echo("
                    </form>
                </article>
                <article class='unlog'>
                    <h2>Inscription :</h2>
                    <form action='../php/inscription.php' method='post'>
                        <label for='emailIn'>Adresse E-mail</label>
                        <input type='email' name='emailIn' id='emailCoIn' required>
                        <label for='mdpIn'>Mot de passe</label>
                        <input type='password' name='mdpIn' id='mdpIn' required>
                        <button type='submit' name='inscription'>S'inscrire</button>
                        "); if (isset($_SESSION['erreurInscription'])) {
                            echo ("<p class='erreurConnexion'>$_SESSION[erreurInscription]</p>");
                            unset($_SESSION['erreurInscription']);
                        } echo("
                    </form>
                </article>
            ");}?>
        </section>
    </main>
