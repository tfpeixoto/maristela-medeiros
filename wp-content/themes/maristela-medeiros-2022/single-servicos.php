<?php
/*
Template Name: Serviços
*/
$estiloPagina = 'style.css';
require_once('header.php');

if (have_posts()) : while (have_posts()) : the_post(); ?>

    <div class="jumbotron banner-interno">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1><?php the_title(); ?></h1>
          </div>
        </div>
      </div>
    </div>

    <main>
      <div class="servicos-conteudo">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-12 col-md-5 servicos-conteudo__image">
              <?php the_post_thumbnail('img-post-wide', array('class' => 'img-fluid')); ?>
            </div>

            <div class="col-12 col-md-7 servicos-conteudo__content">
              <?php the_content(); ?>

              <a href="javascript:history.back()" title="Voltar" class="servicos-conteudo__btn">- Voltar para lista de serviços</a>
            </div>
          </div>
        </div>
      </div>
    </main>

<?php
  endwhile;
endif;

require_once("template-parts/modal.php");
require_once('footer.php');
?>