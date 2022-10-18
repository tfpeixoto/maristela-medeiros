<?php
/*
Template Name: Home
*/
get_header(); ?>

<!--MODAL-->
<?php require_once("modal.php"); ?>

<!--BANNER-->
<div class="jumbotron">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-8 text-center text-md-left">
        <?php query_posts('page_id=5');
        if (have_posts()) : while (have_posts()) : the_post(); ?>

            <h1 class="font-weight-bold"><?php the_content(); ?></h1>

        <?php endwhile;
        endif; ?>
        <?php wp_reset_query(); ?>

        <a role="button" href="#servicos" class="btn btn-lg btn-outline-light mt-2">Conheça os serviços</a>
      </div>
    </div>
  </div>
</div>
</header>

<main>
  <!--QUEM SOU-->
  <div id="quem-sou" class="py-5">
    <div class="container">
      <div class="row d-flex align-items-center justify-content-center">
        <?php query_posts('page_id=2');
        if (have_posts()) : while (have_posts()) : the_post(); ?>

            <div class="col-10 col-md-5">
              <img src="<?php the_post_thumbnail_url(); ?>" class="card-img-top" width="445" height="474" alt="Nutricionista Maristela Medeiros, especialista em segurança dos alimentos" />
            </div>

            <div class="col-12 col-md-7 text-center text-md-left">
              <h2 class="text-primary pb-4 mt-4 mt-md-0"><?php the_title(); ?></h2>

              <?php the_content(); ?>

          <?php endwhile;
        endif; ?>
          <?php wp_reset_query(); ?>
            </div>
      </div>
    </div>

    <!--SERVIÇOS-->
    <div id="servicos" class="bg-palha py-5">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h2 class="text-primary text-center">Serviços</h2>

            <div class="card-deck">
              <div class="card border-0 rounded text-center shadow-sm">
                <img class="card-img-top" src="<?php bloginfo("template_url"); ?>/images/icone-auditorias.png" alt="Imagem de capa do card">

                <div class="card-body">
                  <h3 class="card-title text-marrom">Auditorias</h3>
                  <p class="card-text">Apuração de possíveis inconformidades e situações irregulares pelos padrões determinados pela Vigilância Sanitária, visando a prevenção de autuações e riscos de contaminação.</p>
                  <a href="auditorias" type="button" class="btn btn-primary btn-lg shadow-sm mb-3">Saiba mais</a>
                </div>
              </div>

              <div class="card border-0 rounded text-center shadow-sm">
                <img class="card-img-top" src="<?php bloginfo("template_url"); ?>/images/icone-consultorias.png" alt="Imagem de capa do card">

                <div class="card-body">
                  <h3 class="card-title text-marrom">Consultorias</h3>
                  <p class="card-text">Orientação e acompanhamento para aperfeiçoamentos nas técnicas, segurança dos alimentos, planejamento, precificação, assegurando a aplicação das melhores práticas de produção.</p>
                  <a href="consultorias" type="button" class="btn btn-primary btn-lg shadow-sm mb-3">Saiba mais</a>
                </div>
              </div>

              <div class="card border-0 rounded text-center shadow-sm">
                <img class="card-img-top" src="<?php bloginfo("template_url"); ?>/images/icone-treinamentos.png" alt="Imagem de capa do card">

                <div class="card-body">
                  <h3 class="card-title text-marrom">Treinamentos</h3>
                  <p class="card-text">Capacitações técnicas para empresas, com conteúdo adaptável de acordo com a necessidade do cliente e porte da equipe, apoiando o desenvolvimento e padronização de processos.</p>
                  <a href="servicos" type="button" class="btn btn-primary btn-lg shadow-sm mb-3">Saiba mais</a>
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

  <?php get_footer(); ?>