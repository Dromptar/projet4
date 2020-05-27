<?php 

if(!isset($_SESSION)){

    session_start();
}


 $title = 'Espace Admin'; ?>



<?php ob_start(); ?>

<p id="session"><?= $_SESSION['connected']?><br/>
<a href="index.php?url=logout">Déconnexion</a></p>




<section id="edition">

    <form action="" method="post">
            <div>
                <input type="text" id="author" name="author" placeholder="Auteur"/>
                <input type="text" id="title" name="title" placeholder="Titre"/>
                <input type="text" id="quote" name="quote" placeholder="Citation"/>
            </div>
            <div>
                <textarea id="texteditor" name="texteditor">Hello, World!</textarea>
            </div>
            <div>
                <input type="submit" name="publish" value="Publier" />
            </div>
    </form>




</section>

<script src="public/js/textEditor.js"></script>

<?php $content = ob_get_clean(); ?>



<?php require('template.php'); ?>


