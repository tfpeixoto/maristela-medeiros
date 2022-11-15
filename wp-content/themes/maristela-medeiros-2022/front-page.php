<?php
/*
Template Name: Home
*/
$estiloPagina = 'style.css';
require_once('header.php');
?>

<!--BANNER-->
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

<!--QUEM SOU-->
<div id="quem-sou" class="quemsomos py-5">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <?php query_posts('page_id=2');
      if (have_posts()) : while (have_posts()) : the_post(); ?>

          <div class="col-12 col-md-5">
            <?php the_post_thumbnail('img-perfil', array('class' => 'img-fluid')); ?>
          </div>

          <div class="col-12 col-md-7 quemsomos-conteudo">
            <h2><?php the_title(); ?></h2>

            <?php the_content(); ?>
          </div>

      <?php endwhile;
      endif; ?>
    </div>
  </div>
</div>

<!--SERVIÇOS-->
<div id="servicos" class="servicos">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2>Serviços</h2>
      </div>
    </div>

    <div class="row servicos-lista">
      <div class="col-10 col-md-3 servicos-box">
        <img src="<?= get_template_directory_uri(); ?>/images/icone-auditorias.png" alt="auditorias">

        <div class="servicos-conteudo">
          <h3>Auditorias</h3>
          <p>Apuração de possíveis inconformidades e situações irregulares pelos padrões determinados pela Vigilância Sanitária, visando a prevenção de autuações e riscos de contaminação.</p>
          <a href="auditorias" type="button" class="btn btn-primary">Saiba mais</a>
        </div>
      </div>

      <div class="col-10 col-md-3 servicos-box">
        <img src="<?= get_template_directory_uri(); ?>/images/icone-consultorias.png" alt="consultorias">

        <div class="servicos-conteudo">
          <h3>Consultorias</h3>
          <p>Orientação e acompanhamento para aperfeiçoamentos nas técnicas, segurança dos alimentos, planejamento, precificação, assegurando a aplicação das melhores práticas de produção.</p>
          <a href="consultorias" type="button" class="btn btn-primary">Saiba mais</a>
        </div>
      </div>

      <div class="col-10 col-md-3 servicos-box">
        <img src="<?= get_template_directory_uri(); ?>/images/icone-treinamentos.png" alt="treinamentos">

        <div class="servicos-conteudo">
          <h3>Treinamentos</h3>
          <p>Capacitações técnicas para empresas, com conteúdo adaptável de acordo com a necessidade do cliente e porte da equipe, apoiando o desenvolvimento e padronização de processos.</p>
          <a href="servicos" type="button" class="btn btn-primary">Saiba mais</a>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<!--CTA-->
<div id="cta" class="bg-cinza text-white py-5 py-md-3">
  <div class="container">
    <div class="row">
      <?php query_posts('page_id=26');
      if (have_posts()) : while (have_posts()) : the_post(); ?>

          <div class="col-12 col-md-5">
            <img src="<?php the_post_thumbnail_url(); ?>" width="445" height="340" class="img-fluid" alt="Atendimento nutricional especializado para empresas" />
          </div>

          <div class="col-12 col-md-7 align-self-center text-center text-md-left">
            <h3><?php the_content(); ?></h3>

            <a href="#" class="btn btn-primary btn-lg mt-3" role="button" data-toggle="modal" data-target="#SolicitaContato">Entre em contato</a>
          </div>

      <?php endwhile;
      endif; ?>
      <?php wp_reset_query(); ?>
    </div>
  </div>
</div>

<!--DEPOIMENTOS-->
<div id="depoimentos" class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="text-primary text-center">Depoimentos</h2>
        <p class="text-center font-italic mb-5">O que dizem os clientes</p>

        <div class="row">
          <?php query_posts('post_type=depoimentos&post_per_page=2'); ?>
          <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>

              <div class="col-12 col-md-6 mb-5 mb-md-0">
                <div class="media row d-flex justify-content-center justify-content-md-left align-items-center">
                  <a href="#" data-toggle="modal" data-target="#tab-<?php the_id(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('img-depoimento'); ?></a>

                  <div class="media-body col-12 col-md-8 text-center text-md-left">
                    <a href="#" data-toggle="modal" data-target="#tab-<?php the_id(); ?>"><?php the_content(); ?></a>

                    <h3 class="h5 mt-3 font-weight-bold">
                      <a href="#" data-toggle="modal" data-target="#tab-<?php the_id(); ?>"><?php the_title(); ?></a>
                    </h3>
                  </div>
                </div>
              </div>

              <div class="modal" id="tab-<?php the_id(); ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
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
  </div>
</div>
</div>

<!--BLOG-->
<div id="blog" class="bg-primary mt-4 pb-5">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-12 col-md-4 text-center text-md-left">
        <h2 class="text-primary mb-5">Blog</h2>
        <p class="mb-5">Aqui você fica informado sobre todas as novidades do mundo da nutrição corporativa.</p>

        <a role="button" href="/blog" class="btn btn-outline-light btn-lg mt-md-5 mb-md-0 my-4 text-uppercase">Ver todos os posts</a>
      </div>

      <div class="col-10 col-md-8">
        <div class="card-deck">
          <?php $query = new WP_Query('posts_per_page=2'); ?>
          <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>

              <div class="card border-0 rounded shadow-sm">
                <?php the_post_thumbnail('img-post'); ?>

                <div class="card-body">
                  <h3 class="card-title"><a href="<?php the_permalink(); ?>" class="text-marrom-claro"><?php the_title(); ?></a></h3>

                  <p class="card-text"><?php the_excerpt(); ?></p>

                  <a href="<?php the_permalink(); ?>" class="text-uppercase font-weight-bold leia-mais">Ler mais ></a>
                </div>
              </div>

          <?php endwhile;
          endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
require_once("modal.php");
require_once('footer.php');
?>