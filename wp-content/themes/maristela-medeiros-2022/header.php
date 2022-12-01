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
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&family=Montserrat+Alternates:wght@400;700&display=swap" rel="stylesheet">

  <!-- CSS -->
  <?php wp_head(); ?>
  <link rel="stylesheet" href="<?= get_template_directory_uri() . "/css/" . $estiloPagina ?>" as="style" media="print" onload="this.media='all'; this.onload=null;">
</head>

<body <?php body_class(); ?>>

  <header class="header">
    <div class="container">
      <div class="row">
        <div class="col-12 header__contatos">
          <ul>
            <li><i class="fas fa-phone"></i> <a href="tel:+5561996230190" title="Entre em contato"> (61) 99623-0190</a></li>
            <li><i class="fas fa-envelope"></i> <a href="mailto:contato@maristelamedeiros.com"> contato@maristelamedeiros.com</a></li>
            <li><i class="fas fa-map-marker-alt"></i> Brasília/DF</li>
          </ul>
        </div>
      </div>

      <div class="row">
        <div class="col-12 header__navegacao">
          <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="<?= site_url(); ?>">
              <img src="<?= get_template_directory_uri(); ?>/images/marca.svg" width="170" height="92" alt="<?php bloginfo("name"); ?>" />
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-mobile" aria-controls="nav-mobile" aria-expanded="false" aria-label="Alterna navegação">
              <span></span>
              <span></span>
              <span></span>
            </button>

            <?php
            wp_nav_menu(array(
              'theme_location'  => 'principal',
              'depth'            => 1, // 1 = no dropdowns, 2 = with dropdowns.
              'container'       => 'div',
              'container_class' => 'collapse navbar-collapse',
              'container_id'    => 'nav-mobile',
              'menu_class'      => 'navbar-nav',
              'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
              'walker'          => new WP_Bootstrap_Navwalker(),
            ));
            ?>

            <!--<a class="d-none d-md-block nav-link btn btn-cinza text-white shadow-sm btn-contato" href="#" data-toggle="modal" data-target="#SolicitaContato">Contato</a>-->
          </nav>
        </div>
      </div>
    </div>
  </header>