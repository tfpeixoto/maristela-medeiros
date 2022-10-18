<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-148156161-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-148156161-1');
  </script>

  <!-- Meta tags Obrigatórias -->
  <meta <?php bloginfo("charset"); ?>>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i|Montserrat+Alternates:400,400i,600,600i,700,700i&display=swap" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
  <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/style.css">

  <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.png" type="image/x-icon" />

  <title><?php bloginfo("name"); ?></title>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <header>
    <div class="container">
      <div class="row">
        <div class="col-12 pt-2 mb-2 mb-md-0 nav-top">
          <ul class="list-inline nav-topo text-center text-md-right mb-0">
            <li class="list-inline-item"><i class="fas fa-phone"></i> <a href="tel:+5561996230190"> (61) 99623-0190</a></li>
            <li class="list-inline-item"><i class="fas fa-envelope"></i> <a href="mailto:contato@maristelamedeiros.com"> contato@maristelamedeiros.com</a></li>
            <li class="list-inline-item"><i class="fas fa-map-marker-alt"></i> Brasília/DF</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="navegacao">
      <div class="container">
        <div class="flex-md-row">
          <nav class="navbar d-flex justify-content-between navbar-expand-lg p-0">
            <div class="d-flex">
              <a class="navbar-brand" href="<?php echo site_url(); ?>">
                <img src="<?php bloginfo('template_url'); ?>/images/marca.svg" width="170" height="92" alt="<?php bloginfo("name"); ?>" />
              </a>
            </div>

            <div class="d-flex">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-mobile" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon">
                  <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="124px" height="124px" viewBox="0 0 124 124" style="enable-background:new 0 0 124 124;" xml:space="preserve">
                    <g>
                      <path d="M112,6H12C5.4,6,0,11.4,0,18s5.4,12,12,12h100c6.6,0,12-5.4,12-12S118.6,6,112,6z" />
                      <path d="M112,50H12C5.4,50,0,55.4,0,62c0,6.6,5.4,12,12,12h100c6.6,0,12-5.4,12-12C124,55.4,118.6,50,112,50z" />
                      <path d="M112,94H12c-6.6,0-12,5.4-12,12s5.4,12,12,12h100c6.6,0,12-5.4,12-12S118.6,94,112,94z" />
                    </g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                    <g></g>
                  </svg>
                </span>
              </button>
            </div>

            <div class="d-flex float-none menu-mobile">
              <?php
              wp_nav_menu(array(
                'theme_location'  => 'principal',
                'depth'            => 2, // 1 = no dropdowns, 2 = with dropdowns.
                'container'       => 'div',
                'container_class' => 'collapse navbar-collapse',
                'container_id'    => 'nav-mobile',
                'menu_class'      => 'navbar-nav text-uppercase',
                'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                'walker'          => new WP_Bootstrap_Navwalker(),
              ));
              ?>

              <a class="d-none d-md-block nav-link btn btn-cinza text-white shadow-sm btn-contato" href="#" data-toggle="modal" data-target="#SolicitaContato">Contato</a>
          </nav>
        </div>
      </div>
    </div>