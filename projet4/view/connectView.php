<?php 

if(!isset($_SESSION)){

    session_start();
}


$title = 'Connexion'; ?>

<?php ob_start(); ?>

<section id="connect">

    <div id="connect_formulaire">

        <form class="logs" action="<?=$GLOBALS['nomDeDomaine']?>?url=connection" method="POST">

            <input class="logsInput" type="text" name="pseudo" placeholder="Identifiant" required/>
            <input class="logsInput" type="password" name="pass" placeholder="Mot de Passe" required/>
            <!--<label>Connexion automatique <input type="checkbox"  name="connexion" checked> </label> !-->
            <input class="validateInput" type="submit" name="connexion" value="Se connecter" />

        </form>

        <p>Pas encore de compte ?<br/><a href="<?=$GLOBALS['nomDeDomaine']?>?url=register">Inscrivez-Vous !</a></p>

    </div>

</section>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>