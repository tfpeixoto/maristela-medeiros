<?php
/*
Template Name: Home
*/
$estiloPagina = 'home.css';
require_once('header.php');
?>

<div class="jumbotron banner">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-8 banner__puv">
        <?php
        $args = array(
          "post_type" => "page",
          "p" => 5,
        );
        $home = new WP_Query($args);
        if ($home->have_posts()) : while ($home->have_posts()) : $home->the_post(); ?>

            <h1><?php the_title(); ?></h1>

        <?php endwhile;
        endif; ?>

        <a type="button" href="#servicos" class="btn btn-lg">Conheça os serviços</a>
      </div>
    </div>
  </div>
</div>

<div id="quem-sou" class="quemsomos">
  <div class="container">
    <?php
    $args = array(
      "post_type" => "page",
      "p" => 2,
    );
    $quemsomos = new WP_Query($args);

    if ($quemsomos->have_posts()) : while ($quemsomos->have_posts()) : $quemsomos->the_post(); ?>

        <div class="row align-items-center justify-content-center">
          <div class="col-12 col-md-5 quemsomos__image">
            <?php the_post_thumbnail('img-perfil', array('class' => 'img-fluid')); ?>
          </div>

          <div class="col-12 col-md-7 quemsomos__conteudo">
            <h2><?php the_title(); ?></h2>

            <?php the_content(); ?>
          </div>
        </div>

    <?php endwhile;
    endif; ?>

    <div class="row">
      <div class="col-12 quemsomos__empresas">
        <ul>
          <?php
          $args = array(
            "post_type" => "empresas",
            "orderby" => "rand",
          );
          $empresas = new WP_Query($args);

          if ($empresas->have_posts()) : while ($empresas->have_posts()) : $empresas->the_post(); ?>

              <li><?php the_post_thumbnail(); ?></li>

          <?php endwhile;
          endif; ?>
        </ul>
      </div>
    </div>
  </div>
</div>

<div id="servicos" class="servicos">
  <div class="container">
    <div class="row">
      <div class="col-12 servicos__titulo">
        <h2>Serviços</h2>
      </div>
    </div>

    <div class="row servicos__lista">
      <div class="servicos__box">
        <img src="<?= get_template_directory_uri(); ?>/images/icone-auditorias.png" width="120" height="120" loading="lazy" alt="auditorias">

        <div class="servicos-conteudo">
          <h3>Auditorias</h3>
          <p>Apuração de possíveis inconformidades e situações irregulares pelos padrões determinados pela Vigilância Sanitária, visando a prevenção de autuações e riscos de contaminação.</p>
          <a href="auditorias" type="button" class="btn btn-primary">Saiba mais</a>
        </div>
      </div>

      <div class="servicos__box">
        <img src="<?= get_template_directory_uri(); ?>/images/icone-consultorias.png" width="120" height="120" loading="lazy" alt="consultorias">

        <div class="servicos-conteudo">
          <h3>Consultorias</h3>
          <p>Orientação e acompanhamento para aperfeiçoamentos nas técnicas, segurança dos alimentos, planejamento, precificação, assegurando a aplicação das melhores práticas de produção.</p>
          <a href="consultorias" type="button" class="btn btn-primary">Saiba mais</a>
        </div>
      </div>

      <div class="servicos__box">
        <img src="<?= get_template_directory_uri(); ?>/images/icone-treinamentos.png" width="120" height="120" loading="lazy" alt="treinamentos">

        <div class="servicos-conteudo">
          <h3>Treinamentos</h3>
          <p>Capacitações técnicas para empresas, com conteúdo adaptável de acordo com a necessidade do cliente e porte da equipe, apoiando o desenvolvimento e padronização de processos.</p>
          <a href="servicos" type="button" class="btn btn-primary">Saiba mais</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="cta" class="cta">
  <div class="container">
    <div class="row">
      <?php
      $args = array(
        "post_type" => "page",
        "p" => 26,
      );
      $cta = new WP_Query($args);

      if ($cta->have_posts()) : while ($cta->have_posts()) : $cta->the_post(); ?>

          <div class="col-12 col-md-5 cta__imagem">
            <?php the_post_thumbnail('img-cta', array('class' => 'img-fluid')); ?>
          </div>

          <div class="col-12 col-md-7 cta__conteudo">
            <h3><?php the_content(); ?></h3>

            <a href="#" class="btn btn-primary btn-lg" role="button" data-toggle="modal" data-target="#SolicitaContato">Entre em contato</a>
          </div>

      <?php endwhile;
      endif; ?>
      <?php wp_reset_query(); ?>
    </div>
  </div>
</div>

<div id="depoimentos" class="depoimentos">
  <div class="container">
    <div class="row">
      <div class="col-12 depoimentos__titulo">
        <h2>Depoimentos</h2>
        <p>O que dizem os clientes</p>
      </div>
    </div>

    <div class="row">
      <?php
      $args = array(
        "post_type" => "depoimentos",
        "posts_per_page" => 2,
      );
      $depoimentos = new WP_Query($args);

      if ($depoimentos->have_posts()) : while ($depoimentos->have_posts()) : $depoimentos->the_post(); ?>

          <div class="col-12 col-md-6 depoimentos__box">
            <a href="#" class="depoimentos__link" data-toggle="modal" data-target="#tab-<?php the_id(); ?>" title="<?php the_title(); ?>">
              <?php the_post_thumbnail('img-depoimentos', array('class' => 'img-fluid')); ?>

              <div class="depoimentos__conteudo">
                <?php the_content(); ?>
                <h3><?php the_title(); ?></h3>
              </div>
            </a>
          </div>

          <div class="modal" id="tab-<?php the_id(); ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title h5"><?php the_title(); ?></h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  <?php the_field('video'); ?>

                  <p class="text-center">Pause a reprodução do vídeo antes de fechar a janela</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
              </div>
            </div>
          </div>

      <?php endwhile;
      endif; ?>
      <?php wp_reset_query(); ?>
    </div>
  </div>
</div>


<div id="blog" class="blog">
  <div class="container">
    <div class="row blog__row">
      <div class="col-12 col-md-4 blog__titulo">
        <h2>Blog</h2>
        <p>Aqui você fica informado sobre todas as novidades do mundo da nutrição corporativa.</p>

        <a role="button" href="/blog" class="btn btn-primary">Ver todos os posts</a>
      </div>

      <?php
      $args = array(
        "post_type" => "post",
        "posts_per_page" => 2,
      );
      $posts = new WP_Query($args);

      if ($posts->have_posts()) : while ($posts->have_posts()) : $posts->the_post(); ?>

          <div class="col-10 col-md-4 blog__card">
            <div class="blog__image">
              <?php the_post_thumbnail('img-post', array('class' => 'img-fluid')); ?>
            </div>

            <div class="blog__conteudo">
              <h3><a href="<?php the_permalink(); ?>" class="text-marrom-claro"><?php the_title(); ?></a></h3>

              <?php the_excerpt(); ?>

              <a href="<?php the_permalink(); ?>" class="leia-mais">Ler mais ></a>
            </div>
          </div>

      <?php endwhile;
      endif; ?>
    </div>
  </div>
</div>

<?php
require_once("template-parts/modal.php");
require_once('footer.php');
?>