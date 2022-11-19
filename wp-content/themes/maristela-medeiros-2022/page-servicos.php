<?php
/*
Template Name: Serviços
*/
$estiloPagina = 'style.css';
require_once('header.php');
?>

<!--BANNER-->
<div class="jumbotron banner">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1>Serviços</h1>
      </div>
    </div>
  </div>
</div>

<main>
  <div class="conteudo">
    <div class="container">
      <div class="row conteudo__row">
        <?php
        $args = array(
          "post_type" => "servicos",
          "posts_per_page" => 2,
          "orderby" => "rand"
        );
        $posts = new WP_Query($args);

        if ($posts->have_posts()) : while ($posts->have_posts()) : $posts->the_post(); ?>

            <div class="col-12 col-sm-6 col-md-3 conteudo__card">
              <?php the_post_thumbnail('img-post'); ?>

              <div class="card-body">
                <h2 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php the_excerpt(); ?>
              </div>

              <div class="card-footer">
                <a href="<?php the_permalink(); ?>" class="link-mais" title="<?php the_title(); ?>">Ler mais ></a>
              </div>
            </div>

        <?php endwhile;
        endif; ?>
      </div>
    </div>
  </div>
</main>

<?php
require_once("modal.php");
get_footer();
?>