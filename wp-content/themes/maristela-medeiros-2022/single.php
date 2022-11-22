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

<main>
  <div class="post">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 post__texto">
          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

              <?php the_post_thumbnail('img-post-wide'); ?>
              <h1><?php the_title(); ?></h1>
              <div class="post__info">
                <ul>
                  <li><?php the_date('d.m.Y'); ?></li>
                  <li> - </li>
                  <li>Por <?php the_author(); ?></li>
                </ul>
              </div>
              <?php the_content(); ?>

          <?php endwhile;
          endif; ?>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
require_once("modal.php");
get_footer();
?>