<?php
$estiloPagina = 'style.css';
require_once('header.php');
?>

<div class="jumbotron banner-interno">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1>Blog</h1>
      </div>
    </div>
  </div>
</div>

<!--MODAL-->
<?php require_once("modal.php"); ?>

<main>
  <div class="conteudo-boxes">
    <div class="container">
      <div class="row conteudo-boxes__row">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <div class="col-11 col-sm-6 col-md-3 conteudo-boxes__card">
              <a href="<?php the_permalink(); ?>" class="conteudo-boxes__link">
                <?php
                if (has_post_thumbnail())
                  the_post_thumbnail('img-post');
                else
                  echo "<div class='conteudo-boxes__foto'></div>";
                ?>

                <div class="conteudo-boxes__body">
                  <h2 class="conteudo-boxes__title"><?php the_title(); ?></h2>
                  <?php the_excerpt(); ?>
                </div>
              </a>
            </div>

        <?php endwhile;
        endif; ?>
      </div>
    </div>
  </div>
</main>

<?php
require_once("template-parts/modal.php");
require_once('footer.php');
?>