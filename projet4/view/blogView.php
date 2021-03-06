<?php $title = 'Blog'; ?>

<?php ob_start(); ?>

<section id="posts">

<?php while ($data = $allPosts->fetch())
{
?>
  <div class="post">

      <h1><?=($data['title']) ?></h1>

      <h2>Publié le <em><?= $data['date_post_fr'] ?></em></h2>

      <p><?= nl2br(substr($data['content'], 0, 300)) ?> (...)</p>

      <p class="read-button">
        <a href="<?=$GLOBALS['nomDeDomaine']?>?url=post&amp;id=<?= $data['id'] ?>">Lire le chapitre</a>
      </p>
      <?php if (isset($_SESSION['connected']))
            {
            ?>
              <a href ="<?=$GLOBALS['nomDeDomaine']?>?url=blog&deletePost=<?= $data['id'] ?>">Supprimer</a>
              <a href ="<?=$GLOBALS['nomDeDomaine']?>?url=blog&id=<?= $data['id'] ?>">Modifier</a>
      <?php
            }
      ?>
  </div>
<?php  
}
$allPosts->closeCursor();
?>
    
</section>

<?php $content = ob_get_clean(); ?>


<?php require('template.php'); ?>